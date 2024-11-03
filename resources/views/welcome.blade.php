<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a la Tienda</title>
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
    <!-- Incluye Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #ececec, #ececec);
            color: #000000;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            font-family: 'Arial', sans-serif;
        }
        .welcome-card {
            background: rgba(255, 255, 255, 0.9); /* Fondo blanco semi-transparente */
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            padding: 120px;
            width: 600px;
        }
        h1 {
            color: #343a40;
            margin-bottom: 15px;
            font-size: 70px;
        }
        p {
            margin-bottom: 20px;
            font-size: 1.1rem;
        }
        .btn-custom {
            width: 100%;
            padding: 10px;
            border-radius: 25px; /* Bordes redondeados */
            font-size: 1rem;
            transition: all 0.3s ease;
            border: none; /* Sin borde por defecto */
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Color más oscuro al pasar el mouse */
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.4); /* Sombra al pasar el mouse */
        }
        .btn-secondary {
            background-color: rgba(138, 217, 28, 0.78);
            border-color: #78c049;
            margin-top: 15px; /* Espacio entre botones */
        }
        .btn-secondary:hover {
            background-color: #5ec06d; /* Color más oscuro al pasar el mouse */
            box-shadow: 0 4px 12px rgba(101, 140, 60, 0.62); /* Sombra al pasar el mouse */
        }
    </style>
</head>
<body>

<div class="welcome-card">
    <h1>Bienvenid@s a nuestra Tienda</h1>
    <p>Hola Diana jsjs</p>
    <a href="{{ route('login') }}" class="btn btn-primary btn-custom">Iniciar Sesión</a>
    <a href="{{ route('register') }}" class="btn btn-secondary btn-custom">Registrar</a>
</div>

<!-- Incluye Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
