<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar alumno</title>
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
</head>
<body>

    <div class="formulario-contenedor">

        <div class="formulario-tarjeta">

            <h1>Registrar alumno</h1>
            <p>Completa los datos para agregar un nuevo alumno.</p>

            @if($errors->any())
                <div class="errores">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('alumnos.store') }}" method="POST">
                @csrf

                <label>Nombre del alumno:</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required>

                <label>Correo electrónico:</label>
                <input type="email" name="email" value="{{ old('email') }}" required>

                <label>Contraseña:</label>
                <input type="password" name="password" required>

                <label>Confirmar contraseña:</label>
                <input type="password" name="password_confirmation" required>

                <label>Número de faltas:</label>
                <input type="number" name="faltas" min="0" value="{{ old('faltas', 0) }}" required>

                <label>Calificación:</label>
                <input type="number" name="calificacion" min="0" max="10" step="0.01" value="{{ old('calificacion') }}" required>

                <div class="botones-formulario">
                    <button type="submit">Guardar alumno</button>
                    <a href="{{ route('alumnos.index') }}" class="boton-cancelar">Cancelar</a>
                </div>

            </form>

        </div>

    </div>

</body>
</html>
