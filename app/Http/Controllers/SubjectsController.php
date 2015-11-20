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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // $id cua subject
        $books = new Book($request->all());
        $persons = new Person($request->all());
        $websites = new Website($request->all());
        $subject = new Subject($request->all());

        Auth::user()->subjects()->save($subject);
        Auth::user()->books()->save($books);
        Auth::user()->persons()->save($persons);
        Auth::user()->website()->save($websites);
        return redirect('/subjects/'.$subject->id);

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
            'websites'
            //'recommend_subjects'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // chi danh cho admin moi co the edit
        $subject = Subject::findOrFail($id);
        return view('subjects.edit')->with(['books' => $subject->books, 'persons' =>$subject->persons, 'websites' => $subject->websites]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
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
