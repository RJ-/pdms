<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcadRank extends Model
{
    protected $table = 'academic_rank';

    public function faculty()
    {
        return $this->hasMany('App\Faculty');
    }
}
