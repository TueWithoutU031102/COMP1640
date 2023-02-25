@extends('Goodi.nav_bar')

@section('main')
    <br><br>
    <form action="/category/create" class="create-form" method="POST">
        <h2>Create Category</h2><br><br>
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mb-3">
            <label for="title" class="font-weight-bold">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title"
                aria-describedby="title">
        </div>
        <div class="form-group">
            <label for="description" class="font-weight-bold">Description</label>
            <input type="longText" name="description" value="{{ old('description') }}" class="form-control" id="description"
                aria-describedby="description">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href='/category/index'>
        <button type="submit" class="btn btn-primary">Back</button>
    </a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
