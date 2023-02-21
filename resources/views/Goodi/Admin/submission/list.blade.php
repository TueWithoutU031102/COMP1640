@extends('Goodi.Admin.admin_navbar')

@section('main')
    <style>
        .popup {
            border: solid 2px red;
            width: 40%;
            height: 200px;
            margin: 0px 30%;
            position: fixed;
            background-color: #FF9900;
            display: block;
        }

        .row {

        }
    </style>
    <h2>Submissions</h2>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
    @endif
    <a href="/admin/submission/create">
        <button class="btn btn-primary">Create Submission</button>
    </a>
    <div class="row" id="editForm">
        <div class="editStartDate popup col-4" id="editStartDate" hidden>
            <h1>StartDate</h1>
            <button onclick="closeForm('editStartDate')">close</button>
        </div>
        <div class="editDueDate popup col-4" id="editDueDate" hidden>
            <h1>DueDate</h1>
            <button onclick="closeForm('editDueDate')">close</button>

        </div>
    </div>
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
                    <td id="title{{$sub->id}}">{{ $sub->title }}</td>
                    <td id="startDate{{$sub->startDate}}">{{ $sub->startDate }} |
                        <button onclick="showForm('editStartDate', {{$sub->id}})">Sửa</button>
                    </td>
                    <td id="dueDate{{ $sub->dueDate }}">{{ $sub->dueDate }}
                        <button onclick="showForm('editDueDate', {{$sub->id}})">Sửa</button>
                    </td>

                    <td>
                        <a href="{{ $sub->id }}" title="View Profile">
                            <button
                                class="btn btn-info btn-sm"><i aria-hidden="true">View</i></button>
                        </a>
                        <a href="{{ $sub->id }}" title="Edit Account">
                            <button
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

    <script !src="">
        function showForm(formId) {
            document.getElementById(formId).hidden = false;
        }
        function closeForm(formId){
            document.getElementById(formId).hidden = true;
        }

        function updateStartDate(){
            window.location.href = "/submission/update"
        }
        function updateDueDate(){}
        // function closeFormByListenClick() {
        //     let editStartDate = document.getElementById("editStartDate");
        //     let editDueDate = document.getElementById("editDueDate");
        //     let check = editStartDate.hidden ||editDueDate.hidden;
        //     console.log(check)
        //     if (!check) {
        //         window.addEventListener('click', function (e) {
        //             if (editDueDate.contains(e.target) && editStartDate.contains((e.target))) {
        //                 // Clicked in box
        //                 console.log("in")
        //             } else {
        //                 // Clicked outside the box
        //                 console.log("out")
        //                 editStartDate.hidden = true;
        //                 editDueDate.hidden = true;
        //             }
        //         }, {once:true});
        //     }
        // }
    </script>
@endsection
