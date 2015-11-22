<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Auth;

class UsersController extends Controller
{
	protected $user;

	public function __construct() {
		$this->user = Auth::user();
	}

    public function show()
    {
        if (Auth::user() == null)
            return redirect('/');
        $user = $this->user;

        $books = $user->studied_books()->get();
        $persons = $user->studied_persons()->get();
        $websites = $user->studied_websites()->get();


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

    public function moreBooks() {
        $books = $this->user->studied_books()->where('finish', 0)->get();
        foreach ($books as $book) {
            $book->subject = $book->subject;
        }
        return $books;
    }

    public function removeBook(Request $request) {
        $book_id = $request->input('id');
        $finish = DB::table('book_user')->where('user_id', $this->user->id)
                        ->where('book_id', $book_id)->get()[0]->finish;

        DB::table('book_user')->where('user_id', $this->user->id)
                        ->where('book_id', $book_id)
                        ->update(['finish' => 1 - $finish]);
    }

    public function moreWebsites() {
        $websites = $this->user->studied_websites()->where('finish', 0)->get();
        foreach ($websites as $website) {
            $website->subject = $website->subject;
        }
        return $websites;
    }

    public function removeWebsite(Request $request) {
        $website_id = $request->input('id');
        $finish = DB::table('user_website')->where('user_id', $this->user->id)
                        ->where('website_id', $website_id)->get()[0]->finish;

        DB::table('user_website')->where('user_id', $this->user->id)
                        ->where('website_id', $website_id)
                        ->update(['finish' => 1 - $finish]);
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
