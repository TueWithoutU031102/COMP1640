@extends('Master.Master')

@section('main')
    {{-- <section class="banner">
<br><br><br><br><br><br><br><br><br><br><br><br><br>
</section><br> --}}
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
                visibility: hidden;
                /* transition: 0.2s; */
            }

            .gradient-custom{{ $idea->id }}.active {
                height: auto;
                visibility: visible;
            }
        </style>
    @endforeach
    <section class="banner">
        @include('Goodi.nav_bar')
        <div class="text-box">
            <h1>
                IDEA <span class="text-highlight">DISCUSSION</span>
            </h1>
            <p>
                Goodi idea, where people can discuss all idea together
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
                    <a href="#"><i class="fa-solid fa-comments"></i> All Discussion</a>
                    <div class="category">
                        <p>Category</p>
                        @foreach ($listCategories as $category)
                            <a href="#">{{ $category->title }}</a>
                        @endforeach
                        <p>Department</p>
                        @foreach ($departments as $department)
                            <a id="sort" name="sort">
                                <a href="{{ Request::url() }}?sort_by={{$department->name}}">{{ $department->name }} </option>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="main-content">
                <section class="idea-action">
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
                        <select class="form-control" id="sort" name="sort">
                            <option value="{{ Request::url() }}?sort_by=none">---Filter by---</option>
                            <option value="{{ Request::url() }}?sort_by=mostPopular">Most Popular Ideas </option>
                            <option value="{{ Request::url() }}?sort_by=lastestIdeas">Latest Ideas</option>
                            <option value="{{ Request::url() }}?sort_by=lastestComments">Latest Comments</option>
                        </select>
                    </form>
                    <form action="" class="form-inline">
                        <div class="form-group">
                            <input class="search_bar" placeholder="Search Idea">
                        </div>
                    </form>
                </section>

                <section class="create-idea">
                    <h2>New Idea</h2>
                    <i></i>
                    <form action="{{ route('storeIdea') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="">
                            <label for="title" class="font-weight-bold">Title</label>
                            <input type="title" name="title" class="form-control" id="title"
                                aria-describedby="title">
                        </div>
                        <div class="form-group">
                            <label for="category_id" class="font-weight-bold">Category</label>

                            <select name="category_id" value="{{ old('category_id') }}" class="form-select" id="category"
                                aria-label="Category">
                                @foreach ($listCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Discussion</label>
                            <textarea style="resize: none;" type="description" name="description" class="form-control" id="discussion"
                                aria-describedby="discussion" rows="7"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" id="files" name="files[]" multiple>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="isAnonymous" name="isAnonymous">
                        </div>
                        <div class="button-idea">
                            <button class="btn btn-success" style="padding: 10px 100px;" type="submit">Submit</button>
                        </div>
                    </form>
                </section>

                <section class="post">
                    @foreach ($ideas as $idea)
                        <br>
                        <div class="post-container">
                            <div class="user-detail">
                                <img src="{{ asset($idea->user->image) }}" width="50" height="50"
                                    class="rounded-circle" alt=""
                                    style="object-fit: cover; object-position: center center;">
                                <div class="post-content">
                                    <h4>{{ $idea->title }}</h4>
                                    <small>{{ $idea->user->name }} Has Posted on {{ $idea->created_at }}</small><br><br>
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

                                @if (!$idea->dislikedBy(auth()->user()))
                                    <form action="{{ route('postDislike', $idea->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"><i class="fa-regular fa-thumbs-down fa-2x"></i></button>
                                    </form>
                                @else
                                    <form action="{{ route('destroyDislike', $idea->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><i class="fa-solid fa-thumbs-down fa-2x"></i></button>
                                    </form>
                                @endif
                                <h6>{{ $idea->dislikes->count() }}</h6>

                                <button
                                    onclick="commentToggle({{ $idea->id }}); showCommentByIdea({{ $idea->id }}, 'commentContentEle{{ $idea->id }}')"
                                    class="comment{{ $idea->id }}"><i
                                        class="fa-sharp fa-solid fa-comment fa-2x"></i></button>
                                <h6>10</h6>
                            </div>
                            <hr>

                            <section class="gradient-custom{{ $idea->id }}">
                                <div class="card-body p-4">
                                    <div class="mt-3  d-flex flex-row align-items-center p-3 form-color"
                                        style="gap: 10px">
                                        <img src="{{ asset(Auth::user()->image) }}" alt="mdo" width="50"
                                            height="50" alt="user avatar" class="rounded-circle"
                                            style="object-fit: cover; object-position: center center;">
                                        <input type="text" class="form-control" placeholder="Enter your comment..."
                                            id="commentContentInput{{ $idea->id }}">
                                        <input type="checkbox" id="commentAnonymousCheck{{ $idea->id }}"> Anonymous
                                        <button
                                            onclick="commentOnIdea({{ $idea->id }}, {{ Auth::user()->id }}, 'commentContentInput{{ $idea->id }}')">
                                            sent
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col" id="commentContentEle{{ $idea->id }}">
                                            @foreach ($idea->comments as $comment)
                                                <div class="d-flex flex-start mt-4" style="gap: 10px">
                                                    <img class="rounded-circle" src="{{ asset($comment->user->image) }}"
                                                        alt="avatar" width="50" height="50" />
                                                    <div class="flex-grow-1 flex-shrink-1">
                                                        <div
                                                            style="
                                                    background: #a6dbf8;
                                                    border-radius: 20px;
                                                    padding: 10px 10px 10px 10px;
                                                    ">
                                                            <div class="d-flex justify-content-between align-items-center"
                                                                style="gap: 10px
                                                            ">
                                                                <p class="mb-1">
                                                                    <b>{{ $comment->user->name }}</b>
                                                                </p>

                                                            </div>
                                                            <p class="small mb-0">
                                                                {{ $comment->content }}
                                                            </p>
                                                        </div>
                                                        <div style="gap: 20px; display: flex">
                                                            <a href="#!"><i class="fas fa-reply fa-xs"></i><span
                                                                    class="small"> reply</span></a>
                                                            <span class="small" style="font-weight: bold">2 hours
                                                                ago</span>
                                                        </div>

                                                        <div class="d-flex flex-start mt-4">
                                                            <a class="me-3" href="#">
                                                                <img class="rounded-circle"
                                                                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(11).webp"
                                                                    alt="avatar" width="50" height="50" />
                                                            </a>
                                                            <div class="flex-grow-1 flex-shrink-1">
                                                                <div
                                                                    style="
                                                    background: #a6dbf8;
                                                    border-radius: 20px;
                                                    padding: 10px 10px 10px 10px;
                                                    ">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <p class="mb-1">
                                                                            <b>Simona Disa</b>
                                                                        </p>
                                                                    </div>
                                                                    <p class="small mb-0">
                                                                        letters, as opposed to using 'Content
                                                                        here, content here',
                                                                        making it look like readable English.
                                                                    </p>
                                                                </div>
                                                                <span class="small" style="font-weight: bold">2 hours
                                                                    ago</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <br>
                    @endforeach
                </section>

            </div>
            <div class="right-side">

            </div>
        </div>
    </section>
    <h1 id="userEmail"></h1>
    <h1>
        <img id="userImg" src="" alt="">
    </h1>
    @include('Goodi.footer')
    <button onclick="showuser({{ Auth::user()->id }})">Get user</button>
    <button id="btn-api" onclick="showCommentByIdea(1)">Call API</button>

    <script>
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
    </script>
@endsection
