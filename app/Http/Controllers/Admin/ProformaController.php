<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProformaController extends Controller
{
    
    //listes des proformas
    public function index()
    {
        return view('admin.proforma.index');
    }

    //créer un proforma
    public function create()
    {
        return view('admin.proforma.create');
    }

    //consulter un proforma
    public function show()
    {
        return view('admin.proforma.show');
    }

    //Modifier un proforma
    public function edit()
    {
        return view('admin.proforma.edit');
    }
}
