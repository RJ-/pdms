<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducCategory extends Model
{
  protected $table = 'educ_categories';

  public function educbackground()
  {
    return $this->hasMany('App\EducBackground');
  }
}
