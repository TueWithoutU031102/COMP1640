@extends('Master.Master')

@section('main')
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: 0;
        }
    </style>
    <div class="login">

        <div class="login_box">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="login_form"  method="POST" action="/login">
                @csrf
                <h2>Login</h2>
                <div class="input_box">
                    <input type="text" name="email" required="required">
                    <span>Email</span>
                    <i></i>
                </div>
                <div class="input_box">
                    <input type="password" name="password" required="required">
                    <span>Password</span>
                    <i></i>
                </div>
                <br>
                <div class="check">
                    <input type="checkbox" name="check"> <label for="check">Remember me</label>
                </div>
                <button type="submit">Login</button>
                <h5>Or Sign-up Using</h5>
                <div class="logosocial">
                {{-- <a href=""><img src="css/images/—Pngtree—facebook social media icon_8704814.png" padding="100px" alt="" ></a>
                <a href=""><img src="css/images/Twitter-Logo-PNG-2012-–-Now-2.png" alt=""></a>
                <a href=""><img  src="css/images/Google__G__Logo.svg.png" alt=""></a> --}}
                </div>
            </form>
        </div>
    </div>
@endsection
