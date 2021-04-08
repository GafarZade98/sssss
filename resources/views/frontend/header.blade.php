<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #02b0af;">

    <div class="container">

        <a class="navbar-brand text-primary" href="#">Laravel</a>


        <button
            class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{route('posts')}}">Posts</a>
                </li>

                <li class="nav-item dropdown">
                    <a
                        class="nav-link" href="#" id="navbarDropdown" role="button"
                        data-mdb-toggle="dropdown" aria-expanded="false">Dropdown
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>


            </ul>

            <div class="navbar-collapse justify-content-center">
                <form class="d-flex input-group  w-auto my-auto ">
                    <input
                        type="search" class="form-control" placeholder="Type query" aria-label="Search"/>
                    <button class="btn text-primary" type="button" >Search
                    </button>
                </form>
            </div>
            @if(Route::has('login'))

                    @auth
                        <ul class="navbar-nav ml-2 mb-2 mb-lg-0">
                            <li class="nav-item ms-auto me-3 me-lg-0 dropdown">
                                <a
                                    class="nav-link"
                                    href="#"
                                    id="navbarDropdown"
                                    role="button"
                                    data-mdb-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-user"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider"/>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">sasds</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @else
                        <ul class="navbar-nav ml-2 mb-2 mb-lg-0">
                            <li class="nav-item"><a href="{{ route('login') }}" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase">{{ __('Login') }}</a></li>
                            @if (Route::has('register'))
                            <li class="nav-item"><a href="{{ route('register') }}" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase">{{ __('Register') }}</a></li>
                            @endif
                        </ul>



                    @endauth

            @endif

        </div>

    </div>

</nav>
