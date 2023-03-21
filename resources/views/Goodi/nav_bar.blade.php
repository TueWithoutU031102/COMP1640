@extends('Master.Master')
<nav>
    <div class="nav-logo">
        <a href="/"><img class="logo" src="/css/images/logo_transparent.png"></a>
    </div>
    <div class="menu_bar" onclick="menuDisplay();">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
    @if (!Auth::user())
        <div class="black-nav-link" id="navlink">
            <ul style="display: flex;">
                <li><a href="/index">FORUM</a></li>
                <li><a href="/about">ABOUT</a></li>
                <li><a href="/department">DEPARTMENT</a></li>
                <li><a href="/FAQ">FAQs</a></li>
                <li><a href="/login">LOGIN</a></li>
            </ul>
        </div>
        <div class="home-btn">
            <a href="#"><i class="fa-solid fa-angles-up"></i></a>
        </div>
    @else
        <div class="res_profile">
            <div class="action">
                <div class="res_profile">
                    <img src="{{ asset(Auth::user()->image) }}" alt="mdo" width="50" height="50"
                        class="rounded-circle" style="object-fit: cover; object-position: center center;">
                </div>
                <div class="res_menu_pro">
                    <div class="info">
                        <br>
                        <h3>{{ Auth::user()->name }}</h3>
                        <p>{{ Auth::user()->role->name }}</p>
                    </div>
                    <ul>
                        <li><a href="/user/index">My Profile</a></li>
                        <li><a href="#">Edit Profile</a></li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="black-nav-link" id="navlink">
            <div class="res_logo">
                <a href="/"><img class="logo" src="/css/images/logo_transparent.png"></a>
            </div>
            <ul style="display: flex;">
                <li><a href="/forum">FORUM</a></li>
                <li>
                    <div class="action">
                        <div onclick="menuToggle();">
                            <a style="cursor: default">MENU</a>
                        </div>
                        <div class="menu">
                            <ul>
                                <li><a href="/submission/index">Submissions</a></li>
                                @if (Auth::user()->id == '1')
                                    <li><a href="/admin/acc">Accounts</a></li>
                                @endif
                                <li><a href="/idea/index">Ideas</a></li>
                                <li><a href="/category/index">Categories</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li><a href="/about">ABOUT</a></li>
                <li><a href="/department">DEPARTMENT</a></li>
                <li>
                    <div class="action">
                        <div class="profile" onclick="profileToggle()">
                            <img src="{{ asset(Auth::user()->image) }}" alt="mdo" width="50" height="50"
                                class="rounded-circle" style="object-fit: cover; object-position: center center;">
                            {{-- <div>
                                <h5>{{ Auth::user()->name }}</h5>
                                <p>{{ Auth::user()->role->name }}</p>
                            </div> --}}
                        </div>
                        <div class="menu_pro">
                            <div class="info">
                                <br>
                                <h3>{{ Auth::user()->name }}</h3>
                                <p>{{ Auth::user()->role->name }}</p>
                            </div>
                            <ul>
                                <li><a href="/user/index">My Profile</a></li>
                                <li><a href="#">Edit Profile</a></li>
                                <li><a href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li><a href="/FAQ">FAQs</a></li>
            </ul>
        </div>
        <div class="home-btn">
            <a href="#"><i class="fa-solid fa-angles-up"></i></a>
        </div>
    @endif
</nav>

<script>
    function menuToggle() {
        const toggleMenu = document.querySelector('.menu');
        toggleMenu.classList.toggle('active')
    }

    document.onclick = function(res){
        const resToggleMenu = document.querySelector('.res_menu_pro');
        const proToggleMenu = document.querySelector('.menu_pro');
        if (res.target.closest(".res_profile")) resToggleMenu.classList.toggle('active')
        else resToggleMenu.classList.remove('active')

        if (event.target.closest(".profile")) proToggleMenu.classList.toggle('active')
        else proToggleMenu.classList.remove('active')
    }

    function menuDisplay() {
        const bar = document.querySelector('.menu_bar');
        const menu = document.querySelector('.black-nav-link');
        bar.classList.toggle('active')
        menu.classList.toggle('active')
    }
</script>
