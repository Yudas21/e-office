<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Techmil;


class LoginController extends Controller
{
    public function index(){
    	return view('template.login');
    }

     public function checkLogin(Request $request){
    	$this->validate($request, [
    		   'email' => 'required|email',
    		   'password' => 'required'
    	]);

      //$remember = Input::has('remember') ? true : false;

    	if(Auth::attempt([
        'email' => $request->email,
        'password' => $request->password
      ])){
        $data_users = Techmil::data_user($request->email);
        foreach ($data_users as $value) {
          $level = $value->level_id;
          $name = $value->name;
        }
        $data = array(
                      'name' => $name,
                      'email' => $request->email,
                      'password' => $request->password,
                      'level' => $level
        );
        session($data);
        return redirect('admin/dashboard');
      } else {
        return redirect('');
      }
    }
}
