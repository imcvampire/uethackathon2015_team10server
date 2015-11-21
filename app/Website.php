<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
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
    	return $this->belongsToMany('App\User', 'user_website', 'website_id', 'user_id')->withPivot('finish');
    }
}
