<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    public $timestamps = true;
    protected $table = "answers";

    public function question() {
        return $this->belongsTo(Question::class);
    }
}
