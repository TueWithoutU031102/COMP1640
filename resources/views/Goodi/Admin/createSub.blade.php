@extends('Goodi.Admin.admin_navbar')

@section('main')
    <h1>Create Submission</h1>
    <form action="/admin/createSub" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="name" name="name" class="form-control" id="name" aria-describedby="name">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="longText" name="description" class="form-control" id="description"
                aria-describedby="description">
        </div>
        <div class="mb-3">
            <label for="dateStarted" class="form-label">Date Started</label>
            <input type="datetime-local" name="dateStarted" class="form-control" id="dateStarted"
                aria-describedby="dateStarted">
        </div>
        <div class="mb-3">
            <label for="dateFinished" class="form-label">Date Finished</label>
            <input type="datetime-local" name="dateFinished" class="form-control" id="dateFinished"
                aria-describedby="dateFinished">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href="/admin/sub">
        <button class="btn btn-primary">Back</button>
    </a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
