<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi información académica</title>
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
</head>
<body>

    <div class="info-contenedor">

        <div class="info-tarjeta">

            <h1>Mi información académica</h1>
            <p class="subtitulo">Consulta tus datos escolares.</p>

            <div class="dato-alumno">
                <strong>Nombre:</strong>
                <span>{{ $alumno->nombre }}</span>
            </div>

            <div class="dato-alumno">
                <strong>Número de faltas:</strong>
                <span>{{ $alumno->faltas }}</span>
            </div>

            <div class="dato-alumno">
                <strong>Calificación:</strong>
                <span>{{ $alumno->calificacion }}</span>
            </div>

            <div class="dato-alumno">
                <strong>Equivalencia:</strong>
                <span>{{ $alumno->equivalencia }}</span>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="boton-salir">
                    Cerrar sesión
                </button>
            </form>

        </div>

    </div>

</body>
</html>
