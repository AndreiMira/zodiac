# API de Predicciones de Signos
Esta API proporciona predicciones de signos del zodíaco en varios idiomas para una fecha específica.
- es
- en
- de
- ru
- zh-CN
- fr
- it
- pl

## Uso
Para obtener la predicción de un signo del zodíaco en un idioma específico para una fecha determinada, realiza una solicitud GET a la siguiente URL:

```get
GET /es/leo/2023-01-01   
```

Resultado:

exitosa
```json
{
    "prediction": "Hoy tendrás un día lleno de energía positiva y nuevas oportunidades. Es un buen momento para..."
}
```
error
```json
{
    "error": "No se encontró la predicción para el signo y la fecha especificados"
}
```
