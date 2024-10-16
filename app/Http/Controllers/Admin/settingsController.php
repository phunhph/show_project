<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\settings;
use Illuminate\Http\Request;

class settingsController extends Controller
{
    public function index(){
        $settings = settings::paginate(10);
        return view('admin.pages.settings.index',compact('settings'));
    }


    public function search(Request $request){
        $nameValue = $request->input('nameValue');
        $request->validate([
            'nameValue' => 'required',
        ], [
            'nameValue.required' => 'Không được để trống ngày bắt đầu'
        ]);
        $settings = settings::where('title','like', '%' . $nameValue . '%')->paginate(10);
        return view('admin.pages.settings.index',compact('settings','nameValue'));
    }



    public function edit($id){
        $setting = settings::find($id);
        return view('admin.pages.settings.edit',compact('setting'));
    }

    public function update(Request $request){
        $request->validate([
            'content' => 'required'
        ],[
            'content.required' => 'Không được để trống nội dung'
        ]);

        $level = settings::find($request->id);

        $level->content = $request->input('content');
        $level->save();

        return redirect()->route('admin.settings.index');
    }
}
