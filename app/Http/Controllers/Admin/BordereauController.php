<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BordereauController extends Controller
{


    //listes des bordereaux
    public function index()
    {
        return view('admin.bordereau.index');
    }


    //créer un bordereau
    public function create()
    {
        return view('admin.bordereau.create');
    }

    //consulter un bordereau
    public function show()
    {
        return view('admin.bordereau.show');
    }


    //Modifier un bordereau
    public function edit()
    {
        return view('admin.bordereau.edit');
    }
}
