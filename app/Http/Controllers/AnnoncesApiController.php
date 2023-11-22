<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DefaultModel;
use App\Models\AnnonceModel;

class AnnoncesAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listEntreprises = AnnonceModel::all(); 
        return response() -> json($listEntreprises);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function ProfileAdmin($id) {
        $defaultModel = new DefaultModel;
        return response()->json(['user' => $defaultModel->GetUser($id), 'id' => $id]);
    }
}
