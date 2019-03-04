@extends('frontend.layout.template')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        @foreach($posts as $post)
                            {{--<div class="col-md-6">
                                <article class="post post-grid">
                                    <div class="post-thumb">
                                        <a href="{{route('frontend.post.show', $post->getSlug())}}"><img
                                                    src="{{\App\Components\Image::getPath($post->getImage())}}" alt=""></a>

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
                                            {!! $post->getDescription() !!}
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
                            </div>--}}


                                <div class="col-md-6 ">
                                    <div class="thumbnail">
                                        {{--<div class="imageGallery"
                                             style="background-image: url('uploads/IcHFX2ojBe.jpeg')">
                                        </div>--}}
                                        <a href="{{route('frontend.post.show', $post->getSlug())}}">
                                            <img height="150" src="{{\App\Components\Image::getPath($post->getImage())}}" alt="" class="{{--img-rounded --}}img-responsive"></a>
                                        <img src="..." alt="...">
                                        <div class="caption">
                                            <h3>Thumbnail label</h3>
                                            <p>...</p>
                                            <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                        </div>
                                    </div>
                                </div>

                        @endforeach

                    </div>
                    {{--    {{$posts->links()}}--}}
                </div>
                @include('frontend.layout._sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection