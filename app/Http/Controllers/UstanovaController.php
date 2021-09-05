<?php

namespace App\Http\Controllers;

use App\Ustanova;
use Illuminate\Http\Request;

class UstanovaController extends Controller
{
    public function get(){
        return response()->json(Ustanova::all(), 200);
    }
}
