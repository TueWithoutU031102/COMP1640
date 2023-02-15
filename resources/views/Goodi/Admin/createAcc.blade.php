<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <h1>Create Account</h1>
    <form action="/admin/createAcc" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="name" name="name" class="form-control" id="name" aria-describedby="name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" value="123456" name="password" class="form-control" id="password">
        </div>
        <div class="mb-3">
            <label for="phonenumber" class="form-label">Phone Number</label>
            <input type="phonenumber" name="phonenumber" class="form-control" id="phonenumber"
                aria-describedby="phonenumber">
        </div>
        <div class="mb-3">
            <label for="DoB" class="form-label">Date of Birth</label>
            <input type="date" name="DoB" class="form-control" id="DoB" aria-describedby="DoB">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="text" name="image" class="form-control" id="image">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>

            <select name="role" class="form-select" id="role" aria-label="Role">
                <option value="Staff">Staff</option>
                <option value="Quality Assurance Coordinator">Quality Assurance Coordinator</option>
                <option value="Quality Assurance Manager">Quality Assurance Manager</option>
            </select>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="check-email">
            <label class="form-check-label" for="check-email">Check account</label>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href="/admin/acc">
        <button class="btn btn-primary">Back</button>
    </a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>
