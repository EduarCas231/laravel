<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;

class ControllerApi extends Controller
{
    public function homebyte()
    {
        return view('homebyte');
    }

    // Mostrar lista de usuarios
    public function usuarios(Request $request)
    {
        $buscar = $request->input('buscar', '');

        // Llamar a la API para obtener los usuarios
        $response = Http::get('http://localhost:4000/api/usuarios');

        if (!$response->successful()) {
            return redirect()->route('error')->with('message', 'Error al consultar la API');
        }

        $usuarios = $response->json();

        // Validar que los datos sean un array
        if (!is_array($usuarios)) {
            return redirect()->route('error')->with('message', 'Datos de usuarios no válidos');
        }

        // Filtrar usuarios si se realiza una búsqueda
        if ($buscar) {
            $usuarios = collect($usuarios)->filter(function ($usuario) use ($buscar) {
                return stripos($usuario['nombre_u'], $buscar) !== false ||
                    stripos($usuario['correo_u'], $buscar) !== false;
            })->values()->toArray();
        }

        // Obtener datos para el gráfico de tipo de usuario
        $tipoUsuarioData = collect($usuarios)->groupBy('tipo_u')->map->count();
        $tipoUsuarioChart = [
            'labels' => ['Usuario', 'Administrador'],
            'data' => [
                $tipoUsuarioData->get(0, 0), // Usuarios normales
                $tipoUsuarioData->get(1, 0), // Administradores
            ],
        ];

        // Obtener datos para el gráfico de género
        $generoData = collect($usuarios)->groupBy('genero_u')->map->count();
        $generoChart = [
            'labels' => ['Mujer', 'Hombre'], // Mujer = 0, Hombre = 1
            'data' => [
                $generoData->get(0, 0), // Mujeres
                $generoData->get(1, 0), // Hombres
            ],
        ];

        // Retornar la vista con los datos de las gráficas
        return view('usuarios', compact('usuarios', 'buscar', 'tipoUsuarioChart', 'generoChart'));
    }
    public function usuarios_registrar(Request $request)
    {
        $this->validate($request, [
            'nombre_u' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/',
            'correo_u' => 'required|email|regex:/^[A-Za-z][A-Za-z0-9._%+-]*@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/',
            'contraseña_u' => 'required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&]/|confirmed',
            'tipo_u' => 'required',
            'telefono_u' => 'required',
            'direccion_u' => 'required',
            'genero_u' => 'required',
            'fecha_u' => 'required|date',
            'foto_u' => 'nullable|image|mimes:jpg,png,bmp',
        ]);

        $img2 = "default.jpg";
        if ($request->hasFile('foto_u')) {
            $file = $request->file('foto_u');
            $img = $file->getClientOriginalName();
            $ldate = date('Ymd_His_');
            $img2 = $ldate . $img;
            $file->move(public_path('img'), $img2); // Guardar en public/img
            $img2 = 'img/' . $img2; // Ruta relativa para la base de datos
        }

        // Preparar datos para la API
        $nuevoUsuario = [
            'nombre_u' => $request->input('nombre_u'),
            'correo_u' => $request->input('correo_u'),
            'contraseña_u' => Hash::make($request->contraseña_u),
            'tipo_u' => $request->input('tipo_u'),
            'telefono_u' => $request->input('telefono_u'),
            'direccion_u' => $request->input('direccion_u'),
            'genero_u' => $request->input('genero_u'),
            'fecha_u' => $request->input('fecha_u'),
            'foto_u' => $img2,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Llamar a la API para crear el usuario
        $response = Http::post('http://localhost:4000/api/usuarios', $nuevoUsuario);
        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Usuario creado correctamente.');
        } else {
            return back()->withErrors(['error' => 'Error al guardar los datos']);
        }
    }

    public function usuarios_alta()
    {
        return view('usuarios_alta');
    }


    public function usuarios_detalle($id)
    {
        // Llamar a la API para obtener el usuario
        $response = Http::get('http://localhost:4000/api/usuarios/' . $id);

        if ($response->successful()) {
            $usuario = json_decode(json_encode($response->json())); // Convertir array en objeto
            return view('usuarios_detalle', compact('usuario'));
        } else {
            return response()->json(['error' => 'Error al consultar la API'], 500);
        }
    }


    // Mostrar formulario para editar un usuario
    public function usuarios_editar($id)
    {
        // Llamar a la API para obtener el usuario
        $response = Http::get('http://localhost:4000/api/usuarios/' . $id);
        if ($response->successful()) {
            $usuario = $response->json();
            return view('usuarios_editar', compact('usuario'));
        } else {
            return response()->json(['error' => 'Error al consultar la API'], 500);
        }
    }

    // Actualizar un usuario
    public function usuarios_salvar($id, Request $request)
    {
        // Validar los datos del formulario
        $this->validate($request, [
            'nombre_u' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/',
            'correo_u' => 'required|email|regex:/^[A-Za-z][A-Za-z0-9._%+-]*@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/',
            'contraseña_u' => 'nullable|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&]/|confirmed',
            'telefono_u' => 'required',
            'direccion_u' => 'required',
            'genero_u' => 'required',
            'fecha_u' => 'required|date',
            'foto_u' => 'nullable|image|mimes:jpg,png,bmp',
        ]);

        // Obtener el usuario actual
        $response = Http::get('http://localhost:4000/api/usuarios/' . $id);
        if (!$response->successful()) {
            return back()->withErrors(['error' => 'Error al consultar la API']);
        }

        $usuario = $response->json();
        $img2 = $usuario['foto_u']; // Mantener la foto actual si no se sube una nueva

        // Manejo de la foto
        if ($request->hasFile('foto_u')) {
            $file = $request->file('foto_u');
            $img = $file->getClientOriginalName();
            $ldate = date('Ymd_His_');
            $img2 = $ldate . $img;
            $file->move(public_path('img'), $img2); // Guardar en public/img
            $img2 = 'img/' . $img2; // Ruta relativa para la base de datos
        }

        // Preparar datos para la API
        $data = [
            'nombre_u' => $request->input('nombre_u'),
            'correo_u' => $request->input('correo_u'),
            'telefono_u' => $request->input('telefono_u'),
            'direccion_u' => $request->input('direccion_u'),
            'genero_u' => $request->input('genero_u'),
            'fecha_u' => $request->input('fecha_u'),
            'foto_u' => $img2,
        ];

        // Actualizar contraseña si se proporciona
        if ($request->filled('contraseña_u')) {
            $data['contraseña_u'] = Hash::make($request->input('contraseña_u'));
        }

        // Llamar a la API para actualizar el usuario
        $response = Http::put('http://localhost:4000/api/usuarios/' . $id, $data);
        if ($response->successful()) {
            return redirect()->route('usuarios.detalle', ['id' => $id])->with('success', 'Usuario actualizado correctamente.');
        } else {
            return back()->withErrors(['error' => 'Error al actualizar los datos']);
        }
    }
    // Eliminar un usuario
    public function usuarios_borrar($id)
    {
        // Llamar a la API para eliminar el usuario
        $response = Http::delete('http://localhost:4000/api/usuarios/' . $id);
        if ($response->successful()) {
            return redirect()->route('usuarios')->with('success', 'Usuario eliminado correctamente.');
        } else {
            return back()->withErrors(['error' => 'Error al eliminar el usuario']);
        }
    }


    // productos
    public function productos(Request $request)
{
    $buscar = $request->input('buscar', '');

    // Consultar la API externa
    $response = Http::get('http://localhost:4000/api/productos');
    if ($response->successful()) {
        $productos = $response->json();

        // Filtrar productos si se realiza una búsqueda
        if ($buscar) {
            $productos = collect($productos)->filter(function ($producto) use ($buscar) {
                return stripos($producto['name_p'], $buscar) !== false ||
                    stripos($producto['modelo_p'], $buscar) !== false;
            });
        } else {
            $productos = collect($productos);
        }

        // Paginación manual
        $page = $request->input('page', 1); // Obtener el número de página actual
        $perPage = 2; 
        $offset = ($page - 1) * $perPage;

        // Obtener los elementos de la página actual
        $paginatedItems = $productos->slice($offset, $perPage)->values();

        // Crear una instancia de LengthAwarePaginator
        $productos = new LengthAwarePaginator(
            $paginatedItems, // Elementos de la página actual
            $productos->count(), // Total de elementos
            $perPage, // Elementos por página
            $page, // Página actual
            ['path' => $request->url(), 'query' => $request->query()] // Opciones de URL
        );

        // Retornar la vista con los productos paginados
        return view('productos', compact('productos', 'buscar'));
    } else {
        // Manejar el error de la API
        return response()->json(['error' => 'Error al consultar la API'], 500);
    }
}
    public function producto_detalle($id)
    {
        $response = Http::get('http://localhost:4000/api/productos/' . $id);
        if ($response->successful()) {
            $producto = $response->json();
            return view('producto_detalle', compact('producto'));
        } else {
            return response()->json(['error' => 'Error al consultar la API'], 500);
        }
    }

    public function producto_alta()
    {
        return view('producto_alta');
    }

    public function producto_registrar(Request $request)
    {
        $validated = $request->validate([
            'name_p'    => 'required|string|max:255',
            'Noserie_p' => 'required|string|max:255',
            'modelo_p'  => 'required|string|max:255',
            'region_p'  => 'required|string|max:255',
            'detalle_p' => 'required|string|max:255',
            'foto_p'    => 'nullable|image|mimes:jpg,png,bmp',
        ]);

        // Manejo de la foto
        $img2 = "def.avif"; // Imagen por defecto
        if ($request->hasFile('foto_p')) {
            $file = $request->file('foto_p');
            $img = $file->getClientOriginalName();
            $ldate = date('Ymd_His_');
            $img2 = $ldate . $img;
            $file->move(public_path('img'), $img2); // Guardar en public/img
            $img2 = 'img/' . $img2; // Ruta relativa para la base de datos
        }

        // Preparar datos para la base de datos
        $nuevoProducto = [
            'name_p'    => $validated['name_p'],
            'Noserie_p' => $validated['Noserie_p'],
            'modelo_p'  => $validated['modelo_p'],
            'region_p'  => $validated['region_p'],
            'detalle_p' => $validated['detalle_p'],
            'foto_p'    => $img2,
        ];

        $response = Http::post('http://localhost:4000/api/productos', $nuevoProducto);
        if ($response->successful()) {
            return redirect()->route('productos')->with('success', 'Producto creado correctamente.');
        } else {
            return back()->withErrors(['error' => 'Error al guardar el producto']);
        }
    }
    public function producto_editar($id)
    {
        $response = Http::get('http://localhost:4000/api/productos/' . $id);
        if ($response->successful()) {
            $producto = $response->json();
            return view('producto_editar', compact('producto'));
        } else {
            return response()->json(['error' => 'Error al consultar la API'], 500);
        }
    }

    public function producto_salvar(Request $request, $id)
    {
        $validated = $request->validate([
            'name_p'    => 'required|string|max:255',
            'Noserie_p' => 'required|string|max:255',
            'modelo_p'  => 'required|string|max:255',
            'region_p'  => 'required|string|max:255',
            'detalle_p' => 'required|string|max:255',
            'foto_p'    => 'nullable|image|mimes:jpg,png,bmp',
        ]);

        // Llamar a la API para obtener el producto actual
        $response = Http::get('http://localhost:4000/api/productos/' . $id);
        if (!$response->successful()) {
            return back()->withErrors(['error' => 'Error al consultar la API']);
        }

        $producto = $response->json();
        $img2 = $producto['foto_p']; // Mantener la foto actual si no se sube una nueva

        // Manejo de la foto
        if ($request->hasFile('foto_p')) {
            $file = $request->file('foto_p');
            $img = $file->getClientOriginalName();
            $ldate = date('Ymd_His_');
            $img2 = $ldate . $img;
            $file->move(public_path('img'), $img2); // Guardar en public/img
            $img2 = 'img/' . $img2; // Ruta relativa para la base de datos
        }

        // Preparar datos para la API
        $data = [
            'name_p'    => $validated['name_p'],
            'Noserie_p' => $validated['Noserie_p'],
            'modelo_p'  => $validated['modelo_p'],
            'region_p'  => $validated['region_p'],
            'detalle_p' => $validated['detalle_p'],
            'foto_p'    => $img2,
        ];

        $response = Http::put('http://localhost:4000/api/productos/' . $id, $data);
        if ($response->successful()) {
            return redirect()->route('producto_detalle', ['id' => $id])->with('success', 'Producto actualizado correctamente.');
        } else {
            return back()->withErrors(['error' => 'Error al actualizar el producto']);
        }
    }

    public function producto_borrar($id)
    {
        // Llamar a la API para eliminar el producto
        $response = Http::delete('http://localhost:4000/api/productos/' . $id);
        if ($response->successful()) {
            return redirect()->route('productos')->with('success', 'Producto eliminado correctamente.');
        } else {
            return back()->withErrors(['error' => 'Error al eliminar el producto']);
        }
    }

    //////////////////////////////////////////////////////////////////////

    public function usert(Request $request)
    {
    

        // Llamar a la API para obtener los usuarios
        $response = Http::get('http://localhost:4000/api/usert');

        if (!$response->successful()) {
            return redirect()->route('error')->with('message', 'Error al consultar la API');
        }

        $usuarios = $response->json();

        // Validar que los datos sean un array
        if (!is_array($usuarios)) {
            return redirect()->route('error')->with('message', 'Datos de usuarios no válidos');
        }


        // Retornar la vista con los datos de las gráficas
        return view('usert', compact('usuarios'));
    }

    public function usert_registrar(Request $request)
    {
        $this->validate($request, [
            'nombre_u' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/',
            'correo_u' => 'required|email|regex:/^[A-Za-z][A-Za-z0-9._%+-]*@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/',
            'direccion_u' => 'required',
            'estado_u' => 'required',
            'municipio_u' => 'required',
            'foto_u' => 'nullable|image|mimes:jpg,png,bmp',
        ]);

        $img2 = "default.jpg";
        if ($request->hasFile('foto_u')) {
            $file = $request->file('foto_u');
            $img = $file->getClientOriginalName();
            $ldate = date('Ymd_His_');
            $img2 = $ldate . $img;
            $file->move(public_path('img'), $img2); // Guardar en public/img
            $img2 = 'img/' . $img2; // Ruta relativa para la base de datos
        }

        // Preparar datos para la API
        $nuevoUsuario = [
            'nombre_u' => $request->input('nombre_u'),
            'correo_u' => $request->input('correo_u'),
            'direccion_u' => $request->input('direccion_u'),
            'estado_u' => $request->input('estado_u'),
            'municipio_u' => $request->input('municipio_u'),
            'foto_u' => $img2,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Llamar a la API para crear el usuario
        $response = Http::post('http://localhost:4000/api/usert', $nuevoUsuario);
        if ($response->successful()) {
            return redirect()->route('usert')->with('success', 'Usuario creado correctamente.');
        } else {
            return back()->withErrors(['error' => 'Error al guardar los datos']);
        }
    }

    public function usert_alta()
    {
        return view('usert_alta');
    }


    public function usert_detalle($id)
    {
        // Llamar a la API para obtener el usuario
        $response = Http::get('http://localhost:4000/api/usert/' . $id);

        if ($response->successful()) {
            $usuario = json_decode(json_encode($response->json())); // Convertir array en objeto
            return view('usuarios_detalle', compact('usuario'));
        } else {
            return response()->json(['error' => 'Error al consultar la API'], 500);
        }
    }


    // Mostrar formulario para editar un usuario
    public function usert_editar($id)
    {
        // Llamar a la API para obtener el usuario
        $response = Http::get('http://localhost:4000/api/usert/' . $id);
        if ($response->successful()) {
            $usuario = $response->json();
            return view('usuarios_editar', compact('usuario'));
        } else {
            return response()->json(['error' => 'Error al consultar la API'], 500);
        }
    }

    // Actualizar un usuario
    public function usert_salvar($id, Request $request)
    {
        // Validar los datos del formulario
        $this->validate($request, [
            'nombre_u' => 'required|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/',
            'correo_u' => 'required|email|regex:/^[A-Za-z][A-Za-z0-9._%+-]*@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/',
            'contraseña_u' => 'nullable|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&]/|confirmed',
            'telefono_u' => 'required',
            'direccion_u' => 'required',
            'genero_u' => 'required',
            'fecha_u' => 'required|date',
            'foto_u' => 'nullable|image|mimes:jpg,png,bmp',
        ]);

        // Obtener el usuario actual
        $response = Http::get('http://localhost:4000/api/usert/' . $id);
        if (!$response->successful()) {
            return back()->withErrors(['error' => 'Error al consultar la API']);
        }

        $usuario = $response->json();
        $img2 = $usuario['foto_u']; // Mantener la foto actual si no se sube una nueva

        // Manejo de la foto
        if ($request->hasFile('foto_u')) {
            $file = $request->file('foto_u');
            $img = $file->getClientOriginalName();
            $ldate = date('Ymd_His_');
            $img2 = $ldate . $img;
            $file->move(public_path('img'), $img2); // Guardar en public/img
            $img2 = 'img/' . $img2; // Ruta relativa para la base de datos
        }

        // Preparar datos para la API
        $data = [
            'nombre_u' => $request->input('nombre_u'),
            'correo_u' => $request->input('correo_u'),
            'telefono_u' => $request->input('telefono_u'),
            'direccion_u' => $request->input('direccion_u'),
            'genero_u' => $request->input('genero_u'),
            'fecha_u' => $request->input('fecha_u'),
            'foto_u' => $img2,
        ];

        // Actualizar contraseña si se proporciona
        if ($request->filled('contraseña_u')) {
            $data['contraseña_u'] = Hash::make($request->input('contraseña_u'));
        }

        // Llamar a la API para actualizar el usuario
        $response = Http::put('http://localhost:4000/api/usert/' . $id, $data);
        if ($response->successful()) {
            return redirect()->route('usuarios.detalle', ['id' => $id])->with('success', 'Usuario actualizado correctamente.');
        } else {
            return back()->withErrors(['error' => 'Error al actualizar los datos']);
        }
    }
    // Eliminar un usuario
    public function usert_borrar($id)
    {
        // Llamar a la API para eliminar el usuario
        $response = Http::delete('http://localhost:4000/api/usert/' . $id);
        
        if ($response->successful()) {
           
            return view('usert', compact('usert'));
        } else {
            return back()->withErrors(['error' => 'Error al eliminar el usuario']);
        }
    }
    


    
}
