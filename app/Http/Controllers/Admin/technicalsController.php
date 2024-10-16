<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\technicals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class technicalsController extends Controller
{
    public function index(){
        $allTechnicals = technicals::paginate(10);
        return view('admin.pages.technicals.index',compact('allTechnicals'));
    }

    public function sortDelete(){
        $allTechnicals = technicals::onlyTrashed()->paginate(10);
        return view('admin.pages.technicals.sortDelete',compact('allTechnicals'));
    }



    public function search(Request $request){
        $nameValue = $request->input('nameValue');
        $request->validate([
            'nameValue' => 'required',
        ], [
            'nameValue.required' => 'Không được để trống ngày bắt đầu'
        ]);
        $allTechnicals = technicals::where('name','like', '%' . $nameValue . '%')->paginate(10);
        return view('admin.pages.technicals.index',compact('allTechnicals','nameValue'));
    }

    public function searchSortDelete(Request $request){
        $nameValue = $request->input('nameValue');
        $request->validate([
            'nameValue' => 'required',
        ], [
            'nameValue.required' => 'Không được để trống ngày bắt đầu'
        ]);
        $allTechnicals = technicals::onlyTrashed()->where('name','like', '%' . $nameValue . '%')->paginate(10);
        return view('admin.pages.technicals.sortDelete',compact('allTechnicals','nameValue'));
    }

    public function create(){
        return view('admin.pages.technicals.create');
    }

    public function store(Request $request){
        $request->validate([
            'technicalsName' => 'required|unique:technicals,name'
        ],[
            'technicalsName.required' => 'Không được để trống tên công nghệ',
            'technicalsName.unique' => 'Tên công nghệ đã tồn tại'
        ]);

        technicals::create([
            'name' => $request->technicalsName
        ]);

        return redirect()->route('admin.technicals.index');
    }

    public function edit($id){
        $technicalsOne = technicals::withTrashed()->find($id);
        return view('admin.pages.technicals.edit',compact('technicalsOne'));
    }

    public function update(Request $request){
        $request->validate([
            'technicalsName' => 'required'
        ],[
            'technicalsName.required' => 'Không được để trống trạng thái hiển thị'
        ]);

        $technicals = technicals::withTrashed()->find($request->id);

        $technicals->name = $request->technicalsName;
        $technicals->save();

        return redirect()->route('admin.technicals.index');
    }

    public function restore($id){
        $idsArr = explode(',', $id);
        technicals::withTrashed()->whereIn('id', $idsArr)->restore();
        return redirect()->route('admin.technicals.sortDeleteRecord');
    }

    public function delete($ids){
        $idsArr = explode(',',$ids);
        technicals::destroy($idsArr);
        return redirect()->route('admin.technicals.index');
    }
}
