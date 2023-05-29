<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eletrodomestico;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use App\Models\Marca;

class EletrodomesticoController extends Controller
{
    public function index()
    {
        $eletrodomesticos = Eletrodomestico::all();

        return response()->json($eletrodomesticos);
    }

    
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'nome' => 'required',
                'descricao' => 'required',
                'tensao' => 'required',
                'marca_id' => 'required|exists:marcas,id',
            ]);
            
            $eletrodomestico = Eletrodomestico::create($request->all());
            
            return response()->json($eletrodomestico, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        }
        
    }

    
    public function show($id)
    {
        $eletrodomestico = Eletrodomestico::findOrFail($id);

        return response()->json($eletrodomestico);
    }

    
    public function update(Request $request, $id)
    {
        $eletrodomestico = Eletrodomestico::findOrFail($id);
        $eletrodomestico->update($request->all());

        return response()->json($eletrodomestico);
    }

    
    public function destroy($id)
    {
        $eletrodomestico = Eletrodomestico::findOrFail($id);
        $eletrodomestico->delete();

        return response()->json(null, 204);
    }

    public function marcas()
    {
        $marcas = Marca::all();

        return response()->json($marcas);
    }

}
