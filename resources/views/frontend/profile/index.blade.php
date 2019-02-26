@extends('frontend.layout.template')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <div class="leave-comment mr0"><!--leave comment-->
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{session('status')}}
                            </div>
                        @endif
                        @include('admin.layout.errors')
                        <h3 class="text-uppercase">My profile</h3>
                        <br>
                        {{--<div class="col-xs-8 col-md-4 ">--}}
                        <img src="{{$user->getPathAvatar()}}" alt="avatar" class="profile-image img-circle "
                             width="50%">
                        {{--</div>--}}

                        <form class="form-horizontal contact-form" role="form" method="post"
                              action="{{route('profile')}}" enctype="multipart/form-data">

                            @csrf
                            <div class="form-group">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-12">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="name" value="{{$user->getName()}}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-12">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{$user->getEmail()}}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                                <div class="col-md-12">
                                    <input type="file" class="form-control " id="image" name="avatar">

                                    @if ($errors->has('avatar'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn send-btn">Update</button>

                        </form>
                    </div><!--end leave comment-->
                </div>
                @include('frontend.layout._sidebar')
            </div>
        </div>
    </div>
@endsection