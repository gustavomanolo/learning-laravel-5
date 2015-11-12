<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;//-> To be able to use Facade and call Request::all statically

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ArticlesController extends Controller
{
    public function index(){
    	//return 'Get all articles';

    	//$articles = Article::all();

    	//-> To get articles order by "created_at" (by default), but can pass a colum name
    	$articles = Article::latest()->get();

    	//$articles = Article::order_by('created_at', 'desc')->get();


    	//return $articles;
    	return view('articles.index', compact('articles'));
    }

    public function show($id){
    	/*$article = Article::find($id);
    	if( is_null($article)){
    		abort(404);
    	}*/

    	//-> The previous code could be short with:
    	$article = Article::findOrFail($id);

    	return view('articles.show', compact('article'));
    }

    public function create(){
    	//return "hello";
    	return view('articles.create');
    }

    public function store(){
    	//$title = Request::get('title'); //-> *** To get specific value ** <-//

    	//-> Get all inputs
    	$input = Request::all();
    	//-> Set "Published_at" manually
    	$input['published_at'] = Carbon::now();
    	

    	/*$article = new Article();
    	$article->title = $input['title'];
    	$article->body = $inpt['body'];
    	$article->save();
    	*/

    	//-> **+ Create in 1 line ** 
    	Article::create($input);

    	return redirect('articles');
    }
}
