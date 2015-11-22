<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'skype', 
        'disqus', 
        'avatar'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function created_subjects() {
        return $this->hasMany('App\Subject', 'creator_id');
    }

    public function studied_subjects() {
        return $this->belongsToMany('App\Subject')->withPivot('finish');
    }

    public function created_books() {
        return $this->hasMany('App\Book', 'creator_id');
    }

    public function created_websites() {
        return $this->hasMany('App\Website', 'creator_id');
    }

    public function created_persons() {
        return $this->hasMany('App\Person', 'creator_id');
    }

    public function studied_books() {
        return $this->belongsToMany('App\Book', 'book_user', 'user_id', 'book_id')->withPivot('finish');
    }

    public function studied_websites() {
        return $this->belongsToMany('App\Website', 'user_website', 'user_id', 'website_id')->withPivot('finish');
    }

    public function studied_persons() {
        return $this->belongsToMany('App\Person', 'person_user', 'user_id', 'person_id');
    }

    public function notes() {
        return $this->hasMany('App\Note');
    }
}

