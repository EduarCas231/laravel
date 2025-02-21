<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ControllerApi extends Controller
{
    public function homebyte()
    {
        return view('homebyte');
    }

    public function usuarios()
    {
        $response = Http::get('http://localhost:4000/api/usuarios/');
        if ($response->successful()) {
            $data = $response->json();
            return view('usuarios', compact('data'));
        } else {
            return response()->json(['error' => 'Error al consultar la API'], 500);
        }
    }

    // Obtener el detalle de un usuario
    public function usuarios_detalle($id)
    {
        $response = Http::get('http://localhost:4000/api/usuarios/' . $id);
        if ($response->successful()) {
            $data = $response->json();
            return view('usuarios_detalle', compact('data'));
        } else {
            return response()->json(['error' => 'Error al consultar la API'], 500);
        }
    }

    // Mostrar la vista para dar de alta un usuario
    public function usuarios_alta()
    {
        return view('usuarios_alta');
    }

    // Registrar un nuevo usuario
   public function usuarios_registrar(Request $request)
{
    $validated = $request->validate([
        'nombre_u'    => 'required|string|max:255',
        'correo_u'    => 'required|email|max:255',
        'contraseña_u'=> 'required|string|min:8',
        'telefono_u'  => 'required|string|max:255',
        'direccion_u' => 'required|string|max:255',
        'fecha_u'     => 'required|date',
        'foto_u'      => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
    ]);

    // Manejo de la foto
    if ($request->hasFile('foto_u')) {
        $fotoPath = $request->file('foto_u')->store('fotos', 'public');
    } else {
        $fotoPath = null; // Si no se sube una foto
    }

    // Preparar datos para la base de datos
    $nuevoUsuario = [
        'nombre_u'    => $validated['nombre_u'],
        'correo_u'    => $validated['correo_u'],
        'contraseña_u'=> bcrypt($validated['contraseña_u']),
        'telefono_u'  => $validated['telefono_u'],
        'direccion_u' => $validated['direccion_u'],
        'fecha_u'     => $validated['fecha_u'],
        'foto_u'      => $fotoPath,
        'tipo_u'      => 0, // Asumiendo que el tipo de usuario es 0
    ];

    // Realizar la inserción
    $response = Http::post('http://localhost:4000/api/usuarios/', $nuevoUsuario);
    if ($response->successful()) {
        return redirect()->route('usuarios')->with('success', 'Registro creado correctamente.');
    } else {
        return back()->withErrors(['error' => 'Error al guardar los datos']);
    }
}

    // Mostrar la vista para editar un usuario
    public function usuarios_editar($id)
    {
        $response = Http::get('http://localhost:4000/api/usuarios/' . $id);
        if ($response->successful()) {
            $data = $response->json();
            return view('usuarios_editar', compact('data'));
        } else {
            return response()->json(['error' => 'Error al consultar la API'], 500);
        }
    }

    // Actualizar un usuario
    public function usuarios_salvar(Request $request, $id)
    {
        $validated = $request->validate([
            'matricula' => 'required|string|max:255',
            'nombre'    => 'required|string|max:255',
            'app'       => 'required|string|max:255',
            'apm'       => 'required|string|max:255',
            'fn'        => 'required|date',
            'gen'       => 'required',
        ]);

        $response = Http::put('http://localhost:4000/api/usuarios/' . $id, $validated);
        if ($response->successful()) {
            return redirect()->route('usuarios_detalle', ['id' => $id])->with('success', 'Datos actualizados correctamente.');
        } else {
            return back()->withErrors(['error' => 'Error al actualizar los datos']);
        }
    }

    // Eliminar un usuario
    public function usuarios_borrar($id)
    {
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
 
         $response = Http::get('http://localhost:4000/api/productos');
         if ($response->successful()) {
             $productos = $response->json();
 
             // Filtrar productos si se realiza una búsqueda
             if ($buscar) {
                 $productos = collect($productos)->filter(function ($producto) use ($buscar) {
                     return stripos($producto['name_p'], $buscar) !== false ||
                         stripos($producto['modelo_p'], $buscar) !== false;
                 });
             }
 
             return view('productos', compact('productos', 'buscar'));
         } else {
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
             'foto_p'    => 'nullable|image|mimes:jpg,png,bmp',
         ]);
 
         // Manejo de la foto
         $img2 = "def.avif";
         if ($request->hasFile('foto_p')) {
             $file = $request->file('foto_p');
             $img = $file->getClientOriginalName();
             $ldate = date('Ymd_His_');
             $img2 = $ldate . $img;
             $file->storeAs('public/images', $img2);
         }
 
         // Preparar datos para la base de datos
         $nuevoProducto = [
             'name_p'    => $validated['name_p'],
             'Noserie_p' => $validated['Noserie_p'],
             'modelo_p'  => $validated['modelo_p'],
             'region_p'  => $validated['region_p'],
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
             'foto_p'    => 'nullable|image|mimes:jpg,png,bmp',
         ]);
 
         $response = Http::put('http://localhost:4000/api/productos/' . $id, $validated);
         if ($response->successful()) {
             return redirect()->route('producto_detalle', ['id' => $id])->with('success', 'Producto actualizado correctamente.');
         } else {
             return back()->withErrors(['error' => 'Error al actualizar el producto']);
         }
     }
 
     public function producto_borrar($id)
     {
         $response = Http::delete('http://localhost:4000/api/productos/' . $id);
         if ($response->successful()) {
             return redirect()->route('productos')->with('success', 'Producto eliminado correctamente.');
         } else {
             return back()->withErrors(['error' => 'Error al eliminar el producto']);
         }
     }
}


