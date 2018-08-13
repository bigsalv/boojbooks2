@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">Add Book</div>

                <div class="card-body">
                    <form method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input name="title" type="text" class="form-control{{ $errors->has('title')? ' is-invalid':''}}" id="title" placeholder="Book Title" value="{{ old('title') }}">
				@if($errors->has('title'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('title') }}</strong>
				</span>
				@endif
                        </div>
                        <div class="form-group">
                            <label for="author_id">Author</label>
                            <select name="author_id" class="form-control{{ $errors->has('author_id')? ' is-invalid':''}}" id="author_id">
                                @foreach (\App\Author::all() as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                            </select>
				@if($errors->has('author_id'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('author_id') }}</strong>
				</span>
				@endif
                        </div>
                        <div class="form-group">
                            <label for="publication_date">Publication Date</label>
                            <input name="publication_date" type="text" class="form-control{{ $errors->has('publication_date')? ' is-invalid':''}}" id="publication_date" placeholder="YYYY-MM-DD Format" value="{{old('publication_date')}}">
				@if($errors->has('publication_date'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('publication_date') }}</strong>
				</span>
				@endif
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description"class="form-control{{ $errors->has('description')? ' is-invalid':''}}" id="description" rows="3">{{old('description')}}</textarea>
				@if($errors->has('description'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('description') }}</strong>
				</span>
				@endif
                        </div>
                        <div class="form-group">
                            <label for="pages">Page Count</label>
                            <input name="pages" type="text" class="form-control{{ $errors->has('pages')? ' is-invalid':''}}" id="pages" placeholder="Enter a number only" value="{{old('pages')}}">
				@if($errors->has('pages'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('pages') }}</strong>
				</span>
				@endif
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

            <hr />

            <div class="card">
                <div class="card-header">Book List</div>

                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Publication Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Page Count</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author->name }}</td>
                                <td>{{ $book->publication_date }}</td>
                                <td>{{ $book->description }}</td>
                                <td>{{ $book->pages }}</td>
                                <td>
					<form method="POST" action="{{ url('/books/delete/') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{$book->id}}" name="book_id"/>
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Delete Book</button>
                                        </form>

				</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready( function () {
    $('.table').DataTable();
});
</script>

@endsection
