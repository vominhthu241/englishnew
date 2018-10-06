<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    public $timestamps = true;
    protected $table = "section";

    public function type() {
        return $this->belongsTo(Type::class);
    }
}
