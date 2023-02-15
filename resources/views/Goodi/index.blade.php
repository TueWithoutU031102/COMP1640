@extends('Master.Master')

@section('main')
<section class="header">
    @include('Goodi.nav_bar')
    <div class="text-box">
        <h1>
            <p>THE <span class="text-highlight">GREENWICH <br> UNIVERSITY</span> FORUM</p>
        </h1>
        <p>
            Goodi, Idea Forum for Staff in University of Greenwich
        </p>
        <br>
        <a href="/login" class="action-btn" style="text-decoration: none;">LOGIN NOW</a>
    </div>
</section>
<h1 class="title-header">About Greenwich University</h1>
<section class="some_about">
    <a class="card_link" href="/about" style="text-decoration: none;">
        <div class="card_container">
            <div class="card">
                <img class="card_img" src="/css/images/campus.png" alt="campus">
                <h2 class="hidden_btn">Learn more</h2>
                <div class="intro">
                    <h1>Benefits of multi-campus experience</h1>
                    <p>After each semester, students can choose to continue their study at a different Greenwich campus in Hanoi, Ho Chi Minh City, Da Nang, and Can Tho, all of which offers the same academic standards . This opportunity gives students the chance to live independently, appreciate different ways of living in major cities in Vietnam. </p>
                </div>
            </div>
        </div>
    </a>
    <a class="card_link" href="/about" style="text-decoration: none;">
        <div class="card_container">
            <div class="card">
                <img class="card_img" src="/css/images/cuu-sinh-vien-greenwich.png" alt="sinh-vien-G">
                <h2 class="hidden_btn">Learn more</h2>
                <div class="intro">
                    <h1>Study with international lecturers and students</h1>
                    <p>Greenwich Vietnam is committed to providing students with a comprehensive educational environment in which professionalism is one of the core values. Students will study in a world-class educational environment like studying overseas with international curriculum, faculty and students from many countries around the world.</p>
                </div>
            </div>
        </div>
    </a>
    <a class="card_link" href="/about" style="text-decoration: none;">
        <div class="card_container">
            <div class="card">
                <img class="card_img" src="/css/images/tot-nghiep-3.png" alt="tot-nghiep">
                <h2 class="hidden_btn">Learn more</h2>
                <div class="intro">
                    <h1>On the job training (OJT)</h1>
                    <p>OJT (On the job training) is a special internship program for junior students. With a total duration of 3 months, OJT offers students practical knowledge and opportunity to gain first-hand experience, accumulate practical experience for their future career after graduation.
                    In addition to professional knowledge, students are equipped with survival skills and soft skills through workshops, short-term courses and many exciting extracurricular activities.</p>
                </div>
            </div>
        </div>
    </a>
</section>



@endsection
