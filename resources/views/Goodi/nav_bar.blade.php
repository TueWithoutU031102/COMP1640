@extends('Master.Master')
<nav>
    <a href="/" ><img class="logo" src="/css/images/logo_transparent_white.png"></a>
    <div class="nav-link" id="navlink">
        <ul>
            <li><a href="/index" >FORUM</a></li>
            <li><a href="/about" >ABOUT</a></li>
            <li><a href="/department">DEPARTMENT</a></li>
            <li><a href="/FAQ">FAQs</a></li>
            @if(!Auth::user())
                <li><a href="/login">LOGIN</a></li>
            @else
                <li><a href="/">{{Auth::user()->name}}</a></li>
            @endif
        </ul>
    </div>
</nav>
