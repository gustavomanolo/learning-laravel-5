<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
//use Request;//-> To be able to use Facade and call Request::all statically

use App\Article;
use App\User;
use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;

class ArticlesController extends Controller
{
    public function __construct()
    {
        /*-> The 'auth' is from "Kernel.php" -> $routeMiddleware
            //-> Can use 'except' to apply to every function except that one
        */
        $this->middleware('auth', ['only' => 'create']);
        //$this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(){

        //return \Auth::user()->toArray();

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

    //-> Changed to use "Route-model-binding" so then receive an intance of the model
    public function show(Article $article){
    //public function show($id){
    	/*$article = Article::find($id);
    	if( is_null($article)){
    		abort(404);
    	}*/

    	//-> The previous code could be short with:
    	//$article = Article::findOrFail($id); //-> Don't use anymore because of "Route-model-binding"

    	return view('articles.show', compact('article'));
    }

    public function create(){

        /*
         * if (Auth::guest()){
         *  return redirect('articles');
         * }
         *
         **/


        $tags = Tag::lists('name', 'id');//-> The second argument says to use "key" value as "name"->column

    	//return "hello";
    	return view('articles.create', compact('tags'));
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

        //$article = new Article( $request->all() );


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
        //Article::create( $request->all() );

        //Auth::user()->articles()->save( $article );

        $newArticle = Auth::user()->articles()->create( $request->all() );

        //-> Attach tag ids to the new article (** UPDATE PIVOT TABLE ** <-//
        $tagIds = $request->input('tag_list');

        //-> The "attach" method only adds relationships but don't remove old ones so better use "sync"
        $newArticle->tags()->attach( $tagIds );

        //\Session::flash('flash_message', "Your article has been created");
        /*session()->flash('flash_message', "Your article has been created");
        session()->flash('flash_message_important', true);*/

        return redirect('articles')->with([
            'flash_message' =>  "Your article has been created",
            'flash_message_important' => true
        ]);
    }


    /**** Function to edit an article
    */
    //-> Changed to use "Route-model-binding" so then receive an intance of the model
    public function edit(Article $article){
    //public function edit($id){
        //$article = Article::findOrFail($id);

        $tags = Tag::lists('name', 'id');//-> The second argument says to use "key" value as "name"->column

        return view('articles.edit', compact('article', 'tags'));
    }

    //-> Changed to use "Route-model-binding" so then receive an intance of the model
    public function update(Article $article, ArticleRequest $request){
        //public function update( $id, ArticleRequest $request ){
        //$article = Article::findOrFail($id);

        $article->update( $request->all() );

        //-> Update tags "pivot table"
        $article->tags()->sync( $request->input('tag_list') );

        return redirect('articles');
    }
}
