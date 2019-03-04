@extends('frontend.layout.template')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-md-6">
                                <article class="post post-grid">
                                    <div class="post-thumb">
                                        <a href="{{route('frontend.post.show', $post->getSlug())}}">
                                            <img src="{{\App\Components\Image::getPath($post->getImage())}}" alt=""></a>

                                        <a href="{{route('frontend.post.show', $post->getSlug())}}"
                                           class="post-thumb-overlay text-center">
                                            <div class="text-uppercase text-center">View Post</div>
                                        </a>
                                    </div>
                                    <div class="post-content">
                                        <header class="entry-header text-center text-uppercase">
                                            <h6>
                                                <a href="{{route('frontend.category.show', $post->getCategory()->getSlug())}}"> {{$post->getCategory()->getTitle()}}</a>
                                            </h6>

                                            <h1 class="entry-title">
                                                <a href="{{route('frontend.post.show', $post->getSlug())}}">{{$post->getTitle()}}</a>
                                            </h1>


                                        </header>
                                        <div class="entry-content">
                                            <div style="height: 100px">
                                                {!! $post->getDescription() !!}
                                            </div>
                                            <hr>
                                            <div class="social-share">

                                                <span class="social-share-title pull-left text-capitalize">
                                                    Автор:<a href="#">{{env('NAME_AUTHOR')}}</a>
                                                    <br>
                                                    Дата: {{$post->getDate()}}</span>
                                            </div>
                                        </div>
                                    </div>

                                </article>
                            </div>

                            {{--
                                                        <div class="col-md-6 ">

                                                            <div class="thumbnail">

                                                                <a href="{{route('frontend.post.show', $post->getSlug())}}">
                                                                    <img src="{{\App\Components\Image::getPath($post->getImage())}}" alt=""
                                                                         class="img-rounded img-responsive"></a>
                                                                <div class="caption">
                                                                    <header class="entry-header text-center text-uppercase">
                                                                        <h6>
                                                                            <a href="{{route('frontend.category.show', $post->getCategory()->getSlug())}}"> {{$post->getCategory()->getTitle()}}</a>
                                                                        </h6>

                                                                        <h1 class="entry-title">
                                                                            <a href="{{route('frontend.post.show', $post->getSlug())}}">{{$post->getTitle()}}</a>
                                                                        </h1>


                                                                    </header>
                                                                    <div class="entry-content">
                                                                        {!! $post->getDescription() !!}
                                                                        <hr>
                                                                        <div class="social-share">

                                                                            <span class="social-share-title pull-left1 text-capitalize">
                                                                                Автор:<a href="#">{{env('NAME_AUTHOR')}}</a>
                                                                                <br>Дата: {{$post->getDate()}}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>--}}
                        @endforeach

                    </div>
                    <div class="text-center">{{$posts->links()}}</div>
                </div>
                @include('frontend.layout._sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection