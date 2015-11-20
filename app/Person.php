<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
	protected $table = 'persons';
	
    protected $fillable = [
    	'link',
    	'name',
    	'intro',
    	'creator_id',
    	'subject_id',
    	'likes',
    	'selected',
    ];

    public function creator() {
    	return $this->belongsTo('App\User');
    }

    public function subject() {
    	return $this->belongsTo('App\Subject');
    }

    public function users() {
    	return $this->belongsToMany('App\User', 'person_user', 'user_id', 'person_id');
    }
}
