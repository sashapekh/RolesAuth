<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Edit User</h1>
    {{$user}}
    <div>
        @if(session('status'))
            <h2>{{session('status')}}</h2>
        @endif
    </div>
    <form action="{{route('get_user',$user->id)}}" method="post" role="form">
        {{csrf_field()}}
            <label for="name">Name</label>
            <input type="text" name="name" value="{{$user->name}}">
        <br>
            <label for="email">Email</label>
            <input type="email" name="email" value="{{$user->email}}">
        <br>
             <label for="password">Password</label>
             <input type="password" name="password">
        <h1></h1>
        @foreach($roles as $role)
            <br>
            @if($user->hasRole($role))
                <label for="role">{{$role}}</label>
                <input type="checkbox" name="role" value="{{$role}}" checked>
            @else
                <label for="role">{{$role}}</label>
                <input type="checkbox" name="role" value="{{$role}}">
            @endif


        @endforeach
        <button type="submit">Изменить</button>
    </form>
</body>
</html>