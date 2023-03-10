@extends('Master.Master')

@section('main')
    <style>
        span {
            font-weight: bold
        }
    </style>

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
            <a href="/admin/editAcc/" title="Edit Account">
                <i class="fa-solid fa-gear fa-2xl"></i>
            </a>
        </div>
    </section>
    <section class="profile-content">
        <div class="profile-container">
            <div class="left-profile" style="background: #b0b0b048">
                <p><i class="fa-solid fa-envelope"></i> <span>Email: </span>{{ Auth::user()->email }}</p>
                <p><i class="fa-solid fa-phone"></i> <span>Phone Number: </span>{{ Auth::user()->phonenumber }}</p>
                <p><i class="fa-solid fa-calendar-days"></i> <span>DOB: </span>{{ Auth::user()->DoB }}</p>
                <p><i class="fa-solid fa-building"></i> <span>Department </span>IT Department</p>
            </div>
            <div class="right-profile">
                <div class="post-container">
                    {{-- <div class="user-detail">
                        <img src="" width="50" height="50" class="rounded-circle" alt=""
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
                        </div> --}}
                </div>
                <div class="idea-interact">
                    <br>
                    @foreach($listIdeas as $idea)
                        <ul>
                            <li><h1>{{$idea->title}}</h1></li>
                        </ul>
                    @endforeach
                    {{-- @if (!$idea->likedBy(auth()->user()))
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
                        <h6>{{ $idea->dislikes->count() }}</h6> --}}
                </div>
            </div>
        </div>
        </div>
    </section>
    <script>
        let jwt = document.getElementById('jwt').textContent;
        if (window.localStorage.getItem('jwt') == ''){
            console.log('set jwt');
            window.localStorage.setItem('jwt', jwt);
        }
    </script>
@endsection
