<?php

use App\Prijava;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrijavaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        for ($i = 1; $i <= 50; $i++) {

            $ustanovaId = rand(1, 3);
            $vakcinaId = rand(1, 3);
            $korisnik = User::find($i);
            if ($korisnik->imaUlogu('pacijent'))
                Prijava::insert([
                    'ustanova_id' => $ustanovaId,
                    'pacijent_id' => $i,
                    'doktor_id' => $this->getRandomDoktora($ustanovaId, $vakcinaId),
                    'vakcina_id' => $vakcinaId,
                    'zakazano_u' => $this->getPoslednjaPrijava($ustanovaId, $vakcinaId)
                ]);
        }
    }

    public function getPoslednjaPrijava($ustanovaId, $vakcinaId)
    {
        $result = DB::table('prijava')
            ->select('zakazano_u')
            ->where('ustanova_id', $ustanovaId)
            ->where('vakcina_id', $vakcinaId)
            ->orderBy('zakazano_u', 'desc')
            ->limit(1)
            ->get();
        if (count($result)) {
            return $result[0]->zakazano_u + 900;
        }
        return 1632241023;  // Thu Jul 15 2021 06:00:00 GMT+0000 (https://www.unixtimestamp.com/index.php)

    }
    public function getRandomDoktora($ustanovaId, $vakcinaId)
    {
        $doktor = User::select('id')->where('uloga_id', 2)
            ->where('ustanova_id', $ustanovaId)
            ->where('vakcina_id', $vakcinaId)
            ->inRandomOrder()
            ->first();
        return $doktor['id'];
    }
}
