<section class="form-body">
    <div class="form-container">
        <div class="form-title">Edit Account</div>
        <form action="/user/update/{{ $account->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <br>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-content">
                <input type="hidden" name="id" value="{{ $account->id }}" name="id" class="form-control"
                    id="id">
                <div class="input-box">
                    <label for="name" class="font-weight-bold">Name</label>
                    <input type="text" value="{{ $account->name }}" name="name" id="name"
                        aria-describedby="name">
                </div>
                <div class="input-box">
                    <label for="email" class="font-weight-bold">Email address</label>
                    <input type="email" value="{{ $account->email }}" name="email" id="email"
                        aria-describedby="email">
                </div>
                <div class="input-box">
                    <label for="password" class="font-weight-bold">Password</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="input-box">
                    <label for="phone_number" class="font-weight-bold">Phone Number</label>
                    <input type="text" value="{{ $account->phone_number }}" name="phone_number" id="phone_number">
                </div>
                <div class="input-box">
                    <label for="DoB" class="font-weight-bold">Date of Birth</label>
                    <input type="date" value="{{ $account->DoB }}" name="DoB" id="DoB">
                </div>
                <div class="input-box">
                    <label for="image" class="font-weight-bold">Image</label>
                    <div style="display: flex">
                        <input type="file" value="{{ $account->image }}" name="image" class="form-control"
                            id="image"><br>
                        <img style="width:100%; object-fit: cover; object-position: center center; height: 100px; width: 100px;;"
                            src="{{ asset($account->image) }}">
                    </div>
                </div>
                <input type="hidden" name="role_id" id="role">

                <input type="hidden" name="department_id" id="department">
            </div><br>
            <br>
            <div class="button-action">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</section>
<script>
    function isQAM(ele) {

        if (ele.value == 4) {
            document.getElementById('department').hidden = true;
            document.getElementById('department-label').hidden = true;

        } else {
            console.log(ele.value);
            document.getElementById('department').hidden = false;
            document.getElementById('department-label').hidden = false;

        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>
