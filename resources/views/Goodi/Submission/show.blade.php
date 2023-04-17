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

            #view{{ $idea->id }}    {
                display: none;
            }

            .post-content label {
                display: inline-block;
                color: #3564fb;
                text-decoration: none;
                cursor: pointer;
            }


            #view{{ $idea->id }}:checked ~ .des {
                --max-line: 0;
            }

            #view{{ $idea->id }}:checked ~ label {
                visibility: hidden;
            }

            #view{{ $idea->id }}:checked ~ label:after {
                content: 'Show Less';
                display: block;
                visibility: visible;
            }

            .gradient-custom{{ $idea->id }}    {
                height: 0;
                display: none;
                /* transition: 0.2s; */
            }

            .gradient-custom{{ $idea->id }}.active {
                height: auto;
                display: block;
            }

            .idea-effect{{ $idea->id }}    {
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


            .idea-change{{ $idea->id }}    {
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

            @media (width <= 800px) {
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
                                <button class="add-idea" onclick="formCreateIdeaToggle();">Post Idea</button>
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
                                <textarea type="description" name="description" class="form-control" id="discussion"
                                          aria-describedby="description"
                                          rows="4"></textarea>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="files" class="font-weight-bold"></label>
                                <input type="file" id="files" name="files[]" multiple>
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
                                                <li>
                                                    <a onclick="return confirm('Are {{ $idea->user->name }} sure to delete {{ $idea->title }} !!!???')"
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
                        <div class="submission-information">
                            <h2>{{ $submission->title }}</h2>
                            <p><span>ID: </span>{{ $submission->id }}</p>
                            <p><span>Create by:{{ $submission->user->name }} </span></p>
                            <p><span>Start date: </span>{{ $submission->startDate }}</p>
                            <p><span>Due date: </span><i id="dueDateInfo">{{ $submission->dueDate }}</i></p>
                            <p><span>Due date 2: </span><i id="dueDate2Info">{{ $submission->dueDateComment }}</i></p>
                            <span>Time remaining: </span>
                            <p onclick="getTimeRemaining('{{ $submission->dueDate }}', this)"
                               @if ($isDue) style="color: red" @endif>{{ $timeRemaining }}</p>
                            <p><span>Description: </span>{{ $submission->title }}</p>
                            <button class="btn btn-primary"
                                    onclick="editDate('{{ $submission->dueDate }}', '{{ $submission->dueDateComment }}')"
                                    id="editButton"
                            >
                                <i aria-hidden="true"><i class="fa-solid fa-pen"></i> </i>
                            </button>
                            <input type="text" id="editStatus" value="0" hidden>
                            <input type="datetime-local" value="{{$submission->startDate}}" id="editStartDateInput"
                                   hidden>
                            <button class="btn btn-primary" id="submitEditDate" hidden>
                                Ok
                            </button>
                            <form action="{{ $submission->id }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Are you sure to delete {{ $submission->title }} !!!???')">
                                @csrf
                                {{-- <button class="btn btn-danger"><i aria-hidden="true">Delete</i></button> --}}
                            </form>
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
            function formCreateIdeaToggle() {
                const toggleForm = document.querySelector('.create-idea');
                const toggleButton = document.querySelector('.button-idea');
                toggleForm.classList.toggle('active')
                toggleButton.classList.toggle('active')
            }

            function editDate(dD1, dD2) {
                document.getElementById('editStatus')
                if ($('#editStatus').val() == 0) {
                    $('#editStatus').val(1);
                    $('#editButton').html('Cancel');
                    $('#submitEditDate').attr("hidden", false);
                    inputDueDate(1, dD1, dD2);
                } else {
                    $('#editStatus').val(0);
                    $('#submitEditDate').attr("hidden", true);
                    $('#editButton').html(`<i aria-hidden="true"><i class="fa-solid fa-pen"></i> </i>`);
                    inputDueDate(0, dD1, dD2);
                }

            }

            function inputDueDate(isEdit, dD1, dD2) {
                switch (isEdit) {
                    case 1:
                        document.getElementById('dueDateInfo').innerHTML =
                            `<input type="datetime-local" id="editDueDateInput" value="${dD1}"
                                    onchange="checkDueDateEdit(this, 1)">`

                        document.getElementById('dueDate2Info').innerHTML =
                            ` <input type="datetime-local" id="editDueDate2Input" value="${dD2}"
                                     onchange="checkDueDateEdit(this, 2)">`
                        break;
                    case 0:
                        document.getElementById('dueDateInfo').innerHTML = dD1;
                        document.getElementById('dueDate2Info').innerHTML = dD2;
                        break;
                }

            }

            function checkDueDateEdit(seft, dueNo) {
                let button = document.getElementById('submitEditDate');
                let dueDate = new Date(seft.value);
                let tzOffset = (new Date()).getTimezoneOffset() * 60000;
                let checkPoint = new Date();
                let startDateInput = document.getElementById('editStartDateInput');
                let dueDate1Input = document.getElementById('editDueDateInput');
                let dueDate2Input = document.getElementById('editDueDate2Input');

                switch (dueNo) {
                    case 1:
                        checkPoint = new Date(startDateInput.value);
                        break
                    case 2:
                        checkPoint = new Date(dueDate1Input.value);
                        break
                }
                checkPoint = new Date(checkPoint.getTime() - tzOffset);
                if (dueDate < checkPoint) {
                    button.disabled = true;
                    seft.value = '';
                    alert("due date must be latter than " + checkPoint.toUTCString());
                } else {
                    button.disabled = false;
                }
                if (dueDate1Input.value == '' || dueDate2Input.value == ''){
                    button.disabled = true;
                }
            }

            function commentToggle(ideaId) {
                const commentForm = document.querySelector('.gradient-custom' + ideaId);
                const commentButton = document.querySelector('.comment' + ideaId);
                commentForm.classList.toggle('active')
                commentButton.classList.toggle('active')
            }

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
        </script>
    @else
        <hr>
        <div class="alert alert-success">
            {{ session('message') }}
            <h1>{{ $message }}</h1>
        </div>
    @endif
@endsection
