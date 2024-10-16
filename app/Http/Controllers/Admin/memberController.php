<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class memberController extends Controller
{
    public function index(){
        $members = User::paginate(10);
        return view('admin.pages.members.index',compact('members'));
    }

    public function sortDelete(){
        $members = User::onlyTrashed()->paginate(10);
        return view('admin.pages.members.sortDelete',compact('members'));
    }

    public function search(Request $request){
        $nameValue = $request->input('nameValue');
        $request->validate([
            'nameValue' => 'required',
        ], [
            'nameValue.required' => 'Không được để trống ngày bắt đầu'
        ]);
        $members = User::where('name','like', '%' . $nameValue . '%')->paginate(10);
        return view('admin.pages.members.index',compact('members','nameValue'));
    }

    public function searchSortDelete(Request $request){
        $nameValue = $request->input('nameValue');
        $request->validate([
            'nameValue' => 'required',
        ], [
            'nameValue.required' => 'Không được để trống ngày bắt đầu'
        ]);
        $members = User::onlyTrashed()->where('name','like', '%' . $nameValue . '%')->paginate(10);
        return view('admin.pages.members.sortDelete',compact('members','nameValue'));
    }

    public function create(){
        return view('admin.pages.members.create');
    }

    public function store(Request $request){
        $request->validate([
            'nameMember' => 'required|unique:users,name',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'password'=>'required|min:6',
            're_pass' => 'required|same:password',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'description' => 'required'
        ],[
            'nameMember.required' => 'Không được để trống tên thành viên',
            'nameMember.unique' => 'Tên thành viên đã tồn tại',
            'avatar.required' => 'Không được để trống ảnh đại diện',
            'avatar.image' => 'Ảnh đại diện phải là ảnh',
            'avatar.mimes' => 'Ảnh đại diện phải có định dạng jpeg,png,jpg,gif,svg',
            'avatar.max' => 'Ảnh đại diện không được vượt quá 5MB',
            'password.required' => 'Không được để trống mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            're_pass.required' => 'Không được để trống nhập lại mật khẩu',
            're_pass.same' => 'Mật khẩu nhập lại không khớp',
            'email.required' => 'Không được để trống email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'role.required' => 'Không được để trống vai trò',
            'description.required' => 'Không được để trống mô tả'
        ]);
        $name = time().'.'.$request->avatar->clientExtension();
        $request->avatar->storeAs('public/images/member/avatar/',$name);
        User::create([
            'name' => $request->nameMember,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'avatar' => $name,
            'created_at' => now(),
            'describe' => $request->description
        ]);

        return redirect()->route('admin.members.index');
    }

    public function edit($id){
        $member = User::withTrashed()->find($id);

        return view('admin.pages.members.edit',compact('member'));
    }

    public function update(Request $request){
        $request->validate([
            'nameMember' => 'required',
            're_pass' => 'same:password',
            'email' => 'required|email',
            'description' => 'required',
        ],[
            'nameMember.required' => 'Không được để trống tên thành viên',
            'nameMember.unique' => 'Tên thành viên đã tồn tại',
            'avatar.required' => 'Không được để trống ảnh đại diện',
            'avatar.image' => 'Ảnh đại diện phải là ảnh',
            'avatar.mimes' => 'Ảnh đại diện phải có định dạng jpeg,png,jpg,gif,svg',
            'avatar.max' => 'Ảnh đại diện không được vượt quá 5MB',
            'password.required' => 'Không được để trống mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            're_pass.required' => 'Không được để trống nhập lại mật khẩu',
            're_pass.same' => 'Mật khẩu nhập lại không khớp',
            'email.required' => 'Không được để trống email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'role.required' => 'Không được để trống vai trò',
            'description.required' => 'Không được để trống mô tả'
        ]);
        $user = User::withTrashed()->find($request->id);
        $user->name = $request->nameMember;
        $user->email = $request->email;
        $user->describe = $request->description;
        if($request->password != null){
            $user->password = bcrypt($request->password);
        }
        $user->role = $request->role;
        if($request->hasFile('avatar')){

            Storage::delete('public/images/member/avatar/'.$user->avatar);
            $name = time().'.'.$request->avatar->clientExtension();
            $request->avatar->storeAs('public/images/member/avatar/',$name);
            $user->avatar = $name;
        }
        $user->updated_at = now();
        $user->save();
        return redirect()->back();
    }

    public function restore($id){
        $idsArr = explode(',', $id);
        User::withTrashed()->whereIn('id', $idsArr)->restore();
        return redirect()->route('admin.members.sortDeleteRecord');
    }

    public function delete($ids){
        $idsArr = explode(',',$ids);
        User::destroy($idsArr);
        return redirect()->route('admin.members.index');
    }
}
