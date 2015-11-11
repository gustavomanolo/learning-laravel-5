<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    //

    public function about(){
    	//return 'About page';

    	$name = "Gustavo Manolo";
    	//return view('pages.about')->with('name',$name);
    	/*return view('pages.about')->with([
    		'first' => "Gustavo",
    		'last' => "Manolo"
    	]);*/
    	//return view('pages.about', ['name'=>$name]);
		

		//--------- USE OF "COMPACT'S PHP FUNCTION" ----------
		$first = "Gustavo";
		$last = "Manolo";

		$people = [
			'Steve jobs',
			'Mark',
			'Bill Gates'
		];

		return view('pages.about', compact('first','last', 'people'));
    }

    public function contact(){
    	return view('pages.contact');
    }
}
