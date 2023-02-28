@extends('Goodi.nav_bar')

@section('main')
    <br><br>
    <form action="/admin/createAcc" class="create-form" method="POST" enctype="multipart/form-data">
        <h2>Create Account</h2><br><br>
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
            <label for="name" class="font-weight-bold">Name</label>
            <input type="name" name="name" value="{{ old('name') }}" class="form-control" id="name"
                aria-describedby="name">
        </div>
        <div class="form-group">
            <label for="email" class="font-weight-bold">Email address</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email"
                aria-describedby="email">
        </div>
        <div class="form-group">
            <label for="password" class="font-weight-bold">Password</label>
            <input type="password" value="123456" name="password" class="form-control" id="password">
        </div>
        <div class="form-group">
            <label for="phone_number" class="font-weight-bold">Phone Number</label>
            <input type="phone_number" name="phone_number" value="{{ old('phone_number') }}" class="form-control"
                id="phone_number" aria-describedby="phone_number">
        </div>
        <div class="form-group">
            <label for="DoB" class="font-weight-bold">Date of Birth</label>
            <input type="date" name="DoB" value="{{ old('DoB') }}" class="form-control" id="DoB"
                aria-describedby="DoB">
        </div>
        <div class="form-group">
            <label for="image" class="font-weight-bold">Image</label>
            <input type="file" name="image" class="form-control" id="image">
        </div>
        <div class="form-group">
            <label for="role" class="font-weight-bold">Role</label>

            <select name="role_id" value="{{ old('role_id') }}" class="form-select" id="role" aria-label="Role">
                @foreach ($listRoles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div><br>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-danger" href='/admin/acc'>Back</a>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
