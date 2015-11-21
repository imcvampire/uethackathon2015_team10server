<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Auth;

class UsersController extends Controller
{
	protected $user;

	public function __construct() {
		$this->user = Auth::user();
	}

    public function show()
    {
        $user = $this->user;

        $books = $user->studied_books();
        $persons = $user->studied_persons()->get();
        $websites = $user->studied_websites();

    	$subjects = $user->studied_subjects();

        return view('users.profile', compact(
        	'user', 
        	'books', 
        	'websites',
        	'persons',
        	'subjects'
        ));
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
