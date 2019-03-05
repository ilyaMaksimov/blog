@extends('admin.layout.template')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div>
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="active">Подписчики</li>
                </ol>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Подписчики</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Статус подтверждения</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subscribers as $subscriber)
                            <tr>
                                <td>{{$subscriber->getId()}}</td>
                                <td>{{$subscriber->getEmail()}}</td>
                                <td>
                                    @if($subscriber->isVerify())
                                        <span class="label label-success">Подтвержден</span>
                                    @else
                                        <span class="label label-warning">Ожидает подтверждения</span>
                                    @endif
                                </td>
                                <td>
                                    {{Form::open(['route'=>['subscriber.destroy', $subscriber->getId()], 'method'=>'delete'])}}
                                    <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                                        <i class="fa fa-remove"></i>
                                    </button>

                                    {{Form::close()}}
                                </td>
                            </tr>
                        @endforeach
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection