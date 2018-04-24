        @extends('template.layout')
        @section('content')
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Access</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(1)">User Management</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(2)">Level</a></li>
                        <li class="breadcrumb-item">Access</li>
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
                                @if ($message = Session::get('message'))
                                    <div class="alert alert-success" style="margin-top: 20px;margin-bottom: 20px;">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif

                                Level as <strong>{{ Techmil::get_level_name($id) }}</strong><br/><br/>

                                <?php $kumpulan_menu = array();?>
                                @foreach ($access as $d_access)
                                  <?php $kumpulan_menu[] = $d_access->menu_id; ?>
                                @endforeach

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Menu</th>
                                                <th style="text-align: center;width:15px;">Check</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <form action="{{ url('admin/update_access_level/'.$id) }}" method="post">
                                            {{csrf_field()}}
                                            <input name="level_id" type="hidden" value="{{ $id }}">
                                           <?php $parent = Techmil::get_parent(); ?>
                                            @foreach ($parent as $d_parent)
                                               <tr style="background: #eee;">
                                                  <td>{{ $d_parent->name }}</td>
                                                  <td style="text-align: center;"><input type="checkbox" name="menu_id[]" value="{{ $d_parent->id }}" {{ in_array($d_parent->id, $kumpulan_menu) ? 'checked' : '' }}></td>
                                               </tr>
                                               <?php $child1 = Techmil::get_child($d_parent->id); ?>
                                                     @foreach ($child1 as $d_child1)
                                                        <tr>
                                                            <td>&nbsp;&nbsp; <i class="fa fa-angle-right"></i> {{ $d_child1->name }}</td>
                                                            <td style="text-align: center;"><input type="checkbox" name="menu_id[]" value="{{ $d_child1->id }}" {{ in_array($d_child1->id, $kumpulan_menu) ? 'checked' : '' }}></td>
                                                        </tr>
                                                        <?php $child2 = Techmil::get_child($d_child1->id); ?>
                                                        @foreach ($child2 as $d_child2)
                                                            <tr>
                                                                <td>&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-angle-double-right"></i> {{ $d_child2->name }}</td>
                                                                <td style="text-align: center;"><input type="checkbox" name="menu_id[]" value="{{ $d_child2->id }}" {{ in_array($d_child2->id, $kumpulan_menu) ? 'checked' : '' }}></td>
                                                            </tr>
                                                        @endforeach
                                                     @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn btn-info">Simpan</button>
                                <a href="{{ url('admin/level') }}" class="btn btn-success">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            @stop