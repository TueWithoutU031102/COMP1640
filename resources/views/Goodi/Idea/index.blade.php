@extends('Goodi.nav_bar')

@section('main')
    {{-- <section class="banner">
<br><br><br><br><br><br><br><br><br><br><br><br><br>
</section><br> --}}
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
                        <button class="add-idea" onclick="formToggle();">+</button>
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

                            <select name="category_id" value="{{ old('category_id') }}" class="form-select"
                                    id="category"
                                    aria-label="Category">
                                @foreach ($listCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Discussion</label>
                            <textarea style="resize: none;" type="description" name="description" class="form-control"
                                      id="description"
                                      aria-describedby="description" rows="7"></textarea>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="files" class="font-weight-bold">Discussion</label>
                            <input type="file" id="files" name="files[]" multiple>
                        </div>
                        <br>
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
                                <img src="https://github.com/mdo.png" width="50" height="50" class="rounded-circle"
                                     alt="">
                                <div class="post-content">
                                    <h4>{{ $idea->title }}</h4>
                                    <small>{{ $idea->user->name }} Has Posted on {{ $idea->created_at }}</small><br><br>
                                    <p>{{ $idea->description }}</p>
                                </div>
                            </div>
                            <div class="idea-interact">
                                <br>
                                <p>{{ $idea->likes->count() }}</p>
                                <div class="mt-3">
                                    @if (!$idea->likedBy(auth()->user()))
                                        <form action="{{ route('postLike', $idea->id) }}" method="POST">
                                            @csrf
                                            <button class="text-blue-500" type="submit">Like</button>
                                        </form>
                                    @else
                                        <form action="{{ route('destroyLike', $idea->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-blue-500" type="submit">Unlike</button>
                                        </form>
                                    @endif
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
        <script>
            function formToggle() {
                const toggleForm = document.querySelector('.create-idea');
                const toggleButton = document.querySelector('.button-idea');
                toggleForm.classList.toggle('active')
                toggleButton.classList.toggle('active')
            }
        </script>
@endsection
