<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class PDactivity extends Model
{

  use Sortable;
  public $sortable = ['id', 'title', 'sponsor', 'details', 'dateFrom', 'createdBy', 'created_at', 'updated_at'];

  protected $table = 'p_dactivities';

  public function field()
  {
    return $this->belongsToMany('App\Field');
  }
  public function pdcategory()
  {
    return $this->belongsToMany('App\PDcategory');
  }
  public function faculty()
  {
    return $this->belongsToMany('App\Faculty');
  }
  public function trainingneed()
  {
    return $this->belongsTo('App\TrainingNeeds');
  }
  public function createdFac()
  {
    return $this->belongsTo('App\Faculty', 'createdBy', 'id');
  }
}
