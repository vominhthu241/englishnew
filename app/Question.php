<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    public $timestamps = true;
    protected $table = "question";

    public function type() {
        return $this->belongsTo(Type::class);
    }
}
