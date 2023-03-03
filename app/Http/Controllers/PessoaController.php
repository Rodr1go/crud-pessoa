<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Http\Requests\PersonRequest;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pessoa = Pessoa::with('telefones')->get();
        
        return response()->json($pessoa);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pessoa = Pessoa::create($request->validated());
        
        if($request->telefones) {
            $pessoa->telefones()->createMany($request->telefones);
        }

        return response()->json($pessoa, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pessoa->load('telefones');
        return response()->json($pessoa);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pessoa->update($request->validated());

        if($request->telefones) {
            $pessoa->telefones()->delete();
            $pessoa->telefones()->createMany($request->telefones);
        }

        return response()->json($pessoa);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pessoa->delete();
        return response()->noContent();
    }
}