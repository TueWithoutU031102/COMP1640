@extends('Master.Master')

<nav>
    <a href="/" ><img class="logo" src="/css/images/logo_transparent.png"></a>
    <div class="black-nav-link" id="navlink">
        <ul>
            <li><a href="/forum" >FORUM</a></li>
            <li>
                <div class="action">
                    <div class="profile" onclick="menuToggle();">
                    <a style="cursor: default">MENU</a>
                    </div>
                    <div class="menu">
                        <ul>
                            <li><a href="/admin/submission/index">Submissions</a></li>
                            <li><a href="/admin/acc">Accounts</a></li>
                            <li><a href="/idea">Ideas</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li><a href="/about" >ABOUT</a></li>
            <li><a href="/department">DEPARTMENT</a></li>
            <li>
                <div class="action">
                    <div class="profile" onclick="profileToggle();">
                        <img src="images/avatar_63f826aa19394.jpg" alt="mdo" width="50" height="50" class="rounded-circle">
                    </div>
                    <div class="menu_pro">
                        <div class="info">
                            <br>
                            <h3>{{Auth::user()->name}}</h3>
                            <p>{{Auth::user()->role->name}}</p>
                        </div>
                        <ul>
                            <li><a href="#">My Profile</a></li>
                            <li><a href="#">Edit Profile</a></li>
                            <li><a href="#">Setting</a></li>
                            <li><a href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li><a href="/FAQ">FAQs</a></li>
        </ul>
    </div>
</nav>

<script>
    function menuToggle(){
        const toggleMenu = document.querySelector('.menu');
        toggleMenu.classList.toggle('active')
    }

    function profileToggle(){
        const toggleMenu = document.querySelector('.menu_pro');
        toggleMenu.classList.toggle('active')
    }
</script>
