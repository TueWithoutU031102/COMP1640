@extends('Master.Master')

@section('main')
    <style>
        .des {

            --max-line: 3;

            width: 1150px;
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
            right: 350px;
            background: #fff;
            border: none;
            transition: 0.2s;
            padding: 5px;
            height: 40px;
            border-radius: 20px;
            font-size: 30px;
        }

        .idea-back{{ $idea->id }} {
            /* position: absolute; */
            margin-bottom: 50px;
            margin-top: -50px;
            right: 350px;
            top: 100px;
            background: #fff;
            border: none;
            transition: 0.2s;
            padding: 5px;
            height: 50px;
            border-radius: 20px;
            font-size: 39px;
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

        .idea-back{{ $idea->id }} {
            /* position: absolute; */
            margin-bottom: 50px;
            margin-top: -50px;
            right: 350px;
            top: 100px;
            background: #fff;
            border: none;
            transition: 0.2s;
            padding: 5px;
            height: 50px;
            border-radius: 20px;
            font-size: 39px;
        }

        @media (width <=1024px) {
            .des {
                width: auto;
                --max-line: 3;
                width: 700px;
                overflow-wrap: break-word;
                -webkit-line-clamp: var(--max-line);
            }

            .cmt p {
                width: 700px;
            }
        }

        @media (width <=700px) {
            .des {
                width: auto;
                --max-line: 3;
                width: 300px;
                overflow-wrap: break-word;
                -webkit-line-clamp: var(--max-line);
            }

            .cmt p {
                width: 300px;
            }
        }
    </style>

    @include('Goodi.nav_bar')
    <br><br><br><br><br><br><br>
    <div class="show-post-container">
        <br>
        <div class="change">
            <button class="idea-change{{ $idea->id }}" onclick="ideaToggle({{ $idea->id }});">
                <p>&dot;&dot;&dot;</p>
            </button>
            <button class="idea-back{{ $idea->id }}" onclick="history.back()">
                <p>&LeftArrow;</p>
            </button>
            <div class="idea-effect{{ $idea->id }}">
                <ul>
                    <li><a href="/idea/show/{{ $idea->id }}">Open Idea</a></li>
                    <li><a href="">Change Content</a></li>
                    <li><a href="">Remove Post</a></li>
                </ul>
            </div>
        </div>
        <div class="user-detail">
            <img src="{{ asset($idea->user->image) }}" width="50" height="50" class="rounded-circle" alt=""
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
            <div>
                @if (!$idea->likedBy(auth()->user()))
                    <button type="submit"
                        onclick="likeIdea({{ $idea->id }}, 'likesCount{{ $idea->id }}', 'dislikesCount{{ $idea->id }}')">
                        <i class="fa-regular fa-thumbs-up fa-2x" id="likes-interact{{ $idea->id }}"></i>
                    </button>
                @else
                    <button type="submit"
                        onclick="likeIdea({{ $idea->id }}, 'likesCount{{ $idea->id }}', 'dislikesCount{{ $idea->id }}')">
                        <i class="fa-solid fa-thumbs-up fa-2x" id="likes-interact{{ $idea->id }}"></i>
                    </button>
                @endif
                <h6 id="likesCount{{ $idea->id }}">{{ $idea->likes->count() }}</h6>
            </div>
            <div>
                @if (!$idea->dislikedBy(auth()->user()))
                    <button type="submit"
                        onclick="dislikeIdea({{ $idea->id }}, 'likesCount{{ $idea->id }}', 'dislikesCount{{ $idea->id }}')">
                        <i class="fa-regular fa-thumbs-down fa-2x" id="dislikes-interact{{ $idea->id }}"></i>
                    </button>
                @else
                    <button type="submit"
                        onclick="dislikeIdea({{ $idea->id }}, 'likesCount{{ $idea->id }}', 'dislikesCount{{ $idea->id }}')">
                        <i class="fa-solid fa-thumbs-down fa-2x" id="dislikes-interact{{ $idea->id }}"></i>
                    </button>
                @endif
                <h6 id="dislikesCount{{ $idea->id }}">{{ $idea->dislikes->count() }}</h6>
            </div>

            <div>
                <button
                    onclick="commentToggle({{ $idea->id }}); showCommentByIdea({{ $idea->id }}, 'commentContentEle{{ $idea->id }}')"
                    class="comment{{ $idea->id }}"><i class="fa-sharp fa-solid fa-comment fa-2x"></i></button>
                <h6>{{ $idea->comments->count() }}</h6>
            </div>
            <div>
                <button>
                    <a style="text-decoration: none; color:#000" href="/idea/show/{{ $idea->id }}"><i class="fa-solid fa-eye fa-2x"></i></a>
                </button>
                <h6>{{$idea->views}}</h6>
            </div>
        </div>
        <hr>

        <section class="gradient-custom{{ $idea->id }} active">
            <div class="card-body p-4">
                @if ($idea->submission->dueDateComment > now())
                    <input type="checkbox" id="commentAnonymousCheck{{ $idea->id }}"> Anonymous
                    <div class="mt-3  d-flex flex-row align-items-center p-3 form-color" style="gap: 10px">
                        <img src="{{ asset(Auth::user()->image) }}" alt="mdo" width="50" height="50"
                            alt="user avatar" class="rounded-circle"
                            style="object-fit: cover; object-position: center center;">
                        <input type="text" class="form-control" placeholder="Enter your comment..."
                            id="commentContentInput{{ $idea->id }}">
                        <button
                            onclick="commentOnIdea({{ $idea->id }}, {{ Auth::user()->id }}, 'commentContentInput{{ $idea->id }}')">
                            sent
                        </button>
                    </div>
                @else
                    <div class="mt-3  d-flex flex-row align-items-center p-3 form-color" style="gap: 10px">
                        <img src="{{ asset(Auth::user()->image) }}" alt="mdo" width="50" height="50"
                            alt="user avatar" class="rounded-circle"
                            style="object-fit: cover; object-position: center center;">
                        <input type="text" class="form-control" placeholder="Over due ..."
                            id="commentContentInput{{ $idea->id }}" disabled>
                    </div>
                @endif

                <div class="row">
                    <div class="col" id="commentContentEle{{ $idea->id }}">
                        @foreach ($idea->comments as $comment)
                            <div class="d-flex flex-start mt-4" style="gap: 10px">
                                <div class="flex-grow-1 flex-shrink-1">
                                    <div
                                        style="
                                                    background: #c2ebff;
                                                    border-radius: 20px;
                                                    padding: 10px;
                                                    width: auto;
                                                    ">
                                        <div class="d-flex "
                                            style="gap: 10px
                                                            ">
                                            <img class="rounded-circle" src="{{ asset($comment->user->image) }}"
                                                alt="avatar" width="50" height="50" />
                                            <p class="mb-1">
                                                <b>{{ $comment->user->name }}</b>
                                            </p>

                                        </div>
                                        <div class="cmt">
                                            <p class="small mb-0">
                                                {{ $comment->content }}
                                            </p>
                                        </div>
                                    </div>
                                    <div style="gap: 20px; display: flex">
                                        <a href="#!"><i class="fas fa-reply fa-xs"></i><span class="small">
                                                reply</span></a>
                                        <span class="small" style="font-weight: bold">2 hours
                                            ago</span>
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
    @include('Goodi.footer')

    <script>
        function formToggle() {
            const toggleForm = document.querySelector('.create-idea');
            const toggleButton = document.querySelector('.button-idea');
            toggleForm.classList.toggle('active')
            toggleButton.classList.toggle('active')
        }

        // function commentToggle(ideaId) {
        //     const commentForm = document.querySelector('.gradient-custom' + ideaId);
        //     const commentButton = document.querySelector('.comment' + ideaId);
        //     commentForm.classList.toggle('active')
        //     commentButton.classList.toggle('active')
        // }

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
@endsection
