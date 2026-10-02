<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    //listes des factures
    public function index()
    {
        return view('admin.factures.index');
    }

    //créer une facture
    public function create()
    {
        return view('admin.factures.create');
    }

    //consulter une facture
    public function show()
    {
        return view('admin.factures.show');
    }


    //Modifier une facture
    public function edit()
    {
        return view('admin.factures.edit');
    }






}
