@extends('admin.layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
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
                        <form action="{{route('admin.parking.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="admin_id" value="{{ Auth::id() }}">
                            <div class="mb-3">
                                <label for="count">Count</label>
                                <input type="text" name="count" class="form-control" id="count">
                            </div>
                            <div class="mb-3">
                                <label for="price">Price</label>
                                <input type="text" name="price" class="form-control" id="price">
                            </div>
                            <div class="mb-3">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address">
                            </div>
                            <div class="mb-3">
                                <label for="mark">Mark</label>
                                <input type="text" name="mark" class="form-control" id="mark">
                            </div>
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <input type="text" name="status" class="form-control" id="status">
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
