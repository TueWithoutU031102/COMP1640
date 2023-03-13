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


            #view:{{ $idea->id }}:checked ~ .des {
                --max-line: 0;
            }

            #view:{{ $idea->id }}:checked ~ label {
                visibility: hidden;
            }

            #view:{{ $idea->id }}:checked ~ label:after {
                content: 'Show Less';
                display: block;
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
                            <a>{{ $category->title }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="main-content">
                <section class="idea-action">
                    <div class="sort-idea">
                        <select>
                            <option>test</option>
                            <option>test</option>
                        </select>
                    </div>
                    <form action="" class="form-inline">
                        <div class="form-group">
                            <input class="search_bar" placeholder="Search Idea">
                        </div>
                    </form>
                </section>
                <section class="ideas">
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
                                        <br>
                                    @endforeach
                                    <br>
                                    <input type="checkbox" id="view{{ $idea->id }}">
                                    <p class="des">{{ $idea->description }}</p>
                                    <label for="view{{ $idea->id }}">View More</label>
                                </div>
                            </div>
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
                            </div>
                            <hr>

                            <section class="gradient-custom">
                                <div class="card-body p-4">
                                    <div class="mt-3  d-flex flex-row align-items-center p-3 form-color">
                                        <img src="{{asset(Auth::user()->image)}}" width="50" class="rounded-circle mr-10" alt="user avatar">
                                        <input id="commentInput" type="text" class="form-control" placeholder="Enter your comment...">
                                        <button onclick="sentComment({{$idea->id}}, {{Auth::user()->id}}, {{ session()->get('jwt') }})">sent</button>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="d-flex flex-start mt-4">
                                                <img class="rounded-circle shadow-1-strong me-3"
                                                     src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp"
                                                     alt="avatar" width="65"
                                                     height="65"/>
                                                <div class="flex-grow-1 flex-shrink-1">
                                                    <div>
                                                        <div
                                                            class="d-flex justify-content-between align-items-center">
                                                            <p class="mb-1">
                                                                <b>Maria Smantha</b><span
                                                                    class="small">- 2 hours ago</span>
                                                            </p>

                                                        </div>
                                                        <p class="small mb-0">
                                                            It is a long established fact that a reader will
                                                            be distracted by
                                                            the readable content of a page.
                                                        </p>
                                                        <a href="#!"><i
                                                                class="fas fa-reply fa-xs"></i><span
                                                                class="small"> reply</span></a>
                                                    </div>

                                                    <div class="d-flex flex-start mt-4">
                                                        <a class="me-3" href="#">
                                                            <img class="rounded-circle shadow-1-strong"
                                                                 src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(11).webp"
                                                                 alt="avatar"
                                                                 width="65" height="65"/>
                                                        </a>
                                                        <div class="flex-grow-1 flex-shrink-1">
                                                            <div>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p class="mb-1">
                                                                        Simona Disa <span
                                                                            class="small">- 3 hours ago</span>
                                                                    </p>
                                                                </div>
                                                                <p class="small mb-0">
                                                                    letters, as opposed to using 'Content
                                                                    here, content here',
                                                                    making it look like readable English.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex flex-start mt-4">
                                                        <a class="me-3" href="#">
                                                            <img class="rounded-circle shadow-1-strong"
                                                                 src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(32).webp"
                                                                 alt="avatar"
                                                                 width="65" height="65"/>
                                                        </a>
                                                        <div class="flex-grow-1 flex-shrink-1">
                                                            <div>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p class="mb-1">
                                                                        John Smith <span
                                                                            class="small">- 4 hours ago</span>
                                                                    </p>
                                                                </div>
                                                                <p class="small mb-0">
                                                                    the majority have suffered alteration in
                                                                    some form, by
                                                                    injected humour, or randomised words.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
@endsection
<script>
    function sentComment(ideaId, authorId, token){

    }

    function formToggle() {
        const toggleForm = document.querySelector('.create-idea');
        const toggleButton = document.querySelector('.button-idea');
        toggleForm.classList.toggle('active')
        toggleButton.classList.toggle('active')
    }
</script>
