<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategoria;

class SubcategoriaController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategorias = Subcategoria::with('categoria')->get();
        return response()->json($subcategorias);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $subcategoria = Subcategoria::create([
            'nome' => $request->nome,
            'categoria_id' => $request->categoria_id,
        ]);

        return response()->json($subcategoria, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $subcategoria = Subcategoria::with('categoria')->findOrFail($id);
        return response()->json($subcategoria);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'categoria_id' => 'sometimes|required|exists:categorias,id',
        ]);

        $subcategoria = Subcategoria::findOrFail($id);

        if ($request->has('nome')) {
            $subcategoria->nome = $request->nome;
        }

        if ($request->has('categoria_id')) {
            $subcategoria->categoria_id = $request->categoria_id;
        }

        $subcategoria->save();

        return response()->json($subcategoria);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        $subcategoria->delete();

        return response()->json(null, 204);
    }
}
