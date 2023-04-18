@extends('Master.Master')

@section('main')
    <div id="preloader"></div>
    @foreach ($listIdeas as $idea)
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
    <h1 id="jwt" hidden="true">{{ session()->pull('jwt') }}</h1>
    <section class="banner">
        @include('Goodi.nav_bar')

    </section>
    <section class="profile-layer">
        <div>
            <img src="{{ asset(Auth::user()->image) }}" alt="mdo" width="200" height="200" class="rounded-circle"
                style="object-fit: cover; object-position: center center;">
        </div>
        <div>
            <div class="profile-header">
                <h1>{{ Auth::user()->name }}</h1>
                <p>{{ Auth::user()->role->name }}</p>
            </div>
        </div>
        <div class="modify-profile">
            <button id="button"><i class="fa-solid fa-gear fa-2xl"></i></button>
        </div>
    </section>
    <section>
        <div class="popup">
            <div class="popup-content">
                <button class="close">&times;</button>
                @include('Goodi.User.update')
            </div>
        </div>
    </section>
    </div>
    </div>
    </section>
    <section class="profile-content">
        <div class="profile-container">
            <div class="left-profile">
                <div class="profile-detail">
                    <p><i class="fa-solid fa-envelope"></i> <span>Email: </span>{{ Auth::user()->email }}</p>
                    <p><i class="fa-solid fa-phone"></i> <span>Phone Number: </span>{{ Auth::user()->phone_number }}
                    </p>
                    <p><i class="fa-solid fa-calendar-days"></i> <span>DOB: </span>{{ Auth::user()->DoB }}</p>
                    <p><i class="fa-solid fa-building"></i> <span>Department:
                        </span>{{ App\Models\Department::where('id', Auth::user()->department_id)->value('name') }}
                    </p>
                </div>
            </div>
            <div class="right-profile">
                <div class="res_profile-detail">
                    <p><i class="fa-solid fa-envelope"></i> <span>Email: </span>{{ Auth::user()->email }}</p>
                    <p><i class="fa-solid fa-phone"></i> <span>Phone Number: </span>{{ Auth::user()->phone_number }}
                    </p>
                    <p><i class="fa-solid fa-calendar-days"></i> <span>DOB: </span>{{ Auth::user()->DoB }}</p>
                    <p><i class="fa-solid fa-building"></i> <span>Department:
                        </span>{{ App\Models\Department::where('id', Auth::user()->department_id)->value('name') }}
                    </p>
                </div>
                <section class="post">
                    @foreach ($listIdeas as $idea)
                        <br>
                        <div class="post-container">
                            <div class="user-detail">
                                <img src="{{ asset($idea->user->image) }}" width="50" height="50"
                                    class="rounded-circle" alt=""
                                    style="object-fit: cover; object-position: center center;">
                                <div class="post-content">
                                    <a href="/idea/show/{{ $idea->id }}">
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
                {{-- @if (!$ideas->likedBy(auth()->user()))
                            <form action="{{ route('postLike', $ideas->id) }}" method="POST">
                                @csrf
                                <button type="submit"><i class="fa-regular fa-thumbs-up fa-2x"></i></button>
                            </form>
                        @else
                            <form action="{{ route('destroyLike', $ideas->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"><i class="fa-solid fa-thumbs-up fa-2x"></i></button>
                            </form>
                        @endif
                        <h6>{{ $ideas->likes->count() }}</h6>

                        @if (!$ideas->dislikedBy(auth()->user()))
                            <form action="{{ route('postDislike', $ideas->id) }}" method="POST">
                                @csrf
                                <button type="submit"><i class="fa-regular fa-thumbs-down fa-2x"></i></button>
                            </form>
                        @else
                            <form action="{{ route('destroyDislike', $ideas->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"><i class="fa-solid fa-thumbs-down fa-2x"></i></button>
                            </form>
                        @endif
                        <h6>{{ $ideas->dislikes->count() }}</h6> --}}
            </div>
        </div>
        </div>
    </section>
    @include('Goodi.footer')

    <script>
        document.getElementById("button").addEventListener("click", function() {
            document.querySelector(".popup").style.display = "flex";
        })

        document.querySelector(".close").addEventListener("click", function() {
            document.querySelector(".popup").style.display = "none";
        })

        function ideaToggle(ideaId) {
            const ideaToggleMenu = document.querySelector('.ideas-effect' + ideaId);
            const ideaButtonMenu = document.querySelector('.ideas-change' + ideaId);
            if (ideaButtonMenu) ideaToggleMenu.classList.toggle('active')
            else ideaToggleMenu.classList.remove('active')
        }
    </script>
@endsection
