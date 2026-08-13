<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventoController extends Controller
{
    /**
     * Obtener todos los eventos.
     */
    public function index()
    {
        $eventos = Evento::all();

        return response()->json([
            'eventos' => $eventos,
            'status' => 200
        ], 200);
    }

    /**
     * Crear un nuevo evento.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'ubicacion' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Datos faltantes',
                'status' => 400
            ], 400);
        }

        $evento = Evento::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'ubicacion' => $request->ubicacion,
        ]);

        if (!$evento) {
            return response()->json([
                'message' => 'Error al crear el evento',
                'status' => 500
            ], 500);
        }

        return response()->json([
            'evento' => $evento,
            'status' => 201
        ], 201);
    }

    /**
     * Obtener un evento específico.
     */
    public function show(Evento $evento)
    {
        return response()->json([
            'evento' => $evento,
            'status' => 200
        ], 200);
    }

    /**
     * Actualizar un evento.
     */
    public function update(Request $request, Evento $evento)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'ubicacion' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Datos faltantes',
                'status' => 400
            ], 400);
        }

        $evento->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'ubicacion' => $request->ubicacion,
        ]);

        return response()->json([
            'evento' => $evento,
            'status' => 200
        ], 200);
    }

    /**
     * Eliminar un evento.
     */
    public function destroy(Evento $evento)
    {
        $evento->delete();

        return response()->json([
            'message' => 'Evento eliminado correctamente',
            'status' => 200
        ], 200);
    }
}
