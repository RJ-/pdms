<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class CollegeCampus extends Model
{
  use Sortable;
  public $sortable = ['id', 'name', 'abbrv'];

  public function faculty()
  {
      return $this->hasMany('App\Faculty');
  }
  public function dean()
  {
      return $this->belongsToMany('App\Faculty');
  }
}
