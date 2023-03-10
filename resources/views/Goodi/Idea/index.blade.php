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
                font-weight: none;
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
        </style>
    @endforeach
    <section class="banner">
        @include('Goodi.nav_bar')
        <div class="text-box">
            <h1>
                <p>IDEA <span class="text-highlight">DISCUSSION</span></p>
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
                            <a value="{{ $category->id }}">{{ $category->title }}</a>
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
                    <div class="btn-idea">
                        @if (\Illuminate\Support\Facades\Auth::user()->role->name == 'ADMIN')
                            <button class="add-idea" onclick="formToggle();">Post Idea</button>
                        @endif
                        {{-- <button class="refresh-idea">Refresh</button> --}}
                    </div>
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
                        </div>
                        <br>
                    @endforeach
                </section>
            </div>
            <div class="right-side">

            </div>
        </div>
        <div class="home-btn">
            <a href="#"><i class="fa-solid fa-angles-up"></i></a>
        </div>
    </section>
@endsection
<script>
    function formToggle() {
        const toggleForm = document.querySelector('.create-idea');
        const toggleButton = document.querySelector('.button-idea');
        toggleForm.classList.toggle('active')
        toggleButton.classList.toggle('active')
    }
</script>
