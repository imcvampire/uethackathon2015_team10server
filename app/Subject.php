<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
    	'name'
    ];

    public function creator() {
    	return $this->belongsTo('App\User');
    }

    public function users() {
    	return $this->belongsToMany('App\User')->withPivot('finish');
    }

    public function recommend_subjects() {
    	return $this->belongsToMany('App\Subject', 'subject_subject', 'main_subject_id', 'recommend_subject_id');
    }

    public function advanced_subjects() {
    	return $this->belongsToMany('App\Subject', 'subject_subject', 'recommend_subject_id', 'main_subject_id');
    }

    public function books() {
    	return $this->hasMany('App\Book');
    }

    public function websites() {
    	return $this->hasMany('App\Website');
    }

    public function persons() {
    	return $this->hasMany('App\Person');
    }
}