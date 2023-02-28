@extends('Goodi.nav_bar')

@section('main')
    <table class="table table-hover">
        <h1 class="display-4" style="text-align: center; font-weight: bold">Categories</h1><br>
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
        @endif
        <br>
        <a type="button" href="/category/create" class="btn btn-primary" style="font-weight: bold; font-size: 20px;">+</a>
        <thead class="thead-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->title }}</td>
                    <td>
                        <a href="/category/show/{{ $category->id }}" title="View Category"><button
                                class="btn btn-info btn-sm"><i aria-hidden="true">View</button>
                        </a>
                        <a href="/category/edit/{{ $category->id }}" title="Edit Account"><button
                                class="btn btn-primary btn-sm"><i aria-hidden="true">Edit</button>
                        </a>
                        <form action="/category/delete/{{ $category->id }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Are you sure to delete {{ $category->title }} !!!???')">
                            @csrf
                            <button class="btn btn-danger btn-sm"><i aria-hidden="true">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
