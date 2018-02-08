<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PDcategory extends Model
{
    protected $table = 'p_dcategories';

    public function pdactivity()
    {
      return $this->hasMany('App\PDactivity');
    }
}
