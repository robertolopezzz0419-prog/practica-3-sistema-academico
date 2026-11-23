<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Académico</title>
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
</head>
<body>

    <div class="contenedor-principal">

        <h1>Sistema Académico</h1>
        <h2>Lista de alumnos</h2>

        <p>Bienvenido, profesor.</p>

        @if(session('success'))
            <p class="mensaje-exito">{{ session('success') }}</p>
        @endif

        <div class="acciones-superiores">
            <a href="{{ route('alumnos.create') }}" class="boton">
                + Registrar alumno
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        </div>

        <div class="filtros">
            <h3>Ordenar alumnos</h3>

            <form method="GET" action="{{ route('alumnos.index') }}">
                <label>Ordenar por:</label>

                <select name="orden">
                    <option value="nombre" {{ $orden == 'nombre' ? 'selected' : '' }}>Nombre</option>
                    <option value="calificacion" {{ $orden == 'calificacion' ? 'selected' : '' }}>Calificación</option>
                    <option value="faltas" {{ $orden == 'faltas' ? 'selected' : '' }}>Faltas</option>
                </select>

                <select name="direccion">
                    <option value="asc" {{ $direccion == 'asc' ? 'selected' : '' }}>Ascendente</option>
                    <option value="desc" {{ $direccion == 'desc' ? 'selected' : '' }}>Descendente</option>
                </select>

                <button type="submit">Ordenar</button>
            </form>
        </div>

        <div class="tabla-contenedor">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Faltas</th>
                        <th>Calificación</th>
                        <th>Equivalencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($alumnos as $alumno)
                        <tr>
                            <td>{{ $alumno->nombre }}</td>
                            <td>{{ $alumno->faltas }}</td>
                            <td>{{ $alumno->calificacion }}</td>
                            <td>{{ $alumno->equivalencia }}</td>
                            <td>
                                <a href="{{ route('alumnos.edit', $alumno) }}" class="boton-editar">
                                    Editar
                                </a>

                                <form action="{{ route('alumnos.destroy', $alumno) }}"
                                      method="POST"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="boton-eliminar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Todavía no hay alumnos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
