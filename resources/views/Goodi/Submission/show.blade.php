@extends('Goodi.nav_bar')

@section('main')
    <br>
    <h1 class="display-4" style="text-align: center; font-weight: bold">SUBMISSION DETAIL</h1><br>
    <div class="row" id="editForm">
        <input type="text" id="submissionIdToUpdateDate" hidden>
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
    <div class="submission-card">
        <div class="user-information">
            <h2>{{ $submission->title }}</h2>
            <p><span>ID: </span>{{$submission->id}}</p>
            <p><span>Create by: </span></p>
            <p><span>Start date: </span>{{$submission->startDate}}</p>
            <p><span>Due date: </span>{{$submission->dueDate}}</p>
            <span>Time remaining: </span>
            {{--            <p onclick="getTimeRemaining('{{ $submission->startDate }}', '{{ $submission->dueDate }}', this)">||</p>--}}
            <p onclick="getTimeRemaining('{{ $submission->startDate }}', '{{ $submission->dueDate }}', this)">{{$timeRemaining}}</p>
            <p><span>Description: </span>{{$submission->title}}</p>

            <button class="btn btn-danger"
                    onclick="showForm('editDueDate', {{ $submission->id }},'{{ $submission->dueDate }}' ,'{{ $submission->startDate }}')">
                <i aria-hidden="true">Edit</i></button>
            <form action="{{ $submission->id }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Are you sure to delete {{ $submission->title }} !!!???')">
                @csrf
                <button class="btn btn-danger"><i aria-hidden="true">Delete</i></button>
            </form>
            <a href="/submission/index">
                <button class="btn btn-primary">Back</button>
            </a>
        </div>
    </div>

    <script>
        console.log("dd", {{$submission->title}})


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
            if (now > dueDate) {
                seft.style.color = "red"
            }
            return timeRemaining;
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
            console.log(url)
            window.location.href = url;
        }

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
    </script>
@endsection
