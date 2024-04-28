@extends('superadmin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <a href="{{route('superadmin.users.create')}}" class="card-title">
                    <i class="fa-solid fa-user-plus"></i>
                </a>
                <div class="card-tools">
                    <form method="get" action="/superadmin/search">
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
                        <th>Ім'я</th>
                        <th>Прізвище</th>
                        <th>Email</th>
                        <th>Роль</th>
                        <th>Дії</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        @if($user->hasRole('admin'))
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->first_name}}</td>
                                <td>{{$user->last_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td>
                                    <a href="#">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="#">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

    </div>

@endsection
