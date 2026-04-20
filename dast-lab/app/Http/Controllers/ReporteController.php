<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Reporte;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function dashboard()
    {
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Debes iniciar sesion.');
        }

        $totalReportes = Reporte::count();
        $conImagen = Reporte::whereNotNull('imagen')->count();
        $ultimos = Reporte::orderBy('id', 'desc')->limit(5)->get();

        return view('dashboard', compact('totalReportes', 'conImagen', 'ultimos'));
    }

    public function index()
    {
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Debes iniciar sesion.');
        }

        $reportes = Reporte::orderBy('id', 'desc')->get();

        return view('reportes.index', compact('reportes'));
    }

    public function create()
    {
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Debes iniciar sesion.');
        }

        return view('reportes.create');
    }

    public function store(Request $request)
    {
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Debes iniciar sesion.');
        }

        $imagePath = null;
        if ($request->hasFile('imagen')) {
            // Vulnerabilidad : subida insegura sin validar tipo, tamano ni contenido.
            $file = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $imagePath = '/uploads/' . $filename;
        }

        Reporte::create([
            'user_id' => session('user_id'),
            'titulo' => $request->input('titulo'),
            'descripcion' => $request->input('descripcion'),
            'imagen' => $imagePath,
        ]);

        return redirect('/reportes')->with('status', 'Reporte creado.');
    }

    public function show($id)
    {
        // Vulnerabilidad educativa (IDOR): acceso directo por ID sin validar permisos de propietario.
        $reporte = Reporte::findOrFail($id);
        $comentarios = Comentario::where('reporte_id', $reporte->id)->orderBy('id', 'desc')->get();

        return view('reportes.show', compact('reporte', 'comentarios'));
    }

    public function edit($id)
    {
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Debes iniciar sesion.');
        }

        // Vulnerabilidad educativa (IDOR): sin verificar si el usuario logueado es dueno del reporte.
        $reporte = Reporte::findOrFail($id);

        return view('reportes.edit', compact('reporte'));
    }

    public function update(Request $request, $id)
    {
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Debes iniciar sesion.');
        }

        // Vulnerabilidad educativa (IDOR): cualquier usuario autenticado puede modificar por ID.
        $reporte = Reporte::findOrFail($id);
        $reporte->titulo = $request->input('titulo');
        $reporte->descripcion = $request->input('descripcion');

        if ($request->hasFile('imagen')) {
            // Vulnerabilidad educativa: subida insegura de archivo.
            $file = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $reporte->imagen = '/uploads/' . $filename;
        }

        $reporte->save();

        return redirect('/reportes/' . $reporte->id)->with('status', 'Reporte actualizado.');
    }

    public function destroy($id)
    {
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Debes iniciar sesion.');
        }

        // Vulnerabilidad educativa (IDOR): eliminacion por ID sin control de autorizacion.
        $reporte = Reporte::findOrFail($id);
        $reporte->delete();

        return redirect('/reportes')->with('status', 'Reporte eliminado.');
    }
}
