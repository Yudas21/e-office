<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Form;
use Illuminate\Support\Facades\Hash;
use App\Divisi;
use App\Jabatan;
use App\Menu;
use App\Level;
use App\Akses;
use App\User;
use App\KlasifikasiSurat;
use App\JenisSurat;
use App\Helpers\Techmil;
use App\Agenda;
use Dhtmlx\Connector\SchedulerConnector;

class AdminController extends Controller
{

	public function __construct(){
    	$this->middleware('auth');
    }

    public function index(){
    	return $this->dasboard();
    }

    public function dasboard(){
    	return view('template.dashboard');
    }

    public function divisi(){
        $divisi = DB::table('divisi as a')
            ->select('a.id', 'a.name', 'b.name as head', 'a.created_at', 'a.updated_at')
            ->leftJoin('divisi as b', 'b.id', '=', 'a.parent')
            ->get();
        return view('template.divisi', compact('divisi'));
    }

    public function divisi_add(){
         $divisi = Divisi::where('parent', '0')->get();
         return view('template.divisi_add', compact('divisi'));
    }

    public function divisi_store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|unique:divisi'
        ]);

        Divisi::create($request->all());
        
        return redirect('admin/divisi')->with('message', 'Data berhasil dibuat!');
    }

    public function divisi_edit($id){
        $parent = Divisi::where('parent', '0')->get();
        $divisi = Divisi::findOrFail($id);
        return view('template.divisi_edit', compact('divisi','parent'));
    }

    public function divisi_update($id, Request $request){
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        Divisi::findOrFail($id)->update($request->all());

        return redirect('admin/divisi')->with('message', 'Data berhasil diubah!');
    }

    public function divisi_delete($id){
        Divisi::findOrFail($id)->delete();
        return redirect('admin/divisi')->with('message', 'Data berhasil dihapus!');
    }

    public function jabatan(){
        $jabatan = Jabatan::all();
        return view('template.jabatan', compact('jabatan'));
    }

    public function jabatan_add(){
         return view('template.jabatan_add');
    }

    public function jabatan_store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|unique:divisi'
        ]);

        Jabatan::create($request->all());
        
        return redirect('admin/jabatan')->with('message', 'Data berhasil dibuat!');
    }

    public function jabatan_edit($id){
        $jabatan = Jabatan::findOrFail($id);
        return view('template.jabatan_edit', compact('jabatan'));
    }

    public function jabatan_update($id, Request $request){
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        Jabatan::findOrFail($id)->update($request->all());

        return redirect('admin/jabatan')->with('message', 'Data berhasil diubah!');
    }

    public function jabatan_delete($id){
        Jabatan::findOrFail($id)->delete();
        return redirect('admin/jabatan')->with('message', 'Data berhasil dihapus!');
    }

    public function menu(){
        $menu = DB::table('menu as a')
            ->select('a.id', 'a.name', 'a.icon', 'a.url', 'b.name as head', 'a.created_at', 'a.updated_at')
            ->leftJoin('menu as b', 'b.id', '=', 'a.parent')
            ->get();
        return view('template.menu', compact('menu'));
    }

    public function menu_add(){
         $menu = Menu::where('parent', '0')->get();
         return view('template.menu_add', compact('menu'));
    }

    public function menu_store(Request $request){
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        Menu::create($request->all());
        
        return redirect('admin/menu')->with('message', 'Data berhasil dibuat!');
    }

    public function menu_edit($id){
        $parent = Menu::where('parent', '0')->get();
        $menu = Menu::findOrFail($id);
        return view('template.menu_edit', compact('menu','parent'));
    }

    public function menu_update($id, Request $request){
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        Menu::findOrFail($id)->update($request->all());

        return redirect('admin/menu')->with('message', 'Data berhasil diubah!');
    }

    public function menu_delete($id){
        Menu::findOrFail($id)->delete();
        return redirect('admin/menu')->with('message', 'Data berhasil dihapus!');
    }

    public function level(){
        $level = Level::all();
        return view('template.level', compact('level'));
    }

    // public function level_add(){
    //      return view('template.level_add');
    // }

    // public function level_store(Request $request){
    //     $this->validate($request, [
    //         'name' => 'required|string|unique:divisi'
    //     ]);

    //     Level::create($request->all());
        
    //     return redirect('admin/level')->with('message', 'Data berhasil dibuat!');
    // }

    public function level_edit($id){
        $level = Level::findOrFail($id);
        return view('template.level_edit', compact('level'));
    }

    public function level_update($id, Request $request){
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        Level::findOrFail($id)->update($request->all());

        return redirect('admin/level')->with('message', 'Data berhasil diubah!');
    }

    public function level_access($id){
        $access = Akses::where('level_id', $id)->get();
        return view('template.level_access', compact('access','id'));
    }

    public function level_access_update($id, Request $request){
      
      $level_id = $request->level_id;
      $menu_id = $request->menu_id != '' ? $request->menu_id : array();
      $insert = array();
      $daftar_menu = array();
      $menus = Akses::select('menu_id')->where('level_id', $level_id)->get();
      $isi_menu = array();
      foreach ($menus as $value) {
         $isi_menu[] = $value->menu_id;
      }
      for($s=0;$s<count($menu_id);$s++){
        $hitung = Akses::where(['menu_id' => $menu_id[$s], 'level_id' => $level_id])->count();
        if($hitung > 0){
             //     
        } else {
            $data = array(
                      'menu_id' => $menu_id[$s],
                      'level_id' => $level_id,
                      'created_at' => date('Y-m-d H:i:s'),
                      'updated_at' => date('Y-m-d H:i:s')
            );
            $insert[] = $data;
        }
      }

      if(count($insert) > 0){
        Akses::insert($insert);
      } else {
        Akses::where('level_id', $level_id)->delete();
      }

      for($s=0;$s<count($menu_id);$s++){
         if (($key = array_search($menu_id[$s], $isi_menu)) !== FALSE) {
              unset($isi_menu[$key]);
         }
      }

      array_unique($isi_menu);
      if(count($isi_menu) > 0){
        for($s=0;$s<count($isi_menu);$s++){
           Akses::where(['level_id' => $level_id, 'menu_id' => $isi_menu[$s]])->delete();
        }
      }
      
      // echo '<pre>';
      // print_r($isi_menu);
      // echo '</pre>';
      // exit(); 
      return redirect('admin/access_level/'.$id)->with('message', 'Akses berhasil diubah!');
        
    }

    // public function level_delete($id){
    //     Jabatan::findOrFail($id)->delete();
    //     return redirect('admin/jabatan')->with('message', 'Data berhasil dihapus!');
    // }

    public function users(){
        $users = DB::table('users as a')
                 ->select('a.id','a.name', 'a.email', 'a.created_at', 'a.updated_at', 'a.deleted_at', 'b.name as jabatan', 'c.name as level', 'd.name as divisi')
                 ->leftJoin('jabatan as b', 'b.id', '=', 'a.jabatan_id')
                 ->leftJoin('level as c', 'c.id', '=', 'a.level_id')
                 ->leftJoin('divisi as d', 'd.id', '=', 'a.divisi_id')->get();
        return view('template.users', compact('users'));
    }

    public function users_add(){
         $jabatan = Jabatan::all();
         $divisi = Divisi::all();
         $level = Level::all();
         return view('template.users_add', compact('jabatan', 'divisi', 'level'));
    }

    public function users_store(Request $request){
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:5',
            'password_confirm' => 'required|string|same:password|min:5',
            'level_id' => 'required',
            'active' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jabatan_id' => $request->jabatan_id,
            'divisi_id' => $request->divisi_id,
            'level_id' => $request->level_id,
            'active' => $request->active,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        return redirect('admin/users')->with('message', 'Data berhasil dibuat!');
    }

    public function users_edit($id){
        $jabatan = Jabatan::all();
        $divisi = Divisi::all();
        $level = Level::all();
        $users = User::findOrFail($id);
        return view('template.users_edit', compact('users', 'jabatan', 'divisi', 'level'));
    }

    public function users_edit_password($id){
        $users = User::findOrFail($id);
        return view('template.users_edit_password', compact('users'));
    }

    public function users_update($id, Request $request){
        $this->validate($request, [
            'name' => 'required|string',
            'email' => $request->email == $request->emailold ? 'required|email' : 'required|email|unique:users',
            'level_id' => 'required',
            'active' => 'required'
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
        // The passwords matches
        return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        User::findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'jabatan_id' => $request->jabatan_id,
            'divisi_id' => $request->divisi_id,
            'level_id' => $request->level_id,
            'active' => $request->active,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect('admin/users')->with('message', 'Data berhasil diubah!');
    }

    public function users_update_password($id, Request $request){
        // if (!(Hash::check($request->current_password, Auth::user()->password))) {
        // // The passwords matches
        // return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        // }
        // $password = '12345';
        // $user = bcrypt($password);
        // print_r($user);
        // $old = User::select('password')->where('id', $id)->get();
        // foreach ($old as $key) {
        //     //
        // }
        // if (bcrypt($request->get('current_password')) != $key->password) {
        // // The passwords matches
        // return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        // }

        // if($request->get('current_password') == $request->get('password')){
        // //Current password and new password are same
        //     return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        // }


        $this->validate($request, [
            'password' => 'required|string|min:5',
            'password_confirm' => 'required|string|same:password|min:5'
        ]);

        User::findOrFail($id)->update([
            'password' => Hash::make($request->password),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect('admin/users')->with('message', 'Password user berhasil diubah!');
    }

    public function users_delete($id){
        User::findOrFail($id)->delete();
        return redirect('admin/users')->with('message', 'Data berhasil dihapus!');
    }

    public function letter_specification(){
        $klasifikasi = KlasifikasiSurat::all();
        return view('template.klasifikasi', compact('klasifikasi'));
    }

    public function letter_specification_add(){
         return view('template.klasifikasi_add');
    }

    public function letter_specification_store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|unique:klasifikasi_surat'
        ]);

        KlasifikasiSurat::create($request->all());
        
        return redirect('admin/letter_specification')->with('message', 'Data berhasil dibuat!');
    }

    public function letter_specification_edit($id){
        $klasifikasi = KlasifikasiSurat::findOrFail($id);
        return view('template.klasifikasi_edit', compact('klasifikasi'));
    }

    public function letter_specification_update($id, Request $request){
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        KlasifikasiSurat::findOrFail($id)->update($request->all());

        return redirect('admin/letter_specification')->with('message', 'Data berhasil diubah!');
    }

    public function letter_specification_delete($id){
        KlasifikasiSurat::findOrFail($id)->delete();
        return redirect('admin/letter_specification')->with('message', 'Data berhasil dihapus!');
    }

    public function letter_kind(){
        $jenis = JenisSurat::all();
        return view('template.jenis', compact('jenis'));
    }

    public function letter_kind_add(){
         return view('template.jenis_add');
    }

    public function letter_kind_store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|unique:jenis_surat'
        ]);

        JenisSurat::create($request->all());
        
        return redirect('admin/letter_kind')->with('message', 'Data berhasil dibuat!');
    }

    public function letter_kind_edit($id){
        $jenis = JenisSurat::findOrFail($id);
        return view('template.jenis_edit', compact('jenis'));
    }

    public function letter_kind_update($id, Request $request){
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        JenisSurat::findOrFail($id)->update($request->all());

        return redirect('admin/letter_kind')->with('message', 'Data berhasil diubah!');
    }

    public function letter_kind_delete($id){
        JenisSurat::findOrFail($id)->delete();
        return redirect('admin/letter_kind')->with('message', 'Data berhasil dihapus!');
    }

    public function agenda(){
         return view('agenda');
    }

    public function data() {
        $connector = new SchedulerConnector(null, "PHPLaravel");
        $connector->configure(new Agenda(), "id", "start_date, end_date, event_name");
        $connector->render();
    }

    public function email_compose(){
         return view('template.email_add');
    }

    public function email_inbox(){
         return view('template.email_inbox');
    }

    public function email_outbox(){
         return view('template.email_outbox');
    }

    public function logout(){
    	Auth::logout();
    	return redirect('');
    }
}
