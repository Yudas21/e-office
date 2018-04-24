        @extends('template.layout')
        @section('content')
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Form Update Users</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(1)">User Management</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(2)">Users</a></li>
                        <li class="breadcrumb-item">Update Data</li>
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
                                
                                <form action="{{ url('admin/update_users/'.$users->id) }}" method="post">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="PATCH">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="name" class="control-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $users->name }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label for="email" class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ $users->email }}">
                                    <input type="hidden" class="form-control" name="emailold" value="{{ $users->email }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('jabatan_id') ? 'has-error' : '' }}">
                                    <label for="jabatan_id" class="control-label">Jabatan</label>
                                    <select name="jabatan_id" class="form-control col-md-5">
                                        <option value="">Pilih</option>
                                        @foreach($jabatan as $d_jabatan)
                                          <option value="{{ $d_jabatan->id }}" {{ $users->jabatan_id == $d_jabatan->id ? 'selected' : '' }}>{{ $d_jabatan->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('jabatan_id'))
                                        <span class="help-block">{{ $errors->first('jabatan_id') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('divisi_id') ? 'has-error' : '' }}">
                                    <label for="divisi_id" class="control-label">Divisi</label>
                                    <select name="divisi_id" class="form-control col-md-5">
                                        <option value="">Pilih</option>
                                        @foreach($divisi as $d_divisi)
                                          <option value="{{ $d_divisi->id }}" {{ $users->divisi_id == $d_divisi->id ? 'selected' : '' }}>{{ $d_divisi->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('divisi_id'))
                                        <span class="help-block">{{ $errors->first('divisi_id') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('level_id') ? 'has-error' : '' }}">
                                    <label for="level_id" class="control-label">Level</label>
                                    <select name="level_id" class="form-control col-md-5">
                                        <option value="">Pilih</option>
                                        @foreach($level as $d_level)
                                          <option value="{{ $d_level->id }}" {{ $users->level_id == $d_level->id ? 'selected' : '' }}>{{ $d_level->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('level_id'))
                                        <span class="help-block">{{ $errors->first('level_id') }}</span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('active') ? 'has-error' : '' }}">
                                    <label for="active" class="control-label">Active</label><br>
                                    <input type="radio" name="active" value="1" {{ $users->active == 1 ? 'checked' : '' }}> Yes 
                                    <input type="radio" name="active" value="0" {{ $users->active == 0 ? 'checked' : '' }}> No 
                                    @if ($errors->has('active'))
                                        <span class="help-block">{{ $errors->first('active') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info">Simpan</button> <a href="{{ url('admin/users') }}" class="btn btn-success">Kembali</a>
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