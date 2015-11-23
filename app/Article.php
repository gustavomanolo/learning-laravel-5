<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
    	'title',
    	'body',
    	'published_at',
		'user_id' // Temporary
    ];


    //-> *** TO TRANSFORM TO "CARBON INSTANCE" CUSTOM DATES ** <-//
    protected $dates = ['published_at'];


    /*
    	*** MUTATOR *** 
    		http://laravel.com/docs/5.1/eloquent-mutators#accessors-and-mutators
    	Follow convention "set"+"columnName(camel case)"+"Attribute"
    */
    public function setPublishedAtAttribute( $date ){
    	//-> This sets current hour if is not set
    	//$this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);

    	//-> Sets 00:00:00 if no hour is set
    	$this->attributes['published_at'] = Carbon::parse($date);
    }

    /***** CREATE A "QUERY SCOPE"
    	http://laravel.com/docs/5.1/eloquent#query-scopes
    	Scopes allow you to define common sets of constraints that you may easily re-use throughout your application
    	convention => "scope"+"Name (function name to use in controller)"
    */
    function scopePublished( $query ){
    	$query->where('published_at', '<=', Carbon::now());
    }


    /***** CREATE A "QUERY SCOPE"
    	convention => "scope"+"Name (function name to use in controller)"
    */
    function scopeUnpublished( $query ){
    	$query->where('published_at', '>', Carbon::now());
    }


	/**
	 * An article is owned by a user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(){
		return $this->belongsTo('User');
	}

}
