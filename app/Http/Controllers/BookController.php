<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Author;
use App\Book;

class BookController extends Controller
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

    // The functions books(), addBook() and deleteBook() should be moved into a BookController.
    // Create a getBook() to return a single author and updateBook() to fully adhere to CRUD.

    public function books()
    {
        $books = Book::all();

        return view('books', compact('books'));
    }
    public function addBook(Request $request)
    {
		$request->validate(Book::$rules);

        $book = new Book;
        $book->title = $_POST['title'];
        $book->author_id = $_POST['author_id'];
        $book->publication_date = $_POST['publication_date'];
        $book->description = $_POST['description'];
        $book->pages = $_POST['pages'];
        $book->save();

        session()->flash('status', 'Book Added!');
        return redirect('books');
    }
    public function deleteBook()
    {
        // check to see if the book exists first
        if( DB::table('books')->where('id', $_POST['book_id'])->count())
        {
                DB::table('books')->where('id', $_POST['book_id'])->delete();

                session()->flash('status', 'Book Deleted!');
        }
        else
        {
                session()->flash('status', 'Book Cannot Be Deleted!');
        }
        return redirect('books');
    }
}
