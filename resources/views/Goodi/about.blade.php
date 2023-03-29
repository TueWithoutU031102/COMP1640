@extends('Master.Master')

@section('main')
    @include('Goodi.nav_bar')
    <section class="banner">
        <div class="text-box">
            <h1>
                <p>GREENWICH <span class="text-highlight">UNIVERSITY</span> FORUM</p>
            </h1>
            <br>
        </div>
    </section><br><br>
    <div class="Our-history">
        <div class="history-content">
            <h3>Our History</h3>
            <p>
                We began collaborating on a project as a group of Greenwich School Vietnam students, and from there we
                decided to create both our own product and the school's application. With the intention of creating a forum
                page where school staff members can interact and share their own personal contributions and ideas for making
                the school even more successful than it already is. It is also a location where new employees can work
                without experiencing difficulty transitioning to the work environment. Goodi was established as a direct
                result of this.
            </p><br>
            <p>
                Goodi is currently being integrated into the Vietnamese university network to make it more accessible to
                employees. Goodi has already been implemented within the university. Such as providing support for the
                institution and its employees' working environment. In addition, Goodi intends to make an effort in the near
                future to establish a second forum dedicated solely to the business network.
            </p>
        </div>
    </div>
    <div class="about-card">
        <div class="about-content">
            <h3>General introduction</h3>
            <p>
                this is the Goodi website where the staff of the greenwich university system can share their opinions and
                contribute their ideas to build a school that suits their needs. of students and staff.
                The website includes an account management section, creating a place to collect opinions, write down ideas
                and share them with others, hope everyone builds a sociable and happy forum environment.
            </p>
        </div>
        <img src="/css/images/campus.png" alt="">
    </div>
    <div class="about-card">
        <img src="/css/images/cuu-sinh-vien-greenwich.png" alt="">
        <div class="about-content">
            <h3>Mission and Aim</h3>
            <p>
                Goodi's objective is to reunite the school's workforce by offering a friendly, close, and enjoyable
                environment
                for school employees.

                Using cutting-edge, ever-evolving technology, Goodi develops a platform where people may openly communicate
                their questions, expectations, and ideas for school system improvement.
            </p>
        </div>
    </div>
    <div class="about-card">
        <div class="about-content">
            <h3>Future Vision</h3>
            <p>
                Grow to become a forum network appearing in all school systems across the country and reaching out to
                foreign
                countries. Support for the development of Vietnam's education
            </p>
        </div>
        <img src="/css/images/tot-nghiep-3.png" alt="">
    </div>


    @include('Goodi.footer')

    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                console.log(entry)
                if (entry.isIntersecting) {
                    entry.target.classList.add('show');
                } else {
                    entry.target.classList.remove('show');
                }
            });
        });

        const hiddenElements = document.querySelectorAll('.about-card');
        hiddenElements.forEach((el) => observer.observer(el))
    </script>
@endsection
