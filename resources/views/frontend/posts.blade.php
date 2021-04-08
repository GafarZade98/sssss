@extends('frontend.welcome')
@section('title','Posts')
@section('content')


    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light bg-light mt-5">
            <div class="container">
                <ul class="list-unstyled">
                    <li class="nav-item dropdown text-sidebar" style="display: inline-block; font-size: 25px">
                        <a
                            class="nav-link" href="#" id="navbarDropdown" role="button"
                            data-mdb-toggle="dropdown" aria-expanded="false">Item
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                            @foreach($items as $item)
                                <li class="dropdown-item"><a
                                        href="{{route('posts',['item' => $item->slug])}}">{{$item->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item dropdown text-sidebar" style="display: inline-block; font-size: 25px">
                        <a
                            class="nav-link" href="#" id="navbarDropdown" role="button"
                            data-mdb-toggle="dropdown" aria-expanded="false">Topic
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                            @foreach($topics as $topic)
                                <li class="dropdown-item"><a
                                        href="{{route('posts',['topic' => $topic->slug])}}">{{$topic->name}}</a>
                                </li>
                            @endforeach

                        </ul>
                    </li>

                </ul>
                <button type="button" class="btn text-sidebar bg-turbo-yellow">
                    Create an article
                </button>
            </div>
        </nav>

        <div id="content">
            <div class="row">
                @foreach($posts as $post)
                    <div class="card float-start mr-5 mt-5" style="width: 18rem;">
                        <img src="{{$post->image}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$post->name}}</h5>
                            <p class="card-text">{{$post->content }}</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <hr>
        <div class="m-4">
        {{$posts->links()}}
        </div>
    </div>



@endsection
