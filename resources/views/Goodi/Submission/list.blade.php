@extends('Master.Master')

@section('main')
    {{-- <section class="banner">
<br><br><br><br><br><br><br><br><br><br><br><br><br>
</section><br> --}}
    <section class="banner">
        @include('Goodi.nav_bar')
        <div class="text-box">
            <h1>
                <p>IDEA <span class="text-highlight">PROPOSAL</span></p>
            </h1>
            <p>
                Goodi Proposal, place where people to submit idea
            </p>
            <br>
        </div>
    </section>
    <section class="main_idea">
        <div class="idea-container">
            <div class="left-side">
                <div class="profile-display">
                    <img src="{{ asset(Auth::user()->image) }}" alt="mdo" width="50" height="50"
                        class="rounded-circle" style="object-fit: cover; object-position: center center;">
                    <h5 style="font-weight: bold">{{ Auth::user()->name }}</h5>
                </div>
                <div class="imp-link">
                    <a href="#">All Discussion</a>
                    <a href="#">Category</a>
                </div>
            </div>
            <div class="main-content">
                <section class="idea-action">
                    <div class="sort-idea">
                        <select>
                            <option value="">Most Popular Ideas </option>
                            <option value="">Most Viewed Ideas</option>
                            <option value="">Latest Ideas</option>
                            <option value="">Latest Comments</option>
                        </select>
                    </div>
                    <form action="" class="form-inline">
                        <div class="form-group">
                            <input class="search_bar" placeholder="Search Idea">
                        </div>
                    </form>
                    <div class="btn-idea">
                        @if (\Illuminate\Support\Facades\Auth::user()->role->name == 'ADMIN')
                            <button class="add-idea" onclick="formToggle();">+</button>
                        @endif
                        {{-- <button class="refresh-idea">Refresh</button> --}}
                    </div>
                </section>
                <section class="create-idea">
                    <h2>New Submission</h2>
                    <i></i>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="/submission/create" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="font-weight-bold">Title</label>
                            <input type="title" name="title" class="form-control" id="title"
                                aria-describedby="title">
                        </div>
                        <div class="submission-date">
                            <div class="form-group">
                                <label for="startDate" class="font-weight-bold">Date Started</label>
                                <input type="datetime-local" name="startDate" class="form-control" id="startDateInput"
                                    aria-describedby="startDate" style="width: 300px" onchange="limitDueDate(this.value)">
                            </div>
                            <div class="form-group">
                                <label for="dueDate" class="font-weight-bold">Date Finished</label>
                                <input type="datetime-local" name="dueDate" class="form-control" id="dueDateInput"
                                    aria-describedby="dueDate" style="width: 300px" onchange="checkDueDate(this)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Description</label>
                            <textarea style="resize: none;" type="description" name="description" class="form-control" id="description"
                                aria-describedby="description" rows="6"></textarea>
                        </div>
                        <br>
                        <div class="button-idea">
                            <button class="btn btn-success" style="padding: 10px 100px;" type="submit"
                                id="submitCreate">Submit</button>
                        </div>
                    </form>
                </section>
                <section class="submission">
                    <br>
                    @foreach ($subs as $sub)
                        <br>
                        <a class="submission-link" href="/submission/show/{{ $sub->id }}">
                            <div class="submission-container">
                                <div class="submission-detail">
                                    <i class="fa-solid fa-file-lines fa-4x"></i>
                                    <div class="submission-content">
                                        <h4>{{ $sub->title }}</h4>
                                        <small>Create by:</small><br>
                                        <p>{{ $sub->description }}</p>
                                        <span class="due-date"><i class="fa-solid fa-triangle-exclamation"></i> Due
                                            {{ $sub->dueDate }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach

                </section>
            </div>
            <div class="right-side">

            </div>
        </div>
    </section>
    @include('Goodi.footer')
@endsection

<script>
    function formToggle() {
        const toggleForm = document.querySelector('.create-idea');
        const toggleButton = document.querySelector('.button-idea');
        toggleForm.classList.toggle('active')
        toggleButton.classList.toggle('active')

        getStartDateEqualToday("startDateInput");
    }

    function getStartDateEqualToday(startDateInputId) {
        let startDateInput = document.getElementById(startDateInputId);
        console.log(startDateInput)
        let tzOffset = (new Date()).getTimezoneOffset() * 60000;
        let today = new Date(Date.now() - tzOffset);
        startDateInput.value = today.toISOString().slice(0, 16);

        console.log(startDateInput)
    }

    limitDueDate(today.toISOString().slice(0, 16))

    function limitDueDate(startDate) {
        let dueDateInput = document.getElementById('dueDateInput');
        dueDateInput.min = startDate;
    }

    function checkDueDate(seft) {
        let submitCreate = document.getElementById('submitCreate');
        let dueDate = new Date(seft.value);
        let now = new Date();
        if (dueDate < now) {
            submitCreate.disabled = true;
            alert("due date must be latter than " + startDateInput.value.replace('T', ' - '));
        } else {
            submitCreate.disabled = false;
        }
    }

    getStartDateEqualToday("startDateInput");

    function getStartDateEqualToday(startDateInputId) {
        let startDateInput = document.getElementById(startDateInputId);
        console.log(startDateInput)
        let tzOffset = (new Date()).getTimezoneOffset() * 60000;
        let today = new Date(Date.now() - tzOffset);
        startDateInput.value = today.toISOString().slice(0, 16);
    }

    limitDueDate(today.toISOString().slice(0, 16))

    function limitDueDate(startDate) {
        let dueDateInput = document.getElementById('dueDateInput');
        dueDateInput.min = startDate;
    }

    function checkDueDate(seft) {
        let submitCreate = document.getElementById('submitCreate');
        let dueDate = new Date(seft.value);
        let now = new Date();
        if (dueDate < now) {
            submitCreate.disabled = true;
            alert("due date must be latter than " + startDateInput.value.replace('T', ' - '));
        } else {
            submitCreate.disabled = false;
        }
    }
</script>




{{-- @extends('Goodi.nav_bar')

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

            remove
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>

        </form>
        <a type="button" href="/submission/create" class="btn btn-primary" style="font-weight: bold; font-size: 20px;">+</a>
    </div>
        <br><br>
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
    <div class="table-responsive">
        <table class="table table-hover">
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
                            <a href="/submission/show/{{ $sub->id }}" title="View Profile">
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


        remove//

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
    </script>
@endsection --}}
