@extends('Goodi.nav_bar')

@section('main')
    <br><br>
    <form action="/admin/editAcc/{id}" class="create-form" method="POST" enctype="multipart/form-data">
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
        <input type="hidden" name="id" value="{{ $account->id }}" name="id" class="form-control" id="id">
        <div class="form-group">
            <label for="name" class="font-weight-bold">Name</label>
            <input type="text" value="{{ $account->name }}" name="name" class="form-control" id="name"
                aria-describedby="name">
        </div>
        <div class="form-group">
            <label for="email" class="font-weight-bold">Email address</label>
            <input type="email" value="{{ $account->email }}" name="email" class="form-control" id="email"
                aria-describedby="email">
        </div>
        <div class="form-group">
            <label for="password" class="font-weight-bold">Password</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <div class="form-group">
            <label for="phone_number" class="font-weight-bold">Phone Number</label>
            <input type="text" value="{{ $account->phone_number }}" name="phone_number" class="form-control"
                id="phone_number">
        </div>
        <div class="form-group">
            <label for="DoB" class="font-weight-bold">Date of Birth</label>
            <input type="date" value="{{ $account->DoB }}" name="DoB" class="form-control" id="DoB">
        </div>
        <div class="form-group">
            <label for="image" class="font-weight-bold">Image</label>
            <div style="display: flex">
                <input type="file" value="{{ $account->image }}" name="image" class="form-control" id="image"><br>
                <img style="width:100%; object-fit: cover; object-position: center center; height: 100px; width: 100px;;"
                    src="{{ asset($account->image) }}">
            </div>
        </div><br>
        <div class="form-group">
            <label for="role" class="font-weight-bold">Role</label>

            <select value="{{ $account->role }}" name="role_id" class="form-select" id="role" aria-label="Role">
                @foreach ($listRoles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
        <a class="btn btn-danger" href="/admin/acc">Back</a>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
