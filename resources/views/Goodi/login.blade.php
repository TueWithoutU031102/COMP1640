@extends('Master.Master')

@section('main')
<div id="preloader"></div>
@include('Goodi.nav_bar')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: unset;
        }
    </style>
    <div class="login">
        <div class="login_box">
            <form class="login_form" method="POST" action="/login">
                @csrf
                <h2>Login</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="input_box">
                    <input type="text" id="email" name="email">
                    <span>Email</span>
                    <i></i>
                </div>
                <div class="input_box">
                    <input type="password" id="password" name="password">
                    <span>Password</span>
                    <i></i>
                </div>
                <br>
                <button type="submit" onclick="login()">Login</button>
            </form>
        </div>
        </form>
    </div>
    </div>
    <script>
        function login() {
            let data = {
                email: $("#email").val(),
                password: $("#password").val()
            }
            console.log(data)
             window.axios.post('/api/login', data)
                .then(function (response) {
                    localStorage.setItem('jwt', response.data.token)
                    localStorage.setItem('user', JSON.stringify(response.data.user))
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    </script>
@endsection
