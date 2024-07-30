<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        return Categoria::with('subcategorias')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|unique:categorias',
        ]);

        $categoria = Categoria::create($request->all());

        return response()->json($categoria, 201);
    }

    public function show($id)
    {
        $categoria = Categoria::with('subcategorias')->findOrFail($id);
        return $categoria;
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);
        $request->validate([
            'nome' => 'required|unique:categorias,nome,' . $categoria->id,
        ]);

        $categoria->update($request->all());

        return response()->json($categoria, 200);
    }

    public function destroy($id)
    {
        Categoria::destroy($id);
        return response()->json(null, 204);
    }
}
