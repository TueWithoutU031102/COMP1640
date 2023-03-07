@extends('Goodi.nav_bar')

@section('main')

@foreach ($ideas as $idea)
<style>

.des{

--max-line: 3;

width: 900px;
overflow-wrap: break-word;
font-weight: none;
font-size: 16px;
letter-spacing: 1px;
display: -webkit-box;
-webkit-box-orient: vertical;
-webkit-line-clamp: var(--max-line);
overflow: hidden;
}

    #view{{$idea->id}} {
display: none;
}

.post-content label{
display: inline-block;
color: #3564fb;
text-decoration: none;
cursor: pointer;
}


#view{{$idea->id}}:checked ~ .des{
--max-line: 0;
}

#view{{$idea->id}}:checked ~ label{
visibility: hidden;
}

#view{{$idea->id}}:checked ~ label:after{
content: 'Show Less';
display: block;
visibility: visible;
}

</style>
@endforeach

    @if($submission != null)
        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-6">
                <h1 class="display-4" style="text-align: center; font-weight: bold">SUBMISSION DETAIL</h1>
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
                        <p><span>Create by:{{$submission->user->name}} </span></p>
                        <p><span>Start date: </span>{{$submission->startDate}}</p>
                        <p><span>Due date: </span>{{$submission->dueDate}}</p>
                        <span>Time remaining: </span>
                        {{--            <p onclick="getTimeRemaining('{{ $submission->startDate }}', '{{ $submission->dueDate }}', this)">||</p>--}}
                        <p onclick="getTimeRemaining('{{ $submission->dueDate }}', this)">{{$timeRemaining}}</p>
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
            </div>
            <div class="col-6">
                <h1>Submit idea</h1>
                <i></i>
                <form action="{{ route('storeIdea') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="text" name="submission_id" value="{{$submission->id}}">
                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Title:</label>
                        <input type="title" name="title" class="form-control" id="title"
                            aria-describedby="title">
                    </div>
                    <div class="form-group">
                        <label for="filename" class="font-weight-bold">Save as:</label>
                        <input type="text" name="filename" class="form-control" id="title"
                            aria-describedby="title">
                    </div>
                    <div class="form-group">
                        <label for="category_id" class="font-weight-bold">Category:</label>

                        <select name="category_id" value="{{ old('category_id') }}" class="form-select" id="category"
                                aria-label="Category">
                            @foreach ($listCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description" class="font-weight-bold">Description: </label>
                        <textarea type="description" name="description" class="form-control"
                                id="discussion"
                                aria-describedby="description" rows="4"></textarea>
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="files" class="font-weight-bold"></label>
                        <input type="file" id="files" name="files[]" multiple>
                    </div>
                    <br>
                    <div class="form-group">
                        <button class="btn btn-success" style="padding: 10px 100px;" type="submit">Submit</button>
                    </div>
                </form>
            </div>
            <hr>
            <div class="row">
                <section class="post">

                    @foreach ($ideas as $idea)
                        <br>
                        <div class="post-container">
                            <div class="user-detail">
                                <img src="{{asset($idea->user->image)}}" width="50" height="50" class="rounded-circle"
                                    alt="" style="object-fit: cover; object-position: center center;">
                                <div class="post-content">
                                    <h4>{{ $idea->title }}</h4>
                                    <small>{{ $idea->user->name }} Has Posted on {{ $idea->created_at }}</small><br><br>
                                    @foreach($idea->files as $file)
                                        <a href="{{ url($file->path) }}" target="_blank">{{$file->filename}}</a>
                                    @endforeach
                                    <br>
                                    <input type="checkbox" id="view{{$idea->id}}">
                                    <p class="des">{{ $idea->description }}</p>
                                    <label for="view{{$idea->id}}">View More</label>
                                </div>
                            </div>
                            <div class="idea-interact" >
                                <br>
                                    @if (!$idea->likedBy(auth()->user()))
                                        <form action="{{ route('postLike', $idea->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"><i class="fa-regular fa-thumbs-up fa-2x"></i></button>
                                        </form>
                                    @else
                                        <form action="{{ route('destroyLike', $idea->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit"><i class="fa-solid fa-thumbs-up fa-2x"></i></button>
                                    </form>
                                    @endif
                                <h6>{{ $idea->likes->count() }}</h6>
                            </div>
                        </div>
                        <br>
                    @endforeach
                </section>
            </div>

            <script>
                console.log("dd", {{$submission->title}})


                function getTimeRemaining(dD, seft) {
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

            @else
                <hr>
                    <div class="alert alert-success">
                        {{ session('message') }}
                        <h1>{{$message}}</h1>
                    </div>
    @endif
@endsection
