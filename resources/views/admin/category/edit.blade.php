@extends('admin.layout.template')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div>
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">Home</a></li>
                    <li><a href="{{ route('category.index') }}">Категории</a></li>
                    <li class="active">Изменение категории</li>
                </ol>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                {!! Form::open(['route'=>['category.update',$category->getId()], 'method'=>'put']) !!}
                <div class="box-header with-border">
                    <h3 class="box-title">Изменение категории</h3>
                    @include('admin.layout.errors')
                </div>
                <div class="box-body">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$category->getTitle()}}" name="title">
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-default">Назад</button>
                    <button class="btn btn-warning pull-right">Изменить</button>
                </div>
                <!-- /.box-footer-->
                {!! Form::close() !!}
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection