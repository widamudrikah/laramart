<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index() {
        return view('admin.setting.index');
    }

    public function store(Request $request) {
        $setting = Setting::first();
        if($setting) {
            // update

        }else{
            // create
            
        }
    }
}
