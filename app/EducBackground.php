<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class EducBackground extends Model
{
  protected $table = 'educ_backgrounds';

  use Sortable;
  public $sortable = ['id', 'faculty_id', 'educ_category_id'];

  public function faculty()
  {
    return $this->belongsTo('App\Faculty');
  }

  public function category()
  {
    return $this->belongsTo('App\EducCategory', 'educ_category_id');
  }
}
