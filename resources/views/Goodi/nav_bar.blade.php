@extends('Master.Master')
@if(!Auth::user())
<nav>
    <a href="/" ><img class="logo" src="/css/images/logo_transparent_white.png"></a>
    <div class="nav-link" id="navlink">
        <ul>
            <li><a href="/index" >FORUM</a></li>
            <li><a href="/about" >ABOUT</a></li>
            <li><a href="/department">DEPARTMENT</a></li>
            <li><a href="/FAQ">FAQs</a></li>
            <li><a href="/login">LOGIN</a></li>
        </ul>
    </div>
</nav>
@else
@include("Goodi.User.admin_navbar")
@endif

