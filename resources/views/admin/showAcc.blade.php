<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
</head>

<body>
    <div class="card" style="margin:20px">
        <div class="card-header">Account page</div>
    </div>
    <div class="card-body">
        <h5 class="card-title">Name:{{$account->name}}</h5>
        <p class="card-text">ID:{{$account->id}}</p>
        <p class="card-text">Email:{{$account->email}}</p>
        <p class="card-text">Role:{{$account->role}}</p>
        <p class="card-text">Image: <img src="{{ $account->image }}"></p>

    </div>
</body>

</html>
