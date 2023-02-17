@extends('Goodi.Admin.admin_navbar')

@section('main')

<br><br>
<h2>User Account</h2>
@if (Session::has('success'))
    <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
@endif
<a href="createAcc">
    <button class="btn btn-primary">Create Account</button>
</a>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th score="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>

                    <td>
                        <a href="/admin/showAcc/{{ $user->id }}" title="View Profile"><button
                                class="btn btn-info btn-sm"><i aria-hidden="true">View</button>
                        </a>
                        <a href="/admin/editAcc/{{ $user->id }}" title="Edit Account"><button
                                class="btn btn-primary btn-sm"><i aria-hidden="true">Edit</button>
                        </a>
                        <form action="/admin/deleteAcc/{{ $user->id }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Are you sure to delete {{ $user->name }} !!!???')">
                            @csrf
                            <button class="btn btn-danger btn-sm"><i aria-hidden="true">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
