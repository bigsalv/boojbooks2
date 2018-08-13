<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	public static $rules = [
		'title' => 'required|max:255',
		'author_id' => 'required|exists:authors,id',
		'pages' => 'required|integer|min:1',
		'publication_date' => 'required|date_format:"Y-m-d"',
	];
    public function author()
    {
        return $this->belongsTo('App\Author');
    }
}
