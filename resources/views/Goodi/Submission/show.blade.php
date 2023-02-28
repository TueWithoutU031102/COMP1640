@extends('Goodi.nav_bar')

@section('main')
    <br>
    <h1 class="display-4" style="text-align: center; font-weight: bold">SUBMISSION DETAIL</h1><br>
    <div class="submission-card">
        <div class="user-information">
            <h2>{{ $submission->title }}</h2>
                <p><span>ID: </span>{{$submission->id}}</p>
                <p><span>Create by: </span></p>
                <p><span>Due date: </span>{{$submission->dueDate}}</p>
                <span>Time remaining: </span><p onclick="getTimeRemaining('{{ $submission->startDate }}', '{{ $submission->dueDate }}', this)">||</p>
                <p><span>Description: </span>{{$submission->title}}</p>
                <a href="{{ $submission->id }}" title="Edit Account">
                    <button class="btn btn-danger"><i aria-hidden="true">Edit</i></button>
                </a>
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
        function closeFormByListenClick() {
            let editStartDate = document.getElementById("editStartDate");
            let editDueDate = document.getElementById("editDueDate");
            let check = editStartDate.hidden ||editDueDate.hidden;
            console.log(check)
            if (!check) {
                window.addEventListener('click', function (e) {
                    if (editDueDate.contains(e.target) && editStartDate.contains((e.target))) {
                        // Clicked in box
                        console.log("in")
                    } else {
                        // Clicked outside the box
                        console.log("out")
                        editStartDate.hidden = true;
                        editDueDate.hidden = true;
                    }
                }, {once:true});
            }
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
    </script>
@endsection
