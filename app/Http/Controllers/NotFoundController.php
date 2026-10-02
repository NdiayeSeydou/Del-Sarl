<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotFoundController extends Controller
{
    //page not found
    public function show()
    {
        return response()->view('errors.404', [], 404);
    }
}
