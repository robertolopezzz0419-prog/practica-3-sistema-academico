<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar alumno</title>
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
</head>
<body>

    <div class="formulario-contenedor">

        <div class="formulario-tarjeta">

            <h1>Editar alumno</h1>
            <p>Modifica los datos académicos del alumno.</p>

            @if($errors->any())
                <div class="errores">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('alumnos.update', $alumno) }}" method="POST">
                @csrf
                @method('PUT')

                <label>Nombre del alumno:</label>
                <input type="text" name="nombre"
                    value="{{ old('nombre', $alumno->nombre) }}" required>

                <label>Número de faltas:</label>
                <input type="number" name="faltas" min="0"
                    value="{{ old('faltas', $alumno->faltas) }}" required>

                <label>Calificación:</label>
                <input type="number" name="calificacion" min="0" max="10"
                    step="0.01"
                    value="{{ old('calificacion', $alumno->calificacion) }}" required>

                <div class="botones-formulario">
                    <button type="submit">Actualizar alumno</button>
                    <a href="{{ route('alumnos.index') }}" class="boton-cancelar">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>

    </div>

</body>
</html>
