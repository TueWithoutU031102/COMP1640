@extends('Goodi.nav_bar')

@section('main')
    <table class="table table-hover">
        <h1 class="display-4" style="text-align: center; font-weight: bold">Categories</h1><br>
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
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
