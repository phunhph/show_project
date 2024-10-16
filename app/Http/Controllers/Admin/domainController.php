<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\domains;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class domainController extends Controller
{
    public function index(){
        $allDomain = domains::paginate(10);
        return view('admin.pages.domain.index',compact('allDomain'));
    }

    public function sortDelete(){
        $allDomain = domains::onlyTrashed()->paginate(10);
        return view('admin.pages.domain.sortDelete',compact('allDomain'));
    }

    public function search(Request $request){
        $nameValue = $request->input('nameValue');
        $request->validate([
            'nameValue' => 'required',
        ], [
            'nameValue.required' => 'Không được để trống ngày bắt đầu'
        ]);
        $allDomain = domains::where('name','like', '%' . $nameValue . '%')->paginate(10);
        return view('admin.pages.domain.index',compact('allDomain','nameValue'));
    }

    public function searchSortDelete(Request $request){
        $nameValue = $request->input('nameValue');
        $request->validate([
            'nameValue' => 'required',
        ], [
            'nameValue.required' => 'Không được để trống ngày bắt đầu'
        ]);
        $allDomain = domains::onlyTrashed()->where('name','like', '%' . $nameValue . '%')->paginate(10);
        return view('admin.pages.domain.sortDelete',compact('allDomain','nameValue'));
    }

    public function create(){
        return view('admin.pages.domain.create');
    }

    public function store(Request $request){
        $request->validate([
            'is_active' => 'required',
            'nameDomain' => 'required|unique:domains,name',
        ],[
            'is_active.required' => 'Không được để trống trạng thái hiển thị',
            'nameDomain.required' => 'Không được để trống têm lĩnh vực',
            'nameDomain.unique' => 'Tên lĩnh vực đã tồn tại'
        ]);

        domains::create([
            'is_active' => $request->is_active,
            'name' => $request->nameDomain
        ]);

        return redirect()->route('admin.domain.index');
    }

    public function edit($id){
        $domain = domains::withTrashed()->find($id);
        return view('admin.pages.domain.edit',compact('domain'));
    }

    public function update(Request $request){
        $request->validate([
            'is_active' => 'required',
            'nameDomain' => 'required',
        ],[
            'is_active.required' => 'Không được để trống trạng thái hiển thị',
            'nameDomain.required' => 'Không để trống tên lĩnh vực'
        ]);

        $domain = domains::withTrashed()->find($request->id);

        $domain->is_active = $request->is_active;
        $domain->name = $request->nameDomain;
        $domain->save();

        return redirect()->route('admin.domain.index');
    }

    public function restore($id){
        $idsArr = explode(',', $id);
        domains::withTrashed()->whereIn('id', $idsArr)->restore();
        return redirect()->route('admin.domain.sortDeleteRecord');
    }

    public function delete($ids){
        $idsArr = explode(',',$ids);
        domains::destroy($idsArr);
        return redirect()->route('admin.domain.index');
    }
}
