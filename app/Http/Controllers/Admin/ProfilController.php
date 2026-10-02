<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    //profil utilisateur
    public function profil(){
        return view('admin.profil.index');
    }
}
