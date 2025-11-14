{* mensaje.tpl *}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mensaje</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        .mensaje { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .mensaje p { font-size: 16px; }
        .mensaje a { display: inline-block; margin-top: 15px; text-decoration: none; color: #007BFF; }
        .mensaje a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="mensaje">
        <p>{$mensaje}</p>
        <a href="javascript:history.back()">Volver</a>
    </div>
</body>
</html>
