@extends('frontend.layout.template')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <article class="post">
                        <div class="post-thumb">
                            <a href="{{route('frontend.post.show', $post->getSlug())}}"><img
                                        src="{{\App\Components\Image::getPath($post->getImage())}}" alt=""></a>
                        </div>
                        <div class="post-content">
                            <header class="entry-header text-center text-uppercase">
                                <h6>
                                    <a href="{{route('frontend.category.show', $post->getCategory()->getSlug())}}"> {{$post->getCategory()->getTitle()}}</a>
                                </h6>
                                <h1 class="entry-title"><a
                                            href="{{route('frontend.post.show', $post->getSlug())}}">{{$post->getTitle()}}</a>
                                </h1>


                            </header>
                            <div class="entry-content">
                                {!! $post->getContent() !!}
                            </div>
                            <div class="decoration">
                                @foreach($post->getTags() as $tag)
                                    <a href="{{route('frontend.tag.show', $tag->getSlug())}}"
                                       class="btn btn-default">{{$tag->getTitle()}}</a>
                                @endforeach
                            </div>

                            <div class="social-share">
							<span
                                    {{--class="social-share-title pull-left text-capitalize">By {{$post->author->name}} On {{$post->getDate()}}</span>--}}
                                    class="social-share-title pull-left text-capitalize"> Автор: {{env('NAME_AUTHOR')}}
                                <br>
                                Дата: {{$post->getDate()}}</span>
                                @include('frontend.layout.social_networks')
                            </div>
                        </div>
                    </article>
                {{--<div class="top-comment"><!--top comment-->
                    <img src="/images/comment.jpg" class="pull-left img-circle" alt="">
                    <h4>Rubel Miah</h4>

                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy hello ro mod tempor
                        invidunt ut labore et dolore magna aliquyam erat.</p>
                </div>--}}<!--top comment end-->

                    @if(!empty($relatedPosts))
                        <div class="related-post-carousel"><!--related post carousel-->
                            <div class="related-heading">
                                <h4>Вам так же может понравиться:</h4>
                            </div>
                            <div class="items">
                                @foreach($relatedPosts as $post)
                                    <div class="single-item">
                                        <a href="{{route('frontend.post.show', $post->getSlug())}}">
                                            <img src="{{\App\Components\Image::getPath($post->getImage())}}" alt="">

                                            <p>{{$post->getTitle()}}</p>
                                        </a>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endif
                <!--related post carousel-->
                    @if(!empty($post->getComments()))
                        @foreach($post->getComments() as $comment)
                            @if($comment->isStatus() == \App\Entities\Comment::STATUS_PUBLIC)
                                <div class="bottom-comment"><!--bottom comment-->
                                    <div class="comment-img">
                                        <img class="img-circle" src="{{$comment->getAuthor()->getPathAvatar()}}" alt=""
                                             width="75" height="75">

                                    </div>
                                    @if(\Illuminate\Support\Facades\Gate::forUser(\Illuminate\Support\Facades\Auth::user())->allows('author-comment',$comment->getAuthor()))
                                        <div class="text-right">
                                            {{Form::open(['route'=>['frontend.comment.destroy', $comment->getId()], 'method'=>'delete'])}}
                                            <button onclick="return confirm('Удалить комментарий?')" type="submit"
                                                    class="delete">
                                                <i class="fa fa-remove"></i>
                                            </button>
                                            {{Form::close()}}

                                        </div>
                                    @endif

                                    {{-- <div class="text-right">
                                    <a href="{{route('frontend.comment.delete', $comment->getId() )}}">Удалить</a>
                                    </div>
     --}}
                                    <div class="comment-text">
                                        <h5>{{$comment->getAuthor()->getName()}}</h5>
                                        <p class="comment-date">
                                            {{--  {{$comment->created_at->diffForHumans()}}--}}
                                            {{--  {{$comment->created_at->diffForHumans()}}--}}
                                            Время
                                        </p>


                                        <p class="para">{{$comment->getText()}}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif

                <!-- end bottom comment-->

                    @if(Auth::check())
                        <div class="leave-comment"><!--leave comment-->
                            <h4>Оставьте комментарий:</h4>


                            <form class="form-horizontal contact-form" role="form" method="post"
                                  action="{{route('frontend.comment')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="post_id" value="{{$post->getId()}}">
                                <div class="form-group">
                                    <div class="col-md-12">
                                             <textarea class="form-control" rows="6" name="message"
                                                       placeholder="Ваше сообщение"></textarea>
                                    </div>
                                </div>
                                <button class="btn send-btn">Post Comment</button>
                            </form>
                        </div><!--end leave comment-->
                    @endif

                </div>
                @include('frontend.layout._sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection