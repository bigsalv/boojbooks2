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
                <div class="card-header">Add Author</div>

                <div class="card-body">
                    <form method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" type="text" class="form-control{{ $errors->has('name')? ' is-invalid':''}}" id="name" placeholder="Author Name" value="{{ old('name') }}">
				@if($errors->has('name'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
				@endif

                        </div>
                        <div class="form-group">
                            <label for="birthday">Birthday</label>
                            <input name="birthday" type="text" class="form-control{{ $errors->has('birthday')? ' is-invalid':''}}" id="birthday" placeholder="YYYY-MM-DD Format" value="{{old('birthday')}}">
				@if($errors->has('birthday'))
				<span class="invalid-feedback">
					<strong>{{ $errors->first('birthday') }}</strong>
				</span>
				@endif
                        </div>
                        <div class="form-group">
                            <label for="biography">Biography</label>
                            <textarea name="biography"class="form-control" id="biography" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

            <hr />

            <div class="card">
                <div class="card-header">Author List</div>

                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Birthday</th>
                                <th scope="col">Book Count</th>
                                <th scope="col">Biography</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($authors as $author)
                            <tr>
                                <td>{{ $author->name }}</td>
                                <td>{{ $author->birthday }}</td>
                                <td>{{ $author->books->count() }}</td>
                                <td>{{ $author->biography }}</td>
                                <td>
					<form method="POST" action="{{ url('/authors/delete/') }}">
					{{ csrf_field() }}
					<input type="hidden" value="{{$author->id}}" name="author_id"/>
					<button type="submit" class="btn btn-sm btn-outline-primary">Delete Author</button>
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
