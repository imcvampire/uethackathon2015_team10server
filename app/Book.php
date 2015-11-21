<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	protected $fillable = [
		'name',
		'author',
		'publisher',
		'intro',
		'likes',
		'selected',
		'creator_id',
		'subject_id',
	];

    public function creator() {
    	return $this->belongsTo('App\User');
    }

    public function subject() {
    	return $this->belongsTo('App\Subject');
    }

    public function users() {
    	return $this->belongsToMany('App\User', 'book_user', 'book_id', 'user_id')->withPivot('finish');
    }
}
