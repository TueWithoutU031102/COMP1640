@extends('Goodi.nav_bar')

@section('main')
    <h1>Account Information</h1>
    <div class="user-card">
        <img src="{{ asset($account->image) }}">
        <div class="user-information">
            <h2>{{ $account->name }}</h3>
                <h4>Information</h4>
                <p>User ID: {{ $account->id }}</p>
                <p>Email: {{ $account->email }}</p>
                <p>Phone Number: {{ $account->phonenumber }}</p>
                <p>DOB: {{ $account->DoB }}</p>
                <p>Role: {{ $account->role->name }}</p>
                <a href="/admin/acc">
                    <button class="btn btn-primary">Back</button>
                </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
