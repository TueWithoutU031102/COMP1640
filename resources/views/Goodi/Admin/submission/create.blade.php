@extends('Goodi.Admin.admin_navbar')

@section('main')
    <h1>Create Submission</h1>
    <form action="/admin/submission/create" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="title" name="title" class="form-control" id="title" aria-describedby="title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="longText" name="description" class="form-control" id="description"
                   aria-describedby="description">
        </div>
        <div class="mb-3">
            <label for="startDate" class="form-label">Date Started</label>
            <input type="datetime-local" name="startDate" class="form-control" id="startDate"
                   aria-describedby="startDate" style="width: 300px">
        </div>
        <div class="mb-3">
            <label for="dueDate" class="form-label">Date Finished</label>
            <input type="datetime-local" name="dueDate" class="form-control" id="dueDate"
                   aria-describedby="dueDate"  style="width: 300px">
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
