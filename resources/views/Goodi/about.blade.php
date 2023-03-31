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
    <div class="our-history">
        <div class="history-header">
            <h3>Our History</h3>
        </div>
        <div class="history-content">
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
            <h3>General introduction</h3><br>
            <p>
                Goodi is an online forum designed particularly for educational institutions with the goal of facilitating
                staff members' ability to collaborate and interact with one another. In addition, the school's principal
                staff can use Goodi to collect information, opinions, and ideas from other staff members that will help the
                school become more robust. The current version of Goodi includes distinct pages for administering personal
                and public accounts, receiving and transmitting ideas, and expressing personal opinions about one's own or
                others' ideas.
            </p>
        </div>
        <img src="/css/images/campus.png" alt="">
    </div>
    <div class="about-card">
        <img src="/css/images/cuu-sinh-vien-greenwich.png" alt="">
        <div class="about-content">
            <h3>Mission and Aim</h3><br>
            <p>
                Goodi's mission is to unite the school's staff by providing an environment that is welcoming, conducive to
                intimacy, and enjoyable for all employees, including newcomers. In addition, Goodi assists universities in
                strengthening both their community and their environment. Goodi, when applied to the university system, will
                elevate the organisational behaviour of universities to the next level.
            </p>
            <p>
                Using cutting-edge, ever-evolving technology, Goodi is developing a platform that allows people to freely
                communicate their concerns, expectations, and ideas for the improvement of the educational system.
            </p>
        </div>
    </div>
    <div class="about-card">
        <div class="about-content">
            <h3>Future Vision</h3><br>
            <p>
                Goodi's mission is to establish its own products as necessities for educational institutions not only in the
                United States, but worldwide. Develop into one of the finest and most sophisticated websites in order to
                provide the school's faculty and staff with a modernized, accessible working environment. Goodi will provide
                its consumers with the best and most wonderful experience humanly possible by utilising cutting-edge
                technologies and staying abreast of the most recent advancements. After that, Goodi will progressively
                expand in order to create the optimal organisational behaviour for workers in businesses and institutions
                across the globe.
            </p>
        </div>
        <img src="/css/images/tot-nghiep-3.png" alt="">
    </div>
    <div class="about-card">
        <img src="/css/images/ctr-hoc-dc-cong-nhan.png" alt="">
        <div class="about-content">
            <h3>Future plans</h3><br>
            <p>
                As part of its long-term strategy, Goodi plans to assist its clients in obtaining prestigious honors, such
                as "Organization with the most desirable working environment" and "Organization worth working for." In the
                coming years, Goodi will also exert considerable effort to accomplish the following:
            </p>
            <p>- Making Goodi accessible to academic institutions across the United States.</p>
            <p>- Establishing a web presence for businesses.</p>
            <p>- Creating a community on Goodi that everyone can use and is familiar with.</p>
            <p>- The establishment of a separate community for Goodi users, where investors and enterprises can communicate
                and sign contracts.</p>
        </div>
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
