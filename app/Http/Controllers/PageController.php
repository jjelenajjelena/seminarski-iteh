<?php

namespace App\Http\Controllers;

use App\Prijava;
use App\Ustanova;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function prijavljivanje()
    {
        return view('pacijent.prijavljivanje');
    }
    public function pregledPrijava()
    {
        return view('doktor.pregled-prijava');
    }
    public function doktorObaveze()
    {
        return view('doktor.obaveze');
    }
    public function statistikaPrijava()
    {
        $prijave = Prijava::selectRaw('year(FROM_UNIXTIME(zakazano_u)) year, monthname(FROM_UNIXTIME(zakazano_u)) month, count(*) data')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->get();

        return view('doktor.statistika-prijava', ['prijave' => $prijave]);
    }
    public function mojaPrijava()
    {
        return view('pacijent.moja-prijava');
    }

    public function jednaPrijava($id)
    {

        $prijava = Prijava::find($id)->with('doktor')->with('pacijent')->with('ustanova')->with('vakcina')->first();
        return view('doktor.jedna-prijava',  [
            'prijava' => $prijava
        ]);
    }
}
