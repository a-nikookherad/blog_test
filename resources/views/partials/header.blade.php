<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    @stack("styles")

</head>
<body>
<div class="container " style="height: 250px">
    <div class="row justify-content-center" style="height: 100%">

        <div class="col text-center bg-info" style="font-size: 25px;border-radius: 15px">
            @yield("title")
        </div>
    </div>
</div>
<div class="container mb-4">
    <div class="row">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="{{route("posts.index")}}">list</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route("posts.create")}}">create</a>
            </li>
            @if(\Illuminate\Support\Facades\Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{route("logout")}}">logout</a>
                </li>
            @endif
        </ul>
    </div>
</div>

<div class="container">
    <div class="row">
        @include("components.validationAlert")
    </div>
</div>
