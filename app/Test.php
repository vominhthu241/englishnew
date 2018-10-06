<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //
    public $timestamps = true;
    protected $table = "test";
    
    public function section()
    {
        return $this->belongsToMany(Section::class);
    }

}
