@extends('Goodi.User.admin_navbar')

@section('main')
<section class="banner">
<br><br><br><br><br><br><br><br><br><br><br><br><br>
</section><br>
<section class="main_idea">
    <div class="idea-container">
        <div class="left-side">
            <div class="profile-display">
                <img src="https://github.com/mdo.png" alt="mdo" width="50" height="50" class="rounded-circle">
                <h3 style="font-weight: bold">LongNT</h5>
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
                    <button class="add-idea">+</button>
                    <button class="refresh-idea">Refresh</button>
                </div>
            </section>
            <section class="create-idea">
                <h2>New Idea</h2>
                <form action="">
                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Title</label>
                        <input type="title" name="title" class="form-control" id="title" aria-describedby="title">
                    </div>
                    <div class="form-group">
                        <label for="discussion" class="font-weight-bold">Discussion</label>
                        <textarea type="discussion" name="discusstion" class="form-control" id="discussion" aria-describedby="discussion" rows="7"></textarea>
                    </div>
                    <button type="submit">Submit</button>
                    <a href="/admin/acc">
                        <button class="btn btn-danger">Back</button>
                    </a>
                </form>
            </section>
        </div>
        <div class="right-side">

        </div>
    </div>
</section>

@endsection

