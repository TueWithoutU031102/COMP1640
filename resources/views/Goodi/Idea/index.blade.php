@extends('Goodi.nav_bar')

@section('main')
{{-- <section class="banner">
<br><br><br><br><br><br><br><br><br><br><br><br><br>
</section><br> --}}
<section class="main_idea">
    <div class="idea-container">
        <div class="left-side">
            <div class="profile-display">
                <img src="{{ asset( Auth::user()->image )}}" alt="mdo" width="50" height="50"
                                class="rounded-circle" style="object-fit: cover; object-position: center center;">
                <h5 style="font-weight: bold">{{ Auth::user()->name }}</h5>
            </div>
            <div class="imp-link">
                <a href="#">All Discussion</a>
                <a href="#">Category</a>
            </div>
        </div>
        <div class="main-content">
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
                <form action="" class="form-inline" >
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
                <h2>New Idea</h2>
                <i></i>
                <form action="">
                    <div class="">
                        <label for="title" class="font-weight-bold">Title</label>
                        <input type="title" name="title" class="form-control" id="title" aria-describedby="title">
                    </div>
                    <div class="form-group">
                        <label for="discussion" class="font-weight-bold">Discussion</label>
                        <textarea type="discussion" name="discusstion" class="form-control" id="discussion" aria-describedby="discussion" rows="7"></textarea>
                    </div><br>
                    <div class="button-idea">
                        <button class="btn btn-success" style="padding: 10px 100px;" type="submit">Submit</button>
                    </div>
                </form>
            </section>
            <section class="post">
                <br>
                <div class="post-container">
                    <div class="user-detail">
                        <img src="https://github.com/mdo.png" width="50" height="50"
                        class="rounded-circle" alt="">
                        <div class="post-content">
                            <h4>We need a better solution for teaching children in math<h6>
                            <small>LongNT Has Posted on Feburary 12, 2023</small><br><br>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet.
                                Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor.
                                Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum,
                                nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.</p>
                        </div>
                    </div>
                    <div class="idea-interact">

                    </div>
                </div>

            </section>
        </div>
        <div class="right-side">
            <div class="profile-display">
                <img src="{{ asset( Auth::user()->image )}}" alt="mdo" width="50" height="50"
                                class="rounded-circle" style="object-fit: cover; object-position: center center;">
                <h5 style="font-weight: bold">{{ Auth::user()->name }}</h5>
            </div>
            <div class="imp-link">
                <a href="#">All Discussion</a>
                <a href="#">Category</a>
            </div>
        </div>
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

