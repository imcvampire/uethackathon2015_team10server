<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['user_id', 'content'];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
