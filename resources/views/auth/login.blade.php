<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
</head>
<body>

    <div class="login-contenedor">

        <div class="login-tarjeta">

            <h1>Sistema Académico</h1>
            <p>Ingresa tus datos para continuar</p>

            @if ($errors->any())
                <p class="error">{{ $errors->first() }}</p>
            @endif

            <form action="{{ route('login.procesar') }}" method="POST">
                @csrf

                <label>Correo electrónico:</label>
                <input type="email" name="email"
                       value="{{ old('email') }}" required>

                <label>Contraseña:</label>
                <input type="password" name="password" required>

                <button type="submit" class="boton-login">Entrar</button>
            </form>

        </div>

    </div>

</body>
</html>
