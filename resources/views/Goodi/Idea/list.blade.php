@extends('Master.Master')

@section('main')
<div id="preloader"></div>
    {{-- <section class="banner">
    <br><br><br><br><br><br><br><br><br><br><br><br><br>
    </section><br> --}}
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
            <div class="col-3 left-side" style="border: #FF9900 solid 2px;">
                <div class="profile-display">
                    <img src="{{ asset(Auth::user()->image) }}" alt="mdo" width="50" height="50"
                        class="rounded-circle" style="object-fit: cover; object-position: center center;">
                    <h5 style="font-weight: bold">{{ Auth::user()->name }}</h5>
                </div>
                <div class="imp-link">
                    <a href="#">All Discussion</a>
                    <a href="#">Category</a>
                </div>
            </div>
            <div class="col-6 main-content">
                <section class="idea-action">
                    <div class="sort-idea">
                        <select>
                            <option>test</option>
                            <option>test</option>
                            <option>test</option>
                            <option>test</option>
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
                        <button class="refresh-idea">Refresh</button>
                    </div>
                </section>
                <section class="create-idea">
                    <h2>New Submission</h2>
                    <i></i>
                    <form action="/submission/create" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="font-weight-bold">Title</label>
                            <input type="title" name="title" class="form-control" id="title"
                                aria-describedby="title">
                        </div>
                        <div class="submission-date">
                            <div class="form-group">
                                <label for="startDate" class="font-weight-bold">Date Started</label>
                                <input type="datetime-local" name="startDate" class="form-control" id="startDateInput"
                                    aria-describedby="startDate" style="width: 300px" onchange="limitDueDate(this.value)">
                            </div>
                            <div class="form-group">
                                <label for="dueDate" class="font-weight-bold">Date Finished</label>
                                <input type="datetime-local" name="dueDate" class="form-control" id="dueDateInput"
                                    aria-describedby="dueDate" style="width: 300px" onchange="checkDueDate(this)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Description</label>
                            <textarea type="description" name="description" class="form-control" id="description" aria-describedby="description"
                                rows="5"></textarea>
                        </div>
                        <br>
                        <div class="button-idea">
                            <button class="btn btn-success" style="padding: 10px 100px;" type="submit"
                                id="submitCreate">Submit
                            </button>
                        </div>
                    </form>
                </section>
                <section class="submission">
                    <br>
                    @foreach ($titles as $tit)
                        <br>
                        <a class="submission-link" href="/idea/show/{{ $tit->id }}">
                            <div class="submission-container">
                                <div class="submission-detail">
                                    <i class="fa-solid fa-file-lines fa-4x"></i>
                                    <div class="submission-content">
                                        <h4>{{ $tit->title }}</h4>
                                        <small>Create by: </small><br>
                                        <p>{{ $tit->description }}</p>
                                        <span class="due-date"><i class="fa-solid fa-triangle-exclamation"></i> Due
                                            {{ $tit->dueDate }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach

                </section>
            </div>
            <div class="col-3 right-side" style="border: #FF9900 solid 2px;">
                <h1>right</h1>
            </div>
        </div>
    </section>
    @include('Goodi.footer')
@endsection

<script>
    function formToggle() {
        const toggleForm = document.querySelector('.create-idea');
        const toggleButton = document.querySelector('.button-idea');
        toggleForm.classList.toggle('active')
        toggleButton.classList.toggle('active')
    }
</script>
