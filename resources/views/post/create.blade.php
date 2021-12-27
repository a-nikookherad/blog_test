@extends("layout.main")
@section("title")
    post create
@endsection
@section("content")
    <div class="container">
        <div class="row">
            <div class="col">
                @can("isEven")
                    <form action="{{route("posts.store")}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group my-1">
                            <label for="title">title</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="enter title">
                        </div>
                        <div class="form-group my-2">
                            <label for="exampleFormControlTextarea1">content</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                      name="content"></textarea>
                        </div>
                        <div class="custom-file my-3">
                            <input type="file" class="custom-file-input" id="customFile" name="image">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <div class="my-1">
                            <input type="submit" class="btn btn-success" value="save post">
                            <input type="reset" class="btn btn-danger" value="reset">
                        </div>
                    </form>
                @elsecan("isOdd")
                    <div class="alert alert-warning text-center">
                        <p>you don't have permission for this section</p>
                    </div>
                @endcan
            </div>
        </div>
    </div>
@endsection
