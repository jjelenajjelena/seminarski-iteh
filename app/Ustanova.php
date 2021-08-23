<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ustanova extends Model
{
    protected $table = 'ustanova';
    public function prijave()
    {
        return $this->hasMany('App\Prijava', 'ustanova_id', 'id');
    }

}
