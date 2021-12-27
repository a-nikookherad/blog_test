@extends("layout.main")
@section("title")
    show post
@endsection
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{$postInstance->hasMedia()?$postInstance->getFirstMedia()->getUrl():"#"}}"  alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$postInstance->title}}</h5>
                        <p class="card-text">{{$postInstance->content}}</p>
                        <a href="#" class="btn btn-primary">{{$postInstance->author->name}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
