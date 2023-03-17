@extends('Goodi.nav_bar')

@section('main')
    <br>
    <h1 class="display-4" style="text-align: center; font-weight: bold">ACCOUNT INFORMATION</h1><br>
    <div class="user-card">
        <img src="{{ asset($account->image) }}">
        <div class="submission-information">
            <h2>{{ $account->name }}</h2>
            <p><span>User ID: </span>{{ $account->id }}</p>
            <p><span>Email: </span>{{ $account->email }}</p>
            <p><span>Role: </span>{{ $account->role->name }}</p>
            @if ($nameDepart == null)
                <p><span>Department: NULL </span></p>
            @else
                <p><span>Department: </span>{{ $nameDepart->name }}</p>
            @endif
            <p><span>Phone Number: </span>{{ $account->phone_number }}</p>
            <p><span>DOB: </span>{{ $account->DoB }}</p>
            <a href="/admin/acc">
                <button class="btn btn-primary">Back</button>
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    @include('Goodi.footer')
@endsection
