@extends('Goodi.nav_bar')

@section('main')
    <br><br>
    <form action="/category/edit/{id}" class="create-form" method="POST">
        <h2>Edit Account</h2><br><br>
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
        <input type="hidden" name="id" value="{{ $category->id }}" name="id" class="form-control" id="id">
        <div class="form-group">
            <label for="title" class="font-weight-bold">Title</label>
            <input type="text" value="{{ $category->title }}" name="title" class="form-control" id="title"
                aria-describedby="name">
        </div>
        <div class="form-group">
            <label for="description" class="font-weight-bold">Description</label>
            <input type="longText" value="{{ $category->description }}" name="description" class="form-control"
                id="description" aria-describedby="description">
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
        <a class="btn btn-danger" href="/category/index">Back</a>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    @include('Goodi.footer')
@endsection
