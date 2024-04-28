@extends('admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <a href="{{route('parking.create')}}" class="card-title">
                    <i class="fa-solid fa-plus"></i>
                </a>
                <div class="card-tools">
                    <form method="get" action="/admin/search">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="search" class="form-control float-right" placeholder="Пошук" value="{{isset($search)?$search:''}}">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 35em;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Адреса</th>
                        <th>Кількість місць</th>
                        <th>Вартість за годину</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($parkings as $parking)
                            <tr>
                                <td>{{$parking->id}}</td>
                                <td>{{$parking->address}}</td>
                                <td>{{$parking->count}}</td>
                                <td>{{$parking->price}}</td>
                                <td>
                                    <a href="#">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

    </div>

@endsection
