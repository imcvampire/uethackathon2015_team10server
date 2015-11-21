<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Auth;
use App\User;

class UsersController extends Controller
{
	protected $user;

	public function __construct() {
		$this->user = Auth::user();
	}

    public function show()
    {
        $user = $this->user;

        $books = $user->studied_books()->get();
        $persons = $user->studied_persons()->get();
        $websites = $user->studied_websites()->get();

    	$subjects0 = $user->studied_subjects()->where('finish', 0)->get();
    	$subjects1 = $user->studied_subjects()->where('finish', 1)->get();

        return view('users.profile', compact(
        	'user', 
        	'books', 
        	'websites',
        	'persons',
        	'subjects0',
        	'subjects1'
        ));
    }

    public function view_profile($id) {
    	$user = User::findOrFail($id);

    	return view('users.view_profile', compact('user'));
    }

    public function edit($id)
    {
        return view('user.edit');
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $user->save($request->all());
        return view('user.view', compact('user'));
    }
}
