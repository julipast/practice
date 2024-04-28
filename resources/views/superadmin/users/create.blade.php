@extends('superadmin.layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Створити адміністратора</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                   <div class="col-12">
                        <form action="{{route('superadmin.users.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="role" value="admin">
                            <div class="mb-3">
                                <label for="count">Ім'я</label>
                                <input type="text" name="first_name" class="form-control" id="count">
                            </div>
                            <div class="mb-3">
                                <label for="price">Прізвище</label>
                                <input type="text" name="last_name" class="form-control" id="price">
                            </div>
                            <div class="mb-3">
                                <label for="address">Email</label>
                                <input type="text" name="email" class="form-control" id="address">
                            </div>
                            <div class="mb-3">
                                <label for="mark">Пароль</label>
                                <input type="text" name="password" class="form-control" id="mark">
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                   </div>
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
