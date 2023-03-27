@extends('Master.Master')

@section('main')
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: unset;
        }
    </style>
    <div class="login">
        <div class="login_box">
            <form class="login_form"  method="POST" action="/login">
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
                <button type="submit">Login</button>
                {{-- <h5>Or Sign-up Using</h5>
                <div class="logosocial">
                <a href=""><img src="css/images/—Pngtree—facebook social media icon_8704814.png" padding="100px" alt="" ></a>
                <a href=""><img src="css/images/Twitter-Logo-PNG-2012-–-Now-2.png" alt=""></a>
                <a href=""><img  src="css/images/Google__G__Logo.svg.png" alt=""></a> --}}
                </div>
            </form>
        </div>
    </div>
    <script>
        await window.axios.get('/api/getUserByToken',config)
            .then(function (response) {
                const userData = response.data.user
                result = new UserApi(userData.id, userData.name, userData.email, userData.phone_number,
                    userData.DoB, userData.image, userData.role_id);
            })
            .catch(function (error) {
                console.log(error);
            });
    </script>
@endsection
