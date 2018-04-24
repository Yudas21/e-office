<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
 
class Techmil {
    public static function get_child($id) {
        $menus = DB::table('menu')->where('parent', $id)->get();
        return $menus;
    }

    public static function get_count_child($id) {
        $menus = DB::table('menu')->where('parent', $id)->count();
        return $menus;
    }

    public static function data_user($id) {
        $menus = DB::table('users')->where('email', $id)->get();
        return $menus;
    }

    public static function get_parent() {
        $menus = DB::table('menu')->where('parent', '0')->get();
        return $menus;
    }

    public static function get_parent_id($id) {
    	$parent = '';
        $menus = DB::table('menu')->select('parent')->where('id', $id)->get();
        if(DB::table('menu')->select('parent')->where('id', $id)->count() > 0){
        	foreach ($menus as $value) {
        		$parent = $value->parent;
        	}
        }
        return $parent;
    }

    public static function get_mymenu($id) {
        $data_menu = array();
        $menus = DB::table('akses')->select('menu_id')->where('level_id', $id)->get();
        foreach ($menus as $key) {
            $data_menu[] = $key->menu_id;
        }
        return $data_menu;
    }

    public static function get_level_name($id) {
    	$name = '';
        $levels = DB::table('level')->select('name')->where('id', $id)->get();
        if(DB::table('level')->where('id', $id)->count() > 0){
        	foreach ($levels as $value) {
        		$name = $value->name;
        	}
        }
        return $name;
    }
}