<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prijava extends Model
{
    protected $table = 'prijava';

    public function pacijent()
    {
        return $this->belongsTo('App\User', 'pacijent_id', 'id');
    }
    public function doktor()
    {
        return $this->belongsTo('App\User', 'doktor_id', 'id');
    }
    public function ustanova()
    {
        return $this->belongsTo('App\Ustanova', 'ustanova_id', 'id');
    }

    public function vakcina()
    {
        return $this->belongsTo('App\Vakcina',  'vakcina_id', 'id');
    }
}
