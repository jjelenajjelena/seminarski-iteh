<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vakcina extends Model
{
    protected $table = 'vakcina';
    

    public function prijave()
    {
        return $this->hasMany('App\Prijava', 'vakcina_id', 'id');
    }
}
