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
    }

    public function create()
    {
        return view('subjects.create');
    }
    public function websiteLike(Request $request) {
        $id = $request->input('id');
        $website = Website::findOrFail($id);
        $website->likes++;
        $website->save();
    }

    public function subjectLike(Request $request) {
        $id = $request->input('id');
        $subject = Subject::findOrFail($id);
        $subject->likes++;
        $subject->save();
    }

    public function bookLike(Request $request) {
        $id = $request->input('id');
        $book = Website::findOrFail($id);
        $book->likes++;
        $book->save();
    }

    public function personLike(Request $request) {
        $id = $request->input('id');
        $person = Person::findOrFail($id);
        $person->likes++;
        $person->save();
    }


    public function storeWebsite(Request $request) {
        $id = $request->input('id');
        $website = Website::findOrFail($id);
        $w = $this->user->studied_websites()->where('id', $id);
        if ($w->count() > 0) {
            $w->detach($id);
            $website->selected--;
            $website->save();
            return 'Delete';
        }
        $this->user->studied_websites()->attach($id);
        $website->selected++;
        $website->save();
        return 'Done!';
    }

     public function storePerson(Request $request) {
        $id = $request->input('id');
        $person = $this->user->studied_persons()->where('id', $id);
        if ($person->count() > 0) {
            $person->detach($id);
            $person->selected--;
            $person->save();
            return 'Delete';
        }
        $this->user->studied_persons()->attach($id);
        $person->selected++;
        $person->save();
        return 'Done!';
    }

    public function storeBook(Request $request) {
        $id = $request->input('id');
        $book = $this->user->studied_books()->where('id', $id);
        if ($book->count() > 0) {
            $book->selected--;
            $book->save();
            $book->detach($id);
            return 'Delete';
        }
        $this->user->studied_books()->attach($id);
        $book->selected++;
        $book->save();
        return 'Done!';
    }

    public function storeSubject(Request $request) {
        $id = $request->input('id');
        $subject = $this->user->studied_subjects()->where('id', $id);
        if ($subject->count() > 0) {
            $subject->selected--;
            $subject->save();
            $subject->detach($id);
            return 'Delete';
        }
        $this->user->studied_subjects()->attach($id);
        $subject->selected++;
        $subject->save();
        return 'Done!';
    }


     public function morePersons(Request $request) {
        $id = $request->input('id');
        $subject = Subject::findOrFail($id);
        $persons = $subject->persons()
                            ->orderBy('selected', 'desc')
                            ->orderBy('likes', 'desc')->get();
        if ($this->user != null) {
            foreach ($persons as $person)
                if ($this->user->studied_persons()->find($person->id) != null)
                    $person->studied = true;
                else $person->studied = false;
        }

        return $persons;
    }

    public function moreWebsites(Request $request) {
        $id = $request->input('id');;
        $subject = Subject::findOrFail($id);
        $websites = $subject->websites()
                            ->orderBy('selected', 'desc')
                            ->orderBy('likes', 'desc')->get();
        if ($this->user != null) {
            foreach ($websites as $website)
                if ($this->user->studied_websites()->find($website->id) != null)
                    $website->studied = true;
                else $website->studied = false;
        }


        return $websites;
    }

     public function moreBooks(Request $request) {
        $id = $request->input('id');
        $subject = Subject::findOrFail($id);
        $books = $subject->books()
                            ->orderBy('selected', 'desc')
                            ->orderBy('likes', 'desc')->get();
        if ($this->user != null) {
            foreach ($books as $book)
                if ($this->user->studied_books()->find($book->id) != null)
                    $book->studied = true;
                else $book->studied = false;
        }
        return $books;
    }

     public function moreSubjects(Request $request) {
        $id = $request->input('id');
        $subject = Subject::findOrFail($id);
        $subjects = $subject->recommend_subjects()
                            ->orderBy('selected', 'desc')
                            ->orderBy('likes', 'desc')->get();
        if ($this->user != null) {
            foreach ($subjects as $subject)
                if ($this->user->studied_subjects()->find($subject->id) != null)
                    $subject->studied = true;
                else $subject->studied = false;
        }
        return $subjects;
    }

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

    public function add_book($id){
        return view ('items.add_book', compact('id'));
    }

    public function add_website($id){
        return view ('items.add_website', compact('id'));
    }
    public function add_person($id){
        return view ('items.add_person', compact('id'));
    }

    public function save_book(Request $request, $id){
        $subject = Subject::findOrFail($id);
        $book = new Book($request->all());
        $subject->books()->save($book);
        \Auth::user()->studied_books()->save($book);
        session()->flash('info', 'Thêm sách thành công!');
        return redirect('subjects/'.$id);
    }

    public function save_website(Request $request, $id){
        $subject = Subject::findOrFail($id);
        $website = new Website($request->all());
        $subject->books()->save($website);
        \Auth::user()->studied_books()->save($website);
        session()->flash('info', 'Thêm website thành công!');
        return redirect('subjects/'.$id);
    }
    public function save_person(Request $request, $id){
        $subject = Subject::findOrFail($id);
        $person = new Person($request->all());
        $subject->books()->save($person);
        \Auth::user()->studied_books()->save($person);
        session()->flash('info', 'Thêm chuyên gia thành công!');
        return redirect('subjects/'.$id);
    }
}
