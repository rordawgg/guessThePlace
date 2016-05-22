<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
    	"name_id", 'difficulty', 'path'
    ];

    public function name()
    {
    	return $this->belongsTo('App\Name');
    }

}
