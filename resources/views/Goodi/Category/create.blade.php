@extends('Master.Master')

@section('main')
<div id="preloader"></div>
    @include('Goodi.nav_bar')
    <br><br>
    <section class="form-body">
        <div class="form-container">
            <div class="form-title">Create Category</div>
            <form action="/category/create" method="POST">
                @csrf
                <br>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-content">
                    <div class="input-box">
                        <label for="title" class="font-weight-bold">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                        id="title" aria-describedby="title">
                    </div>
                    <div class="input-box">
                        <label for="description" class="font-weight-bold">Description</label>
                        <input type="longText" name="description" value="{{ old('description') }}"
                            id="description" aria-describedby="description">
                    </div>
                </div>
                <div class="button-action">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-danger" href='/category/index'>Back</a>
                </div>
            </form>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    @include('Goodi.footer')
@endsection
