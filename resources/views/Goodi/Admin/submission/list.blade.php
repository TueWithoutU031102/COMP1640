@extends('Goodi.Admin.admin_navbar')

@section('main')
    <h2>Submissions</h2>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
    @endif
    <a href="/admin/submission/create">
        <button class="btn btn-primary">Create Submission</button>
    </a>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Date Started</th>
                <th score="col">Date Finished</th>
                <th score="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($subs as $sub)
                <tr>
                    <td>{{ $sub->title }}</td>
                    <td>{{ $sub->startDate }}</td>
                    <td>{{ $sub->dueDate }}</td>

                    <td>
                        <a href="{{ $sub->id }}" title="View Profile"><button
                                class="btn btn-info btn-sm"><i aria-hidden="true">View</i></button>
                        </a>
                        <a href="{{ $sub->id }}" title="Edit Account"><button
                                class="btn btn-primary btn-sm"><i aria-hidden="true">Edit</i></button>
                        </a>
                        <form action="{{ $sub->id }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure to delete {{ $sub->title }} !!!???')">
                            @csrf
                            <button class="btn btn-danger btn-sm"><i aria-hidden="true">Delete</i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
