<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestSection extends Model
{
    public $timestamps = true;
    protected $table = "test_section";
    
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
