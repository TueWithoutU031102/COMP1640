@extends('Goodi.nav_bar')

@section('main')
    <br>
    <h1 class="display-4" style="text-align: center; font-weight: bold">CATEGORY INFORMATION</h1><br>
    <div class="user-card">
        <div class="user-information">
            <h2>{{ $category->title }}</h2>
            <p><span>Description: </span>{{ $category->description }}</p>
            <p><span>Author:</span>{{ $name }}<p>
            <a href="/category/index">
                <button class="btn btn-primary">Back</button>
            </a>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    @include('Goodi.footer')
@endsection
