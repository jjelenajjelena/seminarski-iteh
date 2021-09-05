<?php

namespace App\Http\Controllers;

use App\Prijava;
use App\User;
use App\Ustanova;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PrijavaController extends Controller
{
    public function get(Request $request)
    {
        $prijave = Prijava::selectRaw('year(FROM_UNIXTIME(zakazano_u)) year, monthname(FROM_UNIXTIME(zakazano_u)) month, count(*) data')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->get();
        return response()->json(['prijave' => $prijave]);
    }


    public function getDatatable()
    {
        $getData = Prijava::with('pacijent')
            ->with('ustanova')
            ->with('doktor')
            ->with('vakcina')->get();

        foreach ($getData as $key => $value) {
            $value['zakazano_u'] = date('d.m.y h:i', $value['zakazano_u']);
        }
        $datatable = DataTables::of($getData)->make(true);
        return $datatable;
    }

    public function createPrijava(Request $request)
    {
        $korisnik = Auth::user();
        $korisnikovaPrijava = $korisnik->prijava;

        $prijave = Prijava::where('ustanova_id', $request->ustanovaId)
            ->where('vakcina_id', $request->vakcinaId)
            ->orderBy('zakazano_u', 'ASC')
            ->get();
        $pocetnoVreme = 1626328800;
        $slobodnoVreme = $pocetnoVreme;
        $brPrijava = count($prijave);
        foreach ($prijave as $i => $prijava) {
            if ($pocetnoVreme != $prijava->zakazano_u) {
                $slobodnoVreme = $pocetnoVreme;
                break;
            }
            $pocetnoVreme = $pocetnoVreme + 900;
            if ($i == $brPrijava - 1)
                $slobodnoVreme = $pocetnoVreme;
        }
        if ($korisnikovaPrijava) {
            return response()->json([
                'poruka' => 'Vi ste vec prijavljeni da se vakcinisete u: ' .
                    date('d.m.Y h:i', $korisnikovaPrijava->zakazano_u),
                'zakazano_u' => $korisnikovaPrijava->zakazano_u,
                'prijava_id' => $korisnikovaPrijava->id,
                'novoVremeFormat' => date('d.m.Y h:i', $slobodnoVreme),
                'novoVreme' => $slobodnoVreme,
                'postoji' => true
            ]);
        }

        $doktori = User::select('id')->where('uloga_id', 2)
            ->where('ustanova_id', $request->ustanovaId)
            ->where('vakcina_id', $request->vakcinaId)
            ->get();

        $doktoriIds = $doktori->map(
            function ($items) {
                return $items->id;
            }
        );

        $path = null;
        if ($request->hasFile('slika')) {
            $slika = $request->file('slika');
            $naziv = time() . '.' . $slika->getClientOriginalExtension();

            $path = $slika->storeAs('', $naziv, 'public');
        };

        $uspesnaPrijava = Prijava::insert(
            [
                'napomena' => $request->napomena && "",
                'zakazano_u' => $slobodnoVreme,
                'pacijent_id' => $korisnik->id,
                'doktor_id' => $doktoriIds[rand(0, count($doktoriIds) - 1)],
                'ustanova_id' => $request->ustanovaId,
                'slika_licne_karte' => $path,
                'vakcina_id' => $request->vakcinaId
            ]
        );
        if ($uspesnaPrijava) {
            return response()->json(['poruka' => 'Prijavili ste se za vakcinaciju. Dodjite ' . date('d.m.Y h:i', $slobodnoVreme), 'postoji' => false]);
        }
        return response()->json(['poruka' => 'Doslo je do greske..', 'postoji' => false]);
    }

    public function updatePrijava(Request $request, Prijava $prijava)
    {
        if (!$prijava) return response()->json(['poruka' => 'Doslo je do greske..'], 200);
        $prijava->zakazano_u = $request->novoVreme;
        $prijava->save();

        return response()->json(['poruka' => 'Uspesno ste promenili prijavu.' . date('d.m.Y h:i', $request->novoVreme)]);
    }
    public function updateDoktor(Request $request, Prijava $prijava)
    {
        if (!$prijava) return response()->json(['poruka' => 'Doslo je do greske..'], 200);
        $prijava->doktor_id = $request->user()->id;
        $prijava->save();

        return response()->json(['poruka' => 'Uspesno ste dodelili pacijenta sebi.']);
    }

    public function delete(Prijava $prijava)
    {
        $prijava->delete();
        return response()->json(['poruka' => 'Uspesno ste obrisali prijavu.']);
    }

    public function moje()
    {
        $prijave = Auth::user()->obaveze()->with('pacijent')->orderBy('zakazano_u', 'asc')->get();

        return response()->json(['prijave' => $prijave]);
    }
    public function mojaPrijava()
    {
        $prijava = Auth::user()->prijava()->with('doktor')->with('pacijent')->with('ustanova')->with('vakcina')->first();

        return response()->json(['prijava' => $prijava]);
    }
}
