<?php

namespace App\Http\Controllers;

use App\Models\Ponente;
use Illuminate\Http\Request;

class PonenteController extends Controller
{
    public function index()
    {
        return response()->json(Ponente::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'biografia' => 'nullable',
            'especialidad' => 'nullable',
        ]);

        $ponente = Ponente::create($request->all());

        return response()->json($ponente, 201);
    }

    public function show(Ponente $ponente)
    {
        return response()->json($ponente);
    }

    public function update(Request $request, Ponente $ponente)
    {
        $request->validate([
            'nombre' => 'required',
            'biografia' => 'nullable',
            'especialidad' => 'nullable',
        ]);

        $ponente->update($request->all());

        return response()->json($ponente);
    }

    public function destroy(Ponente $ponente)
    {
        $ponente->delete();

        return response()->json([
            'mensaje' => 'Ponente eliminado correctamente'
        ]);
    }
}

