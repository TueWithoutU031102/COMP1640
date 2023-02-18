@extends('Goodi.Admin.admin_navbar')

@section('main')
    <div class="card" style="margin:20px">
        <div class="card-header">Account page</div>
    </div>
    <div class="card-body">
        <h5 class="card-title">Name:{{ $account->name }}</h5>
        <p class="card-text">ID:{{ $account->id }}</p>
        <p class="card-text">Email:{{ $account->email }}</p>
        <p class="card-text">Phone Number:{{ $account->phonenumber }}</p>
        <p class="card-text">Bate of Birth:{{ $account->DoB }}</p>
        <p class="card-text">Role:{{ $account->role }}</p>
        <p class="card-text">Image: <img src="{{ asset($account->image) }}"></p>
    </div>
    <a href="/admin/acc">
        <button class="btn btn-primary">Back</button>
    </a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
