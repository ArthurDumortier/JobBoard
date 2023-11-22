<?php

namespace App\Http\Controllers;

use App\Models\EntrepriseModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntrepriseAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupération de la liste de toutes les entreprises en utilisant le modèle "EntrepriseModel".
        $listEntreprises = EntrepriseModel::all();

        // Renvoi de la liste des entreprises en tant que réponse JSON.
        return response()->json($listEntreprises);
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
    public function show(EntrepriseModel $entrepriseModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EntrepriseModel $entrepriseModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EntrepriseModel $entrepriseModel)
    {
        //
    }
}
