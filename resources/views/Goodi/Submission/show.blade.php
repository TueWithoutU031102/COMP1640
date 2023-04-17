@extends('Master.Master')

@section('main')
    <div id="preloader"></div>
    @foreach ($ideas as $idea)
        <style>
            .des {
                --max-line: 3;
                width: 700px;
                overflow-wrap: break-word;
                font-weight: unset;
                font-size: 16px;
                letter-spacing: 1px;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: var(--max-line);
                overflow: hidden;
            }

            #view{{ $idea->id }} {
                display: none;
            }

            .post-content label {
                display: inline-block;
                color: #3564fb;
                text-decoration: none;
                cursor: pointer;
            }


            #view{{ $idea->id }}:checked~.des {
                --max-line: 0;
            }

            #view{{ $idea->id }}:checked~label {
                visibility: hidden;
            }

            #view{{ $idea->id }}:checked~label:after {
                content: 'Show Less';
                display: block;
                visibility: visible;
            }

            .gradient-custom{{ $idea->id }} {
                height: 0;
                display: none;
                /* transition: 0.2s; */
            }

            .gradient-custom{{ $idea->id }}.active {
                height: auto;
                display: block;
            }

            .idea-effect{{ $idea->id }} {
                display: none;
                letter-spacing: 0;
                position: absolute;
                margin-top: 0px;
                right: 80px;
                background: #bababa;
                padding-right: 10px;
                border-radius: 10px;
            }

            .idea-effect{{ $idea->id }}.active {
                display: block;
            }


            .idea-change{{ $idea->id }} {
                position: absolute;
                right: 30px;
                background: #fff;
                border: none;
                transition: 0.2s;
                padding: 5px;
                height: 40px;
                border-radius: 20px;
                font-size: 30px;
            }

            .idea-change{{ $idea->id }}:hover {
                background: #8f8f8f;
            }

            .idea-effect{{ $idea->id }} ul li {
                list-style: none;
            }

            .idea-effect{{ $idea->id }} ul li a {
                text-decoration: none;
                color: #000;
                width: 200px;
                display: flex;
                align-items: center;
                text-align: center;
                border-radius: 10px;
                padding: 5px;
                margin-top: 5px;
                transition: 0.2s;
            }

            .idea-effect{{ $idea->id }} ul li a:hover {
                background: #8f8f8f;
            }

            @media (width <=800px) {
                .des {
                    width: auto;
                    --max-line: 3;
                    width: 300px;
                    overflow-wrap: break-word;
                    -webkit-line-clamp: var(--max-line);
                }
            }
        </style>
    @endforeach
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
    @if ($submission != null)
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <section class="main_idea">
            <section class="idea-container">
                <div class="left-side">
                    <div class="profile-display">
                        <img src="{{ asset(Auth::user()->image) }}" alt="mdo" width="50" height="50"
                            class="rounded-circle" style="object-fit: cover; object-position: center center;">
                        <h5 style="font-weight: bold">{{ Auth::user()->name }}</h5>
                    </div>
                    <div class="imp-link">
                        <a href="/submission/index"><i class="fa-solid fa-file"></i> All Events</a>
                        <a href="#"><i class="fa-solid fa-comments"></i> All Ideas</a>
                        <div class="category">
                            <p>Category</p>
                            @foreach ($listCategories as $category)
                                <a href="{{ Request::url() }}?sort_by={{ $category->title }}">{{ $category->title }}</a>
                            @endforeach
                        </div>
                        <div class="department">
                            <p>Department</p>
                            @foreach ($departments as $department)
                                <a href="{{ Request::url() }}?sort_by={{ $department->name }}">
                                    {{ $department->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="main-content">
                    <section>

                        {{-- show submission tren dien thoai --}}

                        <div class="submission-index-res">
                            <div class="user-information">
                                <h2>{{ $submission->title }}</h2>
                                <p><span>ID: </span>{{ $submission->id }}</p>
                                <p><span>Create by:{{ $submission->user->name }} </span></p>
                                <p><span>Start date: </span>{{ $submission->startDate }}</p>
                                <p><span>Due date: </span>{{ $submission->dueDate }}</p>
                                <p><span>Due date 2: </span>{{ $submission->dueDateComment }}</p>

                                <span>Time remaining: </span>
                                {{-- <p
                                    onclick="getTimeRemaining('{{ $submission->startDate }}', '{{ $submission->dueDate }}', this)">
                                    ||</p> --}}
                                <p onclick="getTimeRemaining('{{ $submission->dueDate }}', this)"
                                    @if ($isDue) style="color: red" @endif>{{ $timeRemaining }}</p>
                                <p><span>Description: </span>{{ $submission->title }}</p>
                                <button class="btn btn-primary"
                                    onclick="showForm('editDueDate', {{ $submission->id }},'{{ $submission->dueDate }}' ,'{{ $submission->startDate }}')">
                                    <i aria-hidden="true"><i class="fa-solid fa-pen"></i></i>
                                </button>
                                <form action="{{ $submission->id }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure to delete {{ $submission->title }} !!!???')">
                                    @csrf
                                    {{-- <button class="btn btn-danger"><i aria-hidden="true">Delete</i></button> --}}
                                </form>
                            </div>
                        </div>
                    </section>
                    <br><br>
                    <section class="idea-action">
                        <div class="sort-idea">
                            <script type="text/javascript">
                                window.addEventListener('load', () => {
                                    const sort = document.querySelector('#sort')
                                    sort.addEventListener('change', () => window.location.href = sort.value)

                                    for (const child of sort.children) {
                                        if (child.value === window.location.toString()) {
                                            child.setAttribute('selected', true)
                                        }
                                    }
                                })
                            </script>
                            <form>
                                @csrf
                                <select id="sort" name="sort">
                                    <option value="{{ Request::url() }}?sort_by=allIdea">All Idea</option>
                                    <option value="{{ Request::url() }}?sort_by=mostPopular">Most Popular Ideas</option>
                                    <option value="{{ Request::url() }}?sort_by=lastestIdeas">Latest Ideas</option>
                                    <option value="{{ Request::url() }}?sort_by=lastestComments">Latest Comments
                                    <option value="{{ Request::url() }}?sort_by=mostviewed">Most Viewed Ideas</option>
                                    </option>
                                </select>
                            </form>
                        </div>
                        {{-- <form action="" class="form-inline">
                            <div class="form-group">
                                <input class="search_bar" placeholder="Search Idea">
                            </div>
                        </form> --}}
                        <div class="btn-idea">
                            @if (\Illuminate\Support\Facades\Auth::user() && !$isDue)
                                <button class="add-idea" onclick="formToggle();">Post Idea</button>
                            @endif
                            {{-- <button class="refresh-idea">Refresh</button> --}}
                        </div>
                    </section>
                    <br>
                    <section class="create-idea">
                        <h1>Submit idea</h1>
                        <i></i>
                        <form action="{{ route('storeIdea') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <input type="hidden" name="submission_id" value="{{ $submission->id }}">
                            <div class="form-group">
                                <label for="dueDate" class="font-weight-bold">Due Date:</label>
                                <input type="title" name="dueDate" class="form-control" id="dueDate"
                                    aria-describedby="title" value="{{ $submission->dueDate }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="title" class="font-weight-bold">Title:</label>
                                <input type="title" name="title" class="form-control" id="title"
                                    aria-describedby="title">
                            </div>
                            <div class="form-group">
                                <label for="category_id" class="font-weight-bold">Category:</label>

                                <select name="category_id" value="{{ old('category_id') }}" class="form-select"
                                    id="category" aria-label="Category">
                                    @foreach ($listCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description" class="font-weight-bold">Description: </label>
                                <textarea type="description" name="description" class="form-control" id="discussion" aria-describedby="description"
                                    rows="4"></textarea>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="files" class="font-weight-bold"></label>
                                <input type="file" id="files" name="files[]" multiple>
                            </div><br>
                            <div class="form-group">
                                <input type="checkbox" name="checkbox" value='1'>
                                <label>I Accept All The <a href="/terms&condition#8">Terms and Condition</a></label>
                            </div>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-success" style="padding: 10px 100px;" type="submit">Submit
                                </button>
                            </div>
                        </form>
                    </section>
                    <section class="post">
                        @foreach ($ideas as $idea)
                            <br>
                            <div class="post-container">
                                <div class="change">
                                    <button class="idea-change{{ $idea->id }}"
                                        onclick="ideaToggle({{ $idea->id }});">
                                        <p>&dot;&dot;&dot;</p>
                                    </button>
                                    <div class="idea-effect{{ $idea->id }}">
                                        <ul>
                                            <li><a href="/idea/show/{{ $idea->id }}">Open Idea</a></li>
                                            <li><a href="">Change Content</a></li>
                                            @if ($idea->author_id == Auth::user()->id || Auth::user()->id == 1)
                                                <li><a onclick="return confirm('Are {{ $idea->user->name }} sure to delete {{ $idea->title }} !!!???')"
                                                        href="/idea/delete/{{ $idea->id }}">Remove Post</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="user-detail">
                                    <img src="{{ asset($idea->user->image) }}" width="50" height="50"
                                        class="rounded-circle" alt=""
                                        style="object-fit: cover; object-position: center center;">
                                    <div class="post-content">
                                        <h4>{{ $idea->title }}</h4>
                                        </a>
                                        <small>{{ $idea->user->name }} Has Posted on {{ $idea->created_at }}</small>
                                        <br>
                                        @foreach ($idea->files as $file)
                                            <a href="{{ url($file->path) }}" target="_blank">{{ $file->filename }}</a>
                                        @endforeach
                                        <br>
                                        <input type="checkbox" id="view{{ $idea->id }}">
                                        <p class="des">{{ $idea->description }}</p>
                                        <label for="view{{ $idea->id }}">View More</label>
                                    </div>
                                </div>
                                <br>
                                <div class="idea-interact">
                                    <br>
                                    <div>
                                        @if (!$idea->likedBy(auth()->user()))
                                            <button type="submit"
                                                onclick="likeIdea({{ $idea->id }}, 'likesCount{{ $idea->id }}', 'dislikesCount{{ $idea->id }}')">
                                                <i class="fa-regular fa-thumbs-up fa-2x"
                                                    id="likes-interact{{ $idea->id }}"></i>
                                            </button>
                                        @else
                                            <button type="submit"
                                                onclick="likeIdea({{ $idea->id }}, 'likesCount{{ $idea->id }}', 'dislikesCount{{ $idea->id }}')">
                                                <i class="fa-solid fa-thumbs-up fa-2x"
                                                    id="likes-interact{{ $idea->id }}"></i>
                                            </button>
                                        @endif
                                        <h6 id="likesCount{{ $idea->id }}">{{ $idea->likes->count() }}</h6>
                                    </div>
                                    <div>
                                        @if (!$idea->dislikedBy(auth()->user()))
                                            <button type="submit"
                                                onclick="dislikeIdea({{ $idea->id }}, 'likesCount{{ $idea->id }}', 'dislikesCount{{ $idea->id }}')">
                                                <i class="fa-regular fa-thumbs-down fa-2x"
                                                    id="dislikes-interact{{ $idea->id }}"></i>
                                            </button>
                                        @else
                                            <button type="submit"
                                                onclick="dislikeIdea({{ $idea->id }}, 'likesCount{{ $idea->id }}', 'dislikesCount{{ $idea->id }}')">
                                                <i class="fa-solid fa-thumbs-down fa-2x"
                                                    id="dislikes-interact{{ $idea->id }}"></i>
                                            </button>
                                        @endif
                                        <h6 id="dislikesCount{{ $idea->id }}">{{ $idea->dislikes->count() }}</h6>
                                    </div>

                                    <div>
                                        <button
                                            onclick="commentToggle({{ $idea->id }}); showCommentByIdea({{ $idea->id }}, 'commentContentEle{{ $idea->id }}')"
                                            class="comment{{ $idea->id }}"><i
                                                class="fa-sharp fa-solid fa-comment fa-2x"></i></button>
                                        <h6>{{ $idea->comments->count() }}</h6>
                                    </div>

                                    <div>
                                        <button>
                                            <a style="text-decoration: none; color:#000"
                                                href="/idea/show/{{ $idea->id }}"><i
                                                    class="fa-solid fa-eye fa-2x"></i></a>
                                        </button>
                                        <h6>{{ $idea->views }}</h6>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <br>
                        @endforeach
                    </section>
                </div>

                <div class="right-side">
                    <h6 class="display-6" style="text-align: center; font-weight: bold">SUBMISSION DETAIL</h6>
                    <div class="submission-index">

                        {{-- show submission tren pc --}}

                        <div class="user-information">
                            <h2>{{ $submission->title }}</h2>
                            <p><span>ID: </span>{{ $submission->id }}</p>
                            <p><span>Create by:{{ $submission->user->name }} </span></p>
                            <p id="first-change-start-date"><span>Start date: </span>{{ $submission->startDate }}</p>
                            <p id="second-change-start-date"><span>Start date: </span><input type="date"></p>
                            <p id="first-change-due-date"><span>Due date: </span>{{ $submission->dueDate }}</p>
                            <p id="second-change-due-date"><span>Due date: </span><input type="date"></p>
                            <p id="first-change-due-date-2"><span>Due date 2: </span>{{ $submission->dueDateComment }}</p>
                            <p id="second-change-due-date-2"><span>Due date 2: </span><input type="date"></p>

                            <span>Time remaining: </span>
                            {{-- <p
                                onclick="getTimeRemaining('{{ $submission->startDate }}', '{{ $submission->dueDate }}', this)">
                                ||</p> --}}
                            <p onclick="getTimeRemaining('{{ $submission->dueDate }}', this)"
                                @if ($isDue) style="color: red" @endif>{{ $timeRemaining }}</p>
                            <p><span>Description: </span>{{ $submission->title }}</p>
                            {{-- <button class="btn btn-primary"
                                onclick="showForm('editDueDate', {{ $submission->id }},'{{ $submission->dueDate }}' ,'{{ $submission->startDate }}')">
                                <i aria-hidden="true"><i class="fa-solid fa-pen"></i></i>
                            </button> --}}
                            <div style="display: flex; justify-content: space-around; flex-wrap: wrap;">
                                <button id="edit" class="btn btn-primary" onclick="edit_date()">
                                    <i aria-hidden="true"><i class="fa-solid fa-pen"></i></i>
                                </button>
                                <button id="done-edit" class="btn btn-success" onclick="change_date()">
                                    Done
                                </button>
                                <button id="exit-edit" class="btn btn-danger" onclick="change_date()">
                                    X
                                </button>
                                <button class="btn btn-danger">
                                    <a onclick="return confirm('Are you sure to delete {{ $submission->title }} !!!???')"
                                        href="/submission/delete/{{ $submission->id }}"><i aria-hidden="true"><i
                                                class="fa-solid fa-trash"></i></i>
                                    </a>

                                </button>
                            </div>
                            <form action="{{ $submission->id }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure to delete {{ $submission->title }} !!!???')">
                                @csrf
                                {{-- <button class="btn btn-danger"><i aria-hidden="true">Delete</i></button> --}}
                            </form>

                            <div class="editStartDate popup col-4" id="editStartDate" hidden>
                                <h1>StartDate</h1>
                                <input type="datetime-local" id="inputEditStartDate">
                                <button onclick="updateDate('startDate')">Ok</button>
                                <button onclick="closeForm('editStartDate')">close</button>
                            </div>

                            <div class="editDueDate popup col-4" id="editDueDate">
                                <h1>DueDate</h1>
                                <input type="datetime-local" id="inputEditDueDate">
                                <button onclick="closeForm('editDueDate')">close</button>
                                <button onclick="updateDate('dueDate')">Ok</button>
                            </div>
                        </div>

                    </div>
                    {{--                          edit date form --}}

                </div>

                </div>
                </div>
            </section>
        </section>
        @include('Goodi.footer')
        <script>
            function edit_date() {
                const firstStart = document.getElementById("first-change-start-date")
                const secondStart = document.getElementById("second-change-start-date")
                const firstDue = document.getElementById("first-change-due-date")
                const secondDue = document.getElementById("second-change-due-date")
                const firstDue2 = document.getElementById("first-change-due-date-2")
                const secondDue2 = document.getElementById("second-change-due-date-2")
                const done = document.getElementById("done-edit")
                const exit = document.getElementById("exit-edit")
                const edit = document.getElementById("edit")
                firstStart.style.display = "none";
                secondStart.style.display = "block";
                firstDue.style.display = "none";
                secondDue.style.display = "block";
                firstDue2.style.display = "none";
                secondDue2.style.display = "block";
                done.style.display = "block";
                exit.style.display = "block"
                edit.style.display = "none";
            }

            function change_date() {
                const firstStart = document.getElementById("first-change-start-date")
                const secondStart = document.getElementById("second-change-start-date")
                const firstDue = document.getElementById("first-change-due-date")
                const secondDue = document.getElementById("second-change-due-date")
                const firstDue2 = document.getElementById("first-change-due-date-2")
                const secondDue2 = document.getElementById("second-change-due-date-2")
                const done = document.getElementById("done-edit")
                const exit = document.getElementById("exit-edit")
                const edit = document.getElementById("edit")
                firstStart.style.display = "block";
                secondStart.style.display = "none";
                firstDue.style.display = "block";
                secondDue.style.display = "none";
                firstDue2.style.display = "block";
                secondDue2.style.display = "none";
                done.style.display = "none";
                exit.style.display = "none"
                edit.style.display = "block";
            }

            function formToggle() {
                const toggleForm = document.querySelector('.create-idea');
                const toggleButton = document.querySelector('.button-idea');
                toggleForm.classList.toggle('active')
                toggleButton.classList.toggle('active')
            }

            function commentToggle(ideaId) {
                const commentForm = document.querySelector('.gradient-custom' + ideaId);
                const commentButton = document.querySelector('.comment' + ideaId);
                commentForm.classList.toggle('active')
                commentButton.classList.toggle('active')
            }

            // document.onclick = function(idea) {
            //     const ideaToggleMenu = document.querySelector('.idea-effect');
            //     const ideaButtonMenu = document.querySelector('')
            //     if (idea.target.closest(".idea-change")) ideaToggleMenu.classList.toggle('active')
            //     else ideaToggleMenu.classList.remove('active')
            // }

            function ideaToggle(ideaId) {
                const ideaToggleMenu = document.querySelector('.idea-effect' + ideaId);
                const ideaButtonMenu = document.querySelector('.idea-change' + ideaId);
                if (ideaButtonMenu) ideaToggleMenu.classList.toggle('active')
                else ideaToggleMenu.classList.remove('active')
            }
        </script>

        <script>
            function getTimeRemaining(dD, seft) {
                let now = new Date();
                let dueDate = new Date(dD);
                let diffMs = (dueDate - now); // m
                let diffDays = Math.floor(diffMs / 86400000); // days
                let diffHrs = Math.floor((diffMs % 86400000) / 3600000); // hours
                let diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000); // minutes

                let timeRemaining = diffDays + " days |" + diffHrs + " hours |" + diffMins + " minutes";
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
                console.log(document.getElementById(formId))
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
            <h1>{{ $message }}</h1>
        </div>
    @endif
@endsection
