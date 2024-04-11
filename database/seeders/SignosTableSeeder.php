<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Stichoza\GoogleTranslate\GoogleTranslate;

class SignosTableSeeder extends Seeder
{
    public function run()
    {
        $idiomas = ['es', 'de', 'ru', 'zh-CN', 'fr', 'it', 'pl'];

        $signos = ['aquarius', 'pisces', 'aries', 'taurus', 'gemini', 'cancer', 'leo', 'virgo', 'libra', 'scorpio', 'sagittarius', 'capricorn'];

        foreach ($signos as $signo) {
            $url = 'https://www.astrology-zodiac-signs.com/api/call.php?time=today&sign=' . $signo;
            $data = file_get_contents($url);

            // Eliminar cualquier día de la semana al principio del texto
            $data = preg_replace('/^(Monday|Tuesday|Wednesday|Thursday|Friday|Saturday|Sunday) \d{2}\/\d{2}\/\d{4}/', '', $data);

            // Insertar los datos en la tabla de signos
            $signoId = DB::table('signos')->insertGetId([
                'tipo' => $signo,
                'prediccion' => $data,
                'datetime' => now(),
            ]);

            foreach ($idiomas as $idioma) {
                $traduccion = GoogleTranslate::trans($data, $idioma);

                // Insertar la traducción en la tabla de traducciones
                DB::table('traducciones')->insert([
                    'id_signo' => $signoId, // Usamos el ID del signo recién insertado
                    'idioma' => $idioma,
                    'traduccion' => $traduccion,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
