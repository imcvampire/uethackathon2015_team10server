<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Subject;
use App\Book;
use App\Person;
use App\User;
use App\Website;
use \Auth;

class SubjectsController extends Controller
{
    protected $user;
    public function __construct() {
        $this->user = Auth::user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
       // return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function storeWebsite(Request $request) {
        $id = $request->input('id');
        $website = $this->user->studied_websites()->where('id', $id);
        if ($website->count() > 0) {
            $website->detach($id);
            return 'Delete';
        }
        $this->user->studied_websites()->attach($id);
        return 'Done!';
    }

    public function moreWebsite(Request $request) {
        $number = $request->input('number');
        $websites = $subject->websites()->skip($number)->take(5)
                            ->orderBy('selected', 'desc')
                            ->orderBy('likes', 'desc')->get();
        return $websites;
    }

    public function storePerson(Request $request) {
        $id = $request->input('id');
        $person = $this->user->studied_persons()->where('id', $id);
        if ($person->count() > 0) {
            $person->detach($id);
            return 'Delete';
        }
        $this->user->studied_persons()->attach($id);
        return 'Done!';
    }

     public function morePersons(Request $request) {
        $number = $request->input('number');
        $persons = $subject->persons()->skip($number)->take(5)
                            ->orderBy('selected', 'desc')
                            ->orderBy('likes', 'desc')->get();
        return $websites;
    }

    public function storeBook(Request $request) {
        $id = $request->input('id');
        $book = $this->user->studied_books()->where('id', $id);
        if ($book->count() > 0) {
            $book->detach($id);
            return 'Delete';
        }
        $this->user->studied_books()->attach($id);
        return 'Done!';
    }

     public function moreBooks(Request $request) {
        $number = $request->input('number');
        $books = $subject->books()->skip($number)->take(5)
                            ->orderBy('selected', 'desc')
                            ->orderBy('likes', 'desc')->get();
        return $books;
    }

    public function storeSubject(Request $request) {
        $id = $request->input('id');
        $subject = $this->user->studied_subjects()->where('id', $id);
        if ($subjecct->count() > 0) {
            $subject->detach($id);
            return 'Delete';
        }
        $this->user->studied_subjects()->attach($id);
        return 'Done!';
    }

     public function moreSubjects(Request $request) {
        $number = $request->input('number');
        $recommend_subjects = $subject->recommend_subjects()->skip($number)->take(5)
                            ->orderBy('selected', 'desc')
                            ->orderBy('likes', 'desc')->get();
        return $recommend_subjects;
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::findOrFail($id);
        $persons = $subject->persons()->take(5)
                            ->orderBy('selected', 'desc')
                            ->orderBy('likes', 'desc')->get();
        $books = $subject->books()->take(5)
                            ->orderBy('selected', 'desc')
                            ->orderBy('likes', 'desc')->get();
        $websites = $subject->websites()->take(5)
                            ->orderBy('selected', 'desc')
                            ->orderBy('likes', 'desc')->get();
        $recommend_subjects = $subject->recommend_subjects()->take(5)
                            ->orderBy('selected', 'desc')
                            ->orderBy('likes', 'desc')->get();

        return view('subjects.show', compact(
            'subject', 
            'persons', 
            'books',
            'websites',
            'recommend_subjects'
        ));
    }

    public function edit($id)
    {
        // chi danh cho admin moi co the edit
        $subject = Subject::findOrFail($id);
        return view('subjects.edit')->with(['books' => $subject->books, 'persons' =>$subject->persons, 'websites' => $subject->websites]);
    }

    public function update(Request $request, $id)
    {
        $books = new Book($request->all());
        $persons = new Person($request->all());
        $websites = new Website($request->all());
        $subject = new Subject($request->all());

        Auth::user()->subjects()->save($subject);
        Auth::user()->books()->save($books);
        Auth::user()->persons()->save($persons);
        Auth::user()->website()->save($websites);
        return redirect('/subjects/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // chi danh cho admin
        $subject = Subject::findOrFail($id);
        $subject->delete();
        redirect('subjects');
    }
}
