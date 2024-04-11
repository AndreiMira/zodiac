<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SignosApiController extends Controller
{
    public function getSignPrediction($language, $sign, $date)
    {
        // Convertir la fecha al formato YYYY-MM-DD
        $formattedDate = date('Y-m-d', strtotime($date));

        // Obtener la predicción según el idioma y la fecha
        $prediction = DB::table('signos')
            ->where('tipo', $sign)
            ->whereDate('datetime', $formattedDate)
            ->value($language); // Reemplaza $language con el nombre de la columna correcta en tu base de datos

        // Verificar si se encontró la predicción
        if (!$prediction) {
            return response()->json(['error' => 'No se encontró la predicción para el signo y la fecha especificados'], 404);
        }

        // Devolver la predicción en formato JSON
        return response()->json(['prediction' => $prediction]);
    }

}
