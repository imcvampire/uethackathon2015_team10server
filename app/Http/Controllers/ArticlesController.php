<?php

namespace App\Http\Controllers;

use App\Article;
use App\Subject;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use \Auth;

use App\Http\Requests\ArticleRequest;

class ArticlesController extends Controller
{

    public function __construct(){
        $this->middleware('auth', ['only' => 'create']);
    }

    public function ask() {
        return view('articles.ask');
    }

    // save comment to an article
    public function saveComment(Request $request, $id){
        $article = Article::findOrFail($id);
        $comment = new Comment($request->all());
        $comment->user_id = Auth::user()->id;
        $comment->article_id = $id;
        $comment->save();
        return redirect('articles/'.$id);
    }

    public function index()
    {
        $articles = Article::latest()->get();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(ArticleRequest $request)
    {
        $article = new Article($request->all());
        Auth::user()->articles()->save($article);
        return redirect('articles');
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        if(Auth::user() == $article->user){
            return view('articles.edit', compact('article'));
        } else{
            return redirect('articles');
        }
    }

    public function update(ArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());
        return redirect('articles');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect('articles');
    }
}
