<?php

    namespace App\Http\Controllers;

    use App\Models\Alumno;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
    use Illuminate\Support\Facades\Hash;

    class AlumnoController extends Controller
    {
        // Mostrar los alumnos
        public function index(Request $request)
        {
            $orden = $request->get('orden', 'nombre');
            $direccion = $request->get('direccion', 'asc');

            if (!in_array($orden, ['nombre', 'calificacion', 'faltas'])) {
                $orden = 'nombre';
            }

            if (!in_array($direccion, ['asc', 'desc'])) {
                $direccion = 'asc';
            }

            $alumnos = Alumno::orderBy($orden, $direccion)->get();

            return view('alumnos.index', compact('alumnos', 'orden', 'direccion'));
        }

        // Mostrar formulario de registro
        public function create()
        {
            return view('alumnos.create');
        }

        // Guardar alumno
       public function store(Request $request)
{
    $datos = $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'faltas' => 'required|integer|min:0',
        'calificacion' => 'required|numeric|min:0|max:10',
    ]);

    $usuario = User::create([
        'name' => $datos['nombre'],
        'email' => $datos['email'],
        'password' => Hash::make($datos['password']),
        'rol' => 'alumno',
    ]);

    $datos['equivalencia'] = $this->calcularEquivalencia(
        $datos['calificacion']
    );

    Alumno::create([
        'nombre' => $datos['nombre'],
        'faltas' => $datos['faltas'],
        'calificacion' => $datos['calificacion'],
        'equivalencia' => $datos['equivalencia'],
        'user_id' => $usuario->id,
    ]);

    return redirect()->route('alumnos.index')
        ->with('success', 'Alumno registrado correctamente.');
}

        // Mostrar formulario de edición
        public function edit(Alumno $alumno)
        {
            return view('alumnos.edit', compact('alumno'));
        }

        // Actualizar alumno
        public function update(Request $request, Alumno $alumno)
        {
            $datos = $request->validate([
                'nombre' => 'required|string|max:255',
                'faltas' => 'required|integer|min:0',
                'calificacion' => 'required|numeric|min:0|max:10',
            ]);

            $datos['equivalencia'] = $this->calcularEquivalencia(
                $datos['calificacion']
            );

            $alumno->update($datos);

            return redirect()->route('alumnos.index')
                ->with('success', 'Alumno actualizado correctamente.');
        }

        // Eliminar alumno
        public function destroy(Alumno $alumno)
        {
            $alumno->delete();

            return redirect()->route('alumnos.index')
                ->with('success', 'Alumno eliminado correctamente.');
        }

        // Calcular equivalencia automáticamente
        private function calcularEquivalencia($calificacion)
        {
            if ($calificacion < 7) {
                return 'NA';
            } elseif ($calificacion < 9) {
                return 'SA';
            } elseif ($calificacion < 10) {
                return 'DE';
            }

            return 'AU';
        }

        public function miInfo()
    {
        $alumno = Alumno::where('user_id', Auth::id())->firstOrFail();

        return view('alumnos.mi-info', compact('alumno'));
    }
    }