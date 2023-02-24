@extends('Goodi.nav_bar')

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

        .row {}
    </style>
<br><br>
<div class="container">
    <br>
    <h1 class="display-4" style="text-align: center; font-weight: bold">Submissions</h1><br>
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert"><strong>{{ Session::get('success') }}</strong></div>
    @endif
    <div class="create-btn">
        <form action="" class="form-inline" >
            <div class="form-group">
                <input class="search_bar" placeholder="Search by name">
            </div>
            {{-- <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button> --}}
        </form>
        <a type="button" href="/admin/submission/create" class="btn btn-primary" style="font-weight: bold; font-size: 20px;">+</a>
    </div>
        <br><br>
    <div class="row" id="editForm">
        <input type="text" id="submissionIdToUpdateDate">

        <div class="editStartDate popup col-4" id="editStartDate" hidden>
            <h1>StartDate</h1>
            <input type="datetime-local" id="inputEditStartDate">
            <button onclick="updateDate('startDate')">Ok</button>
            <button onclick="closeForm('editStartDate')">close</button>
        </div>

        <div class="editDueDate popup col-4" id="editDueDate" hidden>
            <h1>DueDate</h1>
            <input type="datetime-local" id="inputEditDueDate">
            <button onclick="closeForm('editDueDate')">close</button>
            <button onclick="updateDate('dueDate')">Ok</button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Date Started</th>
                    <th score="col">Date Finished</th>
                    <th> time remaining</th>
                    <th score="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subs as $sub)
                    <tr>
                        <td id="title{{ $sub->id }}">{{ $sub->title }}</td>
                        <td id="startDate{{ $sub->startDate }}">{{ $sub->startDate }} |
                            <button
                                onclick="showForm('editStartDate', {{ $sub->id }},'{{ $sub->dueDate }}' ,'{{ $sub->startDate }}')">Sửa</button>
                        </td>
                        <td id="dueDate{{ $sub->dueDate }}">{{ $sub->dueDate }}
                            <button
                                onclick="showForm('editDueDate', {{ $sub->id }}, '{{ $sub->dueDate }}', '{{ $sub->startDate }}')">Sửa</button>
                        </td>
                        <td onclick="getTimeRemaining('{{ $sub->startDate }}', '{{ $sub->dueDate }}', this)">
                            | |
                        </td>
                        <td>
                            <a href="{{ $sub->id }}" title="View Profile">
                                <button class="btn btn-info btn-sm"><i aria-hidden="true">View</i></button>
                            </a>
                            <a href="{{ $sub->id }}" title="Edit Account">
                                <button class="btn btn-primary btn-sm"><i aria-hidden="true">Edit</i></button>
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
</div>

    <script !src="">
        function showForm(formId, submissionId, dueDate, startDate) {
            document.getElementById(formId).hidden = false;
            document.getElementById('submissionIdToUpdateDate').value = submissionId;
            console.log(dueDate)
            if (formId == 'editDueDate') {
                let dueDateInput = document.getElementById('inputEditDueDate');
                dueDateInput.value = dueDate;
                dueDateInput.min = startDate.replace(" ", 'T');

                console.log("min dueDaet", dueDateInput.min)
            } else {
                let startDateInput = document.getElementById('inputEditStartDate');
                startDateInput.value = startDate;
                startDateInput.max = dueDate;
            }

        }

        function closeForm(formId) {
            document.getElementById(formId).hidden = true;
        }


        function updateDate(dateType) {
            let startDateInput = document.getElementById('inputEditStartDate').value;
            let dueDateInput = document.getElementById('inputEditDueDate').value;
            let submissionId = document.getElementById('submissionIdToUpdateDate').value;

            let url = "{{ route('update', ['id' => '_submissionId', '_dateType' => '_newDate']) }}";
            url = url.replace('_submissionId', submissionId)
            url = url.replace('&amp;', '&')

            if (dateType == 'dueDate') {
                url = url.replace('_dateType', 'dueDate')
                url = url.replace('_newDate', dueDateInput)
            } else {
                url = url.replace('_dateType', 'startDate')
                url = url.replace('_newDate', startDateInput)
            }
            window.location.href = url;
        }

        function getTimeRemaining(sD, dD, seft) {
            let now = new Date();
            let dueDate = new Date(dD);
            let diffMs = (dueDate - now); // milliseconds between now & Christmas
            let diffDays = Math.floor(diffMs / 86400000); // days
            let diffHrs = Math.floor((diffMs % 86400000) / 3600000); // hours
            let diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000); // minutes

            let timeRemaining = diffDays + " days, " + diffHrs + " hours, " + diffMins + " minutes";
            console.log(timeRemaining);

            seft.innerHTML = timeRemaining;
            if(now > dueDate){
                seft.style.color ="red"
            }
            return timeRemaining;
        }

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




