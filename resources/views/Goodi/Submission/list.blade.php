@extends('Master.Master')

@section('main')
    <div id="preloader"></div>
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
            </div>
            <div class="main-content">
                <section class="idea-action">
                    <div class="btn-idea">
                        @if (in_array(Auth::user()->role->name, ['ADMIN']))
                            <button class="add-idea" onclick="formToggle();">Create event</button>
                        @endif
                    </div>
                </section>
                <br>
                <section class="create-idea">
                    <h2>New Event</h2>
                    <i></i>
                    <div id="errors">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>


                    <form action="/submission/create" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="font-weight-bold">Title</label>
                            <input type="title" name="title" value="{{old('title')}}" class="form-control" id="title"
                                   aria-describedby="title">
                        </div>
                        <div class="submission-date">
                            <div class="form-group">
                                <label for="startDate" class="font-weight-bold">Date Started</label>
                                <input type="datetime-local" name="startDate" class="form-control" id="startDateInput"
                                       aria-describedby="startDate" style="width: 300px"
                                       onchange="limitDueDate(this.value)">
                            </div>
                            <div class="form-group">
                                <label for="dueDate" class="font-weight-bold">Date Finished</label>
                                <input type="datetime-local" name="dueDate" class="form-control" id="dueDateInput"
                                       aria-describedby="dueDate" style="width: 300px" onchange="checkDueDate(this, 1)">
                                <label for="select2weeks">2 weeks</label>
                                <input type="checkbox" id="select2weeks"
                                       onclick="setDueDateLate2Weeks('startDateInput','dueDateInput')">
                            </div>
                            <div class="form-group">
                                <label for="dueDateComment" class="font-weight-bold">Date Finished 2</label>
                                <input type="datetime-local" name="dueDateComment" class="form-control"
                                       id="dueDateCommentInput" aria-describedby="dueDateComment" style="width: 300px"
                                       onchange="checkDueDate(this, 2)" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Description</label>
                            <textarea style="resize: none;" type="description" name="description"
                                      value="{{old('description')}}" class="form-control" id="description"
                                      aria-describedby="description" rows="6"></textarea>
                        </div>
                        <br>
                        <div class="button-idea">
                            <button class="btn btn-success" style="padding: 10px 100px;" type="submit"
                                    id="submitCreate">Submit
                            </button>
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
                                        @if ($sub->dueDate <= now())
                                            <span class="end-due-date">
                                                <i class="fa-solid fa-triangle-exclamation"></i> Due
                                                {{ $sub->dueDate }}
                                            </span>
                                        @else
                                            <span class="due-date">
                                                <i class="fa fa-exclamation-circle" aria-hidden="true"></i> Due
                                                {{ $sub->dueDate }}
                                            </span>
                                        @endif
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

        setStartDateEqualToday("startDateInput");
    }


    function setDueDateLate2Weeks(startDateInputId, dueDateInputId) {
        let startDateInput = document.getElementById(startDateInputId);
        let dueDateInput = document.getElementById(dueDateInputId);

        let tzOffset = (new Date()).getTimezoneOffset() * 60000;
        let sD = new Date(startDateInput.value);
        let dD = sD.setDate(sD.getDate() + 14);
        dD = new Date(dD - tzOffset)
        dueDateInput.value = dD.toISOString().slice(0, 16);

        checkDueDate(document.getElementById('dueDateInput'), 1)
    }

    function setStartDateEqualToday(startDateInputId) {
        let startDateInput = document.getElementById(startDateInputId);
        let tzOffset = (new Date()).getTimezoneOffset() * 60000;
        let today = new Date(Date.now() - tzOffset);
        startDateInput.value = today.toISOString().slice(0, 16);
    }

    limitDueDate(today.toISOString().slice(0, 16))

    function limitDueDate(startDate) {
        let dueDateInput = document.getElementById('dueDateInput');
        dueDateInput.min = startDate;
    }

    setStartDateEqualToday("startDateInput");

    function checkDueDate(seft, dueNo) {
        let select2weeksCheckbox = $('#select2weeks');
        select2weeksCheckbox.prop("checked", false);

        let tzOffset = (new Date()).getTimezoneOffset() * 60000;

        let submitCreate = document.getElementById('submitCreate');
        let dueDate = new Date(seft.value);
        let checkPoint = new Date();
        let startDateInput = document.getElementById('startDateInput');
        let dueDate1Input = document.getElementById('dueDateInput');

        switch (dueNo) {
            case 1:
                checkPoint = new Date(startDateInput.value);
                break
            case 2:
                checkPoint = new Date(dueDate1Input.value);
                break
        }
        checkPoint = new Date(checkPoint.getTime() - tzOffset);
        console.log(dueDate)
        console.log(checkPoint)
        if (dueDate < checkPoint) {
            console.log("er")
            submitCreate.disabled = true;
            seft.value = '';
            $('#errors').html(
            `<div class="alert alert-danger">
                <ul>
                    <li> ${"due date must be latter than " +checkPoint.toUTCString()}</li>
                </ul>
            </div>`)
        } else {
            submitCreate.disabled = false;
            document.getElementById('dueDateCommentInput').disabled = false;
        }
    }
</script>
