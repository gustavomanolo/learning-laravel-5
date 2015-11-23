<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

/**
 * Class CreateArticleRequest
 * @package App\Http\Requests
 * Had a name before of "CreateArticleRequest.php but this only made validations for the "create" method, changing the name to "ArticleRequest" make validations for all kind of controller functions
 */

class ArticleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //-> Diabled rules at the time
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'body' => 'required',
            'published_at' => 'required|date'
        ];
    }
}
