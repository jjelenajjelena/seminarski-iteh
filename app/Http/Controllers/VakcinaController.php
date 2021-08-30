<?php

namespace App\Http\Controllers;

use App\Vakcina;
use Illuminate\Http\Request;

class VakcinaController extends Controller
{
    public function get()
    {
        return response()->json(Vakcina::all(), 200);
    }
}
