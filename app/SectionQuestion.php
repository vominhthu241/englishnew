<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionQuestion extends Model
{
    public $timestamps = true;
    protected $table = "section_question";

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    
    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
