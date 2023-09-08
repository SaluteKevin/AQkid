<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    @vite('resources/js/app.js')
</head>
<body>


{{Auth::getUser()->username}}
<a href="{{ route('test') }}">{{Auth::getUser()->email}} logout</a>
<p class="text-5xl">test</p>

</body>
</html>