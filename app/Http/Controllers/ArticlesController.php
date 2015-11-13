<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Request;//-> To be able to use Facade and call Request::all statically

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
    	//$articles = Article::latest()->get();

        //-> ** Limit to "not display with published_at in the future"
        //$articles = Article::latest('published_at')->where('published_at', '<=', Carbon::now())->get();

        //-> Use the code before with "Eloquent"
        $articles = Article::latest('published_at')->published()->get();


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


    /**** Function to add a new article
        
    */
    //public function store(Requests\CreateArticleRequest $request){
    //-> If only want to use "Request" without Requests->CreateArticleRequest
    public function store(Request $request){
    	//$title = Request::get('title'); //-> *** To get specific value ** <-//

        /**** Validattion in case of not use "Requests\CreateArticleRequest"
        */
        $this->validate( $request, [
            'title' => 'required|min:3',
            'body' => 'required',
            'published_at' => 'required|date'
        ]);


    	//-> Get all inputs
    	//$input = Request::all();

        //-> Set "Published_at" manually
    	//$input['published_at'] = Carbon::now();
    	

    	/*$article = new Article();
    	$article->title = $input['title'];
    	$article->body = $inpt['body'];
    	$article->save();
    	*/

    	//-> **+ Create in 1 line ** 
    	//Article::create($input);
        //Article::create( $request::all() );
        Article::create( $request->all() );

    	return redirect('articles');
    }


    /**** Function to edit an article
    */
    public function edit($id){

        $article = Article::findOrFail($id);
        
        return view('articles.edit', compact('article'));
    }
}
