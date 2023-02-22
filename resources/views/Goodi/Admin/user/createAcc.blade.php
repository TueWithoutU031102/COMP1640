@extends('Goodi.Admin.admin_navbar')

@section('main')
    <h1>Create Account</h1>
    <form action="/admin/createAcc" method="POST" enctype="multipart/form-data">
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
            <label for="name" class="form-label">Name</label>
            <input type="name" name="name" class="form-control" id="name" aria-describedby="name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" value="123456" name="password" class="form-control" id="password">
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="phone_number" name="phone_number" class="form-control" id="phone_number"
                aria-describedby="phone_number">
        </div>
        <div class="mb-3">
            <label for="DoB" class="form-label">Date of Birth</label>
            <input type="date" name="DoB" class="form-control" id="DoB" aria-describedby="DoB">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control" id="image">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>

            <select name="role" class="form-select" id="role" aria-label="Role">
                @foreach ($listRoles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href="/admin/acc">
        <button class="btn btn-primary">Back</button>
    </a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
