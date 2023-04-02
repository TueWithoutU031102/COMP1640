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
            <button id="button"><i class="fa-solid fa-gear fa-2xl"></i></button>
        </div>
    </section>
    <section>
        <div class="popup">
            <div class="popup-content">
                <button class="close">&times;</button>
                <section class="form-body">
                    <div class="form-container">
                        <div class="form-title">Edit Account</div>
                        <form action="/admin/editAcc/{id}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <br>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-content">
                                <input type="hidden" name="id" value="{{ $account->id }}" name="id"
                                    class="form-control" id="id">
                                <div class="input-box">
                                    <label for="name" class="font-weight-bold">Name</label>
                                    <input type="text" value="{{ $account->name }}" name="name" id="name"
                                        aria-describedby="name">
                                </div>
                                <div class="input-box">
                                    <label for="email" class="font-weight-bold">Email address</label>
                                    <input type="email" value="{{ $account->email }}" name="email" id="email"
                                        aria-describedby="email">
                                </div>
                                <div class="input-box">
                                    <label for="password" class="font-weight-bold">Password</label>
                                    <input type="password" name="password" id="password">
                                </div>
                                <div class="input-box">
                                    <label for="phone_number" class="font-weight-bold">Phone Number</label>
                                    <input type="text" value="{{ $account->phone_number }}" name="phone_number"
                                        id="phone_number">
                                </div>
                                <div class="input-box">
                                    <label for="DoB" class="font-weight-bold">Date of Birth</label>
                                    <input type="date" value="{{ $account->DoB }}" name="DoB" id="DoB">
                                </div>
                                <div class="input-box">
                                    <label for="image" class="font-weight-bold">Image</label>
                                    <div style="display: flex">
                                        <input type="file" value="{{ $account->image }}" name="image"
                                            class="form-control" id="image"><br>
                                        <img style="width:100%; object-fit: cover; object-position: center center; height: 100px; width: 100px;;"
                                            src="{{ asset($account->image) }}">
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="button-action">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-danger" href='/index'>Back</a>
                            </div>
                        </form>
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
                    <p><i class="fa-solid fa-phone"></i> <span>Phone Number: </span>{{ Auth::user()->phone_number }}</p>
                    <p><i class="fa-solid fa-calendar-days"></i> <span>DOB: </span>{{ Auth::user()->DoB }}</p>
                    <p><i class="fa-solid fa-building"></i> <span>Department:
                        </span>{{ App\Models\Department::where('id', Auth::user()->department_id)->value('name') }}
                    </p>
                </div>
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
                    {{-- </div>
                <div class="idea-interact">
                    <br>
                    @foreach ($listIdeas as $idea)
                        <ul>
                            <li>
                                <h1>{{ $idea->title }}</h1>
                            </li>
                        </ul>
                    @endforeach --}}
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
    @include('Goodi.footer')

    <script>
        document.getElementById("button").addEventListener("click", function() {
            document.querySelector(".popup").style.display = "flex";
        })

        document.querySelector(".close").addEventListener("click", function() {
            document.querySelector(".popup").style.display = "none";
        })
    </script>
@endsection
