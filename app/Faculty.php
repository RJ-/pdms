<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

use Kyslik\ColumnSortable\Sortable;

class Faculty extends Model implements AuthenticatableContract
{
  use Authenticatable;
  use Notifiable;

  use Sortable;
  public $sortable = ['id', 'surname', 'college_id', 'acadrank_id'];

  public function educbackground()
  {
    return $this->hasMany('App\EducBackground');
  }

  public function field()
  {
    return $this->belongsToMany('App\Field');
  }

  public function college()
  {
    return $this->belongsTo('App\CollegeCampus');
  }

  public function activity()
  {
    return $this->belongsToMany('App\PDactvity');
  }

  public function needs()
  {
    return $this->belongsToMany('App\TrainingNeeds');
  }

  public function dean()
  {
    return $this->belongsTo('App\CollegeCampus');
  }

  public function acadrank()
  {
    return $this->belongsTo('App\AcadRank');
  }
}
