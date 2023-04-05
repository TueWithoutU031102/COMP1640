
@extends('Master.Master')

@section('main')
    <h1>show Idea</h1>
    <h4>{{ $idea->title }}</h4>
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
            <h6 id="commentCount">{{ $idea->comments->count() }}</h6>
        </div>
        <hr>

        <section class="gradient-custom{{ $idea->id }}">
            <div class="card-body p-4">
                @if($idea->submission->dueDateComment > now())
                    <div class="mt-3  d-flex flex-row align-items-center p-3 form-color"
                         style="gap: 10px">
                        <img src="{{ asset(Auth::user()->image) }}" alt="mdo" width="50"
                             height="50" alt="user avatar" class="rounded-circle"
                             style="object-fit: cover; object-position: center center;">
                        <input type="text" class="form-control" placeholder="Enter your comment..."
                               id="commentContentInput{{ $idea->id }}">
                        <input type="checkbox" id="commentAnonymousCheck{{ $idea->id }}"> Anonymous
                        <button onclick="commentOnIdea({{ $idea->id }}, {{ Auth::user()->id }}, 'commentContentInput{{ $idea->id }}')">
                            sent
                        </button>
                    </div>
                @else
                    <div class="mt-3  d-flex flex-row align-items-center p-3 form-color"
                         style="gap: 10px">
                        <img src="{{ asset(Auth::user()->image) }}" alt="mdo" width="50"
                             height="50" alt="user avatar" class="rounded-circle"
                             style="object-fit: cover; object-position: center center;">
                        <input type="text" class="form-control" placeholder="Over due ..."
                               id="commentContentInput{{ $idea->id }}" disabled>
                    </div>
                @endif

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
@endsection
