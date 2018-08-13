<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Author;
use App\Book;

class AuthorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // The functions authors(), addAuthor() and deleteAuthor() should be moved into a AuthorController.
    // Create a getAuthor() to return a single author and updateAuthor() to fully adhere to CRUD.

    public function authors()
    {
        $authors = Author::all();

        return view('authors', compact('authors'));
    }
    public function addAuthor(Request $request)
    {
	$request->validate(Author::$rules);
        $author = new Author;
        $author->name = $_POST['name'];
        $author->birthday = $_POST['birthday'];
        $author->biography = $_POST['biography'];
        $author->save();

        session()->flash('status', 'Author Added!');
        return redirect('authors');
    }
    public function deleteAuthor()
    {
	// check to see if the author exists first
	if( DB::table('authors')->where('id', $_POST['author_id'])->count())
	{
		DB::table('authors')->where('id', $_POST['author_id'])->delete();

		session()->flash('status', 'Author Deleted!');
	}
	else
	{
		session()->flash('status', 'Author Cannot Be Deleted!');
	}
        return redirect('authors');
    }
}
