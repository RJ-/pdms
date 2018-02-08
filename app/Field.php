<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public function faculty()
    {
        // return $this->belongsToMany('App\Faculty', 'faculty_field', 'field_id', 'faculty_id');
        return $this->belongsToMany('App\Faculty');
    }
    public function activity()
    {
        // return $this->belongsToMany('App\Faculty', 'faculty_field', 'field_id', 'faculty_id');
        return $this->belongsToMany('App\PDactivity');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
