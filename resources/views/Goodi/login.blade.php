@extends('Master.Master')

@section('main')
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
                    <input type="text" id="email" name="email" required="required">
                    <span>Email</span>
                    <i></i>
                </div>
                <div class="input_box">
                    <input type="password" id="password" name="password" required="required">
                    <span>Password</span>
                    <i></i>
                </div>
                <br>
                <div class="check">
                    <input type="checkbox" name="check"> <label for="check">Remember me</label>
                </div>
                <button type="submit" onclick="login()">Login</button>
            </form>
        </div>
        </form>
    </div>
    </div>
    <button onclick="login()">ádaadds</button>
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
                .catch(function (error) {
                    console.log(error);
                });
        }
    </script>
@endsection
