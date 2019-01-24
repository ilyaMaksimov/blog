@extends('admin.layout.template')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div>
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="active">Добавление тега</li>
                </ol>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            {!! Form::open(['route' => 'tag.store']) !!}
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Добавление тега</h3>
                    @include('admin.layout.errors')
                </div>

                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="title">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-default">Назад</button>
                    <button class="btn btn-success pull-right">Добавить</button>
                </div>
                <!-- /.box-footer-->
            </div>
            {!! Form::close() !!}
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection