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
    <h1>Roles</h1>


    <br>


    {{--<form role="form" action="{{route('rolesChange')}}" method="post" >--}}
        {{--{{ csrf_field() }}--}}
        {{--<table border="1">--}}
            {{--<caption>Table of Roles</caption>--}}
            {{--<tr>--}}
                {{--<th>Permissions/Roles</th>--}}
                {{--@foreach($roles as $role)--}}
                    {{--<th>{{$role->name}}</th>--}}
                {{--@endforeach--}}
            {{--</tr>--}}
            {{--@foreach($permissions as $permission)--}}
                {{--<tr>--}}
                    {{--<td>{{$permission->display_name}}</td>--}}
                    {{--@foreach($roles as $role)--}}
                        {{--<th><input type="checkbox" name="{{$role->name}}{{$role->id}}" value="{{$permission->name}}" ></th>--}}
                    {{--@endforeach--}}
                {{--</tr>--}}
            {{--@endforeach--}}
        {{--</table>--}}
        {{--<button type="submit">Save changes</button>--}}
    {{--</form>--}}

    <form role="form" action="{{route('rolesChange')}}" method="post" >
        {{ csrf_field() }}
        <table border="1">
            <caption>Table of Roles</caption>
            <tr>
                <th>Permissions/Roles</th>
                @foreach($roles as $role)
                    <th>{{$role->name}}</th>
                @endforeach
            </tr>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{$permission->display_name}}</td>
                    @foreach($roles as $role)

                      {{--{{dd($role->hasPermission($permission))}}--}}
                        @if($role->hasPermission($permission->name))
                            <th><input type="checkbox" name="{{$role->name}}[]" value="{{$permission->id}}" checked></th>
                            @else
                            <th><input type="checkbox" name="{{$role->name}}[]" value="{{$permission->id}}"></th>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </table>
        <br>

        <button type="submit">Save changes</button>
    </form>

</body>
</html>

