@extends('Master.Master')

@section('main')
    @include('Goodi.nav_bar')
    <style>
        .img li {
            position: absolute;
            list-style: none;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
            transition: 0.5s;
            cursor: pointer;
            border: solid black 2px;
        }

        .img li:hover {
            background: #86ff3b;
            box-shadow: 0 0 0 4px #333, 0 0 0 6px #86ff3b
        }

        .img li img {
            height: 1500%;
            width: 1500%;
            visibility: hidden;
            object-fit: cover;
            object-position: center center;
            background: rgba(44, 181, 137, 0.3);
            margin-left: 100px;
            transform: translateX(-5%) translateY(-105%);
        }

        .img li:hover img {
            visibility: visible;
            opacity: 1;
        }

        @media(width < 1800px) {
            .img li img {
                height: 1100%;
                width: 1100%;
            }
        }

    </style>

    <br><br>
    <div class="container">
        <br>
        <h1 class="display-4" style="text-align: center; font-weight: bold">Manage Account</h1><br>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
        @endif
        <div class="create-btn">
            <a type="button" href="createAcc" class="btn btn-primary" style="font-weight: bold; font-size: 20px;">+</a>
        </div>
        <br><br>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"> </th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <ul class="img">
                                <li>
                                    <img src="{{ asset($user->image) }}">
                                </li>
                            </ul>
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>

                        <td>
                            <a href="/admin/showAcc/{{ $user->id }}" title="View Profile"
                                    class="btn btn-info btn-sm"><i aria-hidden="true"><i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="/admin/editAcc/{{ $user->id }}" title="Edit Account"
                                    class="btn btn-primary btn-sm"><i aria-hidden="true"><i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="/admin/deleteAcc/{{ $user->id }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure to delete {{ $user->name }} !!!???')">
                                @csrf
                                <button class="btn btn-danger btn-sm"><i aria-hidden="true"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    @include('Goodi.footer')
@endsection
