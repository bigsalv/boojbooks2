<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
	public static $rules = [
		'name' => 'required|max:255',
		'birthday' => 'required|date_format:"Y-m-d"',
	];
    public function books()
    {
        return $this->hasMany('App\Book');
    }
}
