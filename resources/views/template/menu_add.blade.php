        @extends('template.layout')
        @section('content')
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Form Tambah Menu</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(1)">User Management</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(2)">Menu</a></li>
                        <li class="breadcrumb-item">Tambah Data</li>
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
                                
                                <form action="{{ url('admin/store_menu') }}" method="post">
                                {{csrf_field()}}
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="name" class="control-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('icon') ? 'has-error' : '' }}">
                                    <label for="icon" class="control-label">Icon</label>
                                    <input type="text" class="form-control" name="icon" value="{{ old('icon') }}">
                                    @if ($errors->has('icon'))
                                        <span class="help-block">{{ $errors->first('icon') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
                                    <label for="url" class="control-label">Url</label>
                                    <input type="text" class="form-control" name="url" value="{{ old('url') }}">
                                    @if ($errors->has('url'))
                                        <span class="help-block">{{ $errors->first('url') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name" class="control-label">Parent</label>
                                    <select class="form-control col-md-4" name="parent">
                                        <option value="0">as Parent</option>

                                        @foreach ($menu as $d_menu) 

                                            <option value="{{ $d_menu->id }}">{{ $d_menu->name }}</option>
                                            {{ $child = Techmil::get_child($d_menu->id) }}
                                                @foreach ($child as $d_child) 
                                                  <option value="{{ $d_child->id }}">{{ $d_child->name }}</option>
                                                @endforeach
                                            
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info">Simpan</button> <a href="{{ url('admin/menu') }}" class="btn btn-success">Kembali</a>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            @stop