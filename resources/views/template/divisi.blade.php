        @extends('template.layout')
        @section('content')
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Divisi</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(1)">User Management</a></li>
                        <li class="breadcrumb-item">Divisi</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ url('admin/add_divisi') }}" class="btn btn-success">Tambah Data</a>
                                @if ($message = Session::get('message'))
                                    <div class="alert alert-success" style="margin-top: 20px;">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Name</th>
                                                <th style="text-align: center;">Parent</th>
                                                <th style="text-align: center;">Created at</th>
                                                <th style="text-align: center;">Updated at</th>
                                                <th style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($divisi as $d_divisi)
                                                <tr>
                                                    <td>{{ $d_divisi->name }}</td>
                                                    <td>{{ $d_divisi->head }}</td>
                                                    <td style="text-align: center;">{{ $d_divisi->created_at }}</td>
                                                    <td style="text-align: center;">{{ $d_divisi->updated_at }}</td>
                                                    <td style="text-align: center;"><a href="{{ url('admin/edit_divisi/'.$d_divisi->id) }}"><i class="fa fa-edit"></i></a> <a href="{{ url('admin/delete_divisi/'.$d_divisi->id) }}"><i class="fa fa-trash"></i></a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            @stop