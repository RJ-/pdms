<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class TrainingNeeds extends Model
{
    protected $table = 'training_needs';

    use Sortable;
    public $sortable = ['id', 'name'];

    public function faculty()
    {
        return $this->belongsToMany('App\Faculty');
    }
    public function pdactivity()
    {
        return $this->hasMany('App\PDactivity');
    }
}
