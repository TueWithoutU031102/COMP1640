@extends('Master.Master')

@section('main')
    @include('Goodi.nav_bar')
    <br><br>

    <section class="form-body">
        <div class="form-container">
            <div class="form-title">Edit Account</div>
            <form action="/admin/editAcc/{id}" method="POST" enctype="multipart/form-data">
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
                    <div class="input-box">
                        <label for="role" class="font-weight-bold">Role</label>
                        <select onchange="isQAM(this)" value="{{ $account->role->id }}" name="role_id" class="form-select"
                            id="role" aria-label="Role">
                            @foreach ($listRoles as $role)
                                @if ($role->id == $account->role->id)
                                    <option selected value="{{ $role->id }}">{{ $role->name }}</option>
                                @else
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="input-box">
                        <label for="department" class="font-weight-bold" id="department-label">Department</label>
                        <select name="department_id" value="{{ $account->department }}" selected class="form-select"
                            id="department" aria-label="Department">
                            @foreach ($listDepartments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div><br>
                </div>
                <div class="button-action">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-danger" href='/admin/acc'>Back</a>
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
    @include('Goodi.footer')
@endsection
