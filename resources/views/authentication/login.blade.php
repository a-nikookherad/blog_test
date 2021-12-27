@extends("layout.main")
@section("title")
    Login page
@endsection
@section("content")
    <div class="container">
        <div class="row text-center">
            <div class="col-6 offset-3 my-1">
                <form action="{{route("login.post")}}" method="post">
                    @csrf
                    <div class="col-12">
                        <input class="form-control my-1" type="email" name="email" placeholder="enter your email">
                    </div>
                    <div class="col-12">
                        <input class="form-control my-1" type="password" name="password"
                               placeholder="enter your password">
                    </div>
                    <div class="col-12">
                        <input class="btn btn-success my-1" type="submit" value="login">
                        <input class="btn btn-danger my-1" type="reset" value="reset">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
