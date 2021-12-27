@extends("layout.main")
@section("title")
    list of post
@endsection
@section("content")
    <div class="alert alert-warning text-center">
        <p>شما فقط قادر به پاک کردن رکوردهایی هستین که خودتان ایجاد کرده باشین</p>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">author</th>
                <th scope="col">title</th>
                <th scope="col">content</th>
                <th scope="col">operation</th>
            </tr>
            </thead>
            <tbody>
            @foreach($postCollection as $postInstance)
                @can("viewAny",$postInstance)
                    <tr>
                        <th scope="row">{{$postInstance->id}}</th>
                        <td>{{$postInstance->author->name}}</td>
                        <td>{{$postInstance->title}}</td>
                        <td>{{\Illuminate\Support\Str::limit($postInstance->content,100)}}</td>
                        <td>
                            <div class="row ">
                                <div class="col-6">
                                    @can("delete",$postInstance)
                                        <form action="{{route("posts.destroy",["post"=>$postInstance->id])}}"
                                              method="post">
                                            @csrf
                                            @method("delete")
                                            <button class="btn btn-danger btn-sm">
                                                delete
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-info btn-sm"
                                       href="{{route("posts.show",["post"=>$postInstance->id])}}">details</a>
                                </div>
                                @can("update",$postInstance)
                                    <div class="col-6">
                                        <a class="btn btn-primary btn-sm"
                                           href="{{route("posts.edit",["post"=>$postInstance->id])}}">edit</a>
                                    </div>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endcan
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="row justify-content-center">
        <div class="col-2">
            {!! $postCollection->links() !!}
        </div>
    </div>
    <br>

@endsection
