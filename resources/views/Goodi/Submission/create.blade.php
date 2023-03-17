@extends('Goodi.nav_bar')
<hr>
@section('main')
    <h1>Create Submission</h1>
    <form action="/submission/create" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="title" name="title" class="form-control" id="title" aria-describedby="title">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="longText" name="description" class="form-control" id="description" aria-describedby="description">
        </div>
        <div class="mb-3">
            <label for="startDate" class="form-label">Date Started</label>
            <input type="datetime-local" name="startDate" class="form-control" id="startDateInput"
                aria-describedby="startDate" style="width: 300px" onchange="limitDueDate(this.value)">
        </div>
        <div class="mb-3">
            <label for="dueDate" class="form-label">Date Finished</label>
            <input type="datetime-local" name="dueDate" class="form-control" id="dueDateInput" aria-describedby="dueDate"
                style="width: 300px" onchange="checkDueDate(this)">
        </div>
        <button type="submit" class="btn btn-primary" id="submitCreate">Submit</button>
    </form>
    <a href="/admin/submission/index">
        <button class="btn btn-primary">Back</button>
    </a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script !src="">
        getStartDateEqualToday("startDateInput");

        function getStartDateEqualToday(startDateInputId) {
            let startDateInput = document.getElementById(startDateInputId);
            console.log(startDateInput)
            let tzOffset = (new Date()).getTimezoneOffset() * 60000;
            let today = new Date(Date.now() - tzOffset);
            startDateInput.value = today.toISOString().slice(0, 16);
        }

        limitDueDate(today.toISOString().slice(0, 16))

        function limitDueDate(startDate) {
            let dueDateInput = document.getElementById('dueDateInput');
            dueDateInput.min = startDate;
        }

        function checkDueDate(seft) {
            let submitCreate = document.getElementById('submitCreate');
            let dueDate = new Date(seft.value);
            let now = new Date();
            if (dueDate < now) {
                submitCreate.disabled = true;
                alert("due date must be latter than " + startDateInput.value.replace('T', ' - '));
            } else {
                submitCreate.disabled = false;
            }
        }
    </script>
    @include('Goodi.footer')
@endsection
