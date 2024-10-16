<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\images;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;
class AdminBannerController extends Controller
{
    public function index(){
        $allBanner = images::where('type',0)->paginate(10);
        return view('admin.pages.banner.index',compact('allBanner'));
    }

    public function search(Request $request){
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $request->validate([
            'startDate' => 'required|before:endDate',
            'endDate' => 'required|after:startDate'
        ], [
            'startDate.required' => 'Không được để trống ngày bắt đầu',
            'startDate.before' => 'Ngày bắt đầu phải trước ngày kết thúc',
            'endDate.required' => 'Không được để trống ngày kết thúc',
            'endDate.after' => 'Ngày kết thúc phải sau ngày bắt đầu'
        ]);
        $allBanner = images::whereBetween('created_at', [$startDate, $endDate])->paginate(10);
        return view('admin.pages.banner.index',compact('allBanner','startDate','endDate'));
    }

    public function create(){
        return view('admin.pages.banner.create');
    }

    public function store(Request $request){
        $request->validate([
            'is_active' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ],[
            'is_active.required' => 'Không được để trống trạng thái hiển thị',
            'image.required' => 'Không được để trống hình ảnh',
            'image.image' => 'Hình ảnh không đúng định dạng',
            'image.mimes' => 'Hình ảnh không đúng định dạng',
            'image.max' => 'Hình ảnh không được lớn hơn 5MB',
        ]);

        $name = time().'.'.$request->image->clientExtension();
        $request->image->storeAs('public/images/banner',$name);
        images::create([
            'is_active' => $request->is_active,
            'image' => $name,
            'type' => '0'
        ]);

        return redirect()->route('admin.banner.index');
    }

    public function edit($id){
        $banner = images::find($id);
        return view('admin.pages.banner.edit',compact('banner'));
    }

    public function update(Request $request){
        $request->validate([
            'is_active' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:5120',
        ],[
            'is_active.required' => 'Không được để trống trạng thái hiển thị',
            'image.image' => 'Hình ảnh không đúng định dạng',
            'image.mimes' => 'Hình ảnh không đúng định dạng',
            'image.max' => 'Hình ảnh không được lớn hơn 5MB',
        ]);

        $banner = images::find($request->id);
        if($request->hasFile('image')){
            Storage::delete('public/images/banner/'.$banner->image);
            $name = time().'.'.$request->image->clientExtension();
            $request->image->storeAs('public/images/banner/',$name);
            $banner->image = $name;
        }
        $banner->is_active = $request->is_active;
        $banner->save();

        return redirect()->route('admin.banner.index');
    }

    public function delete($ids){
        $idsArr = explode(',',$ids);

        // Tìm và lấy danh sách banner cần xóa
        $bannersToDelete = images::whereIn('id', $idsArr)->get();

        // Lặp qua danh sách banner để xóa hình ảnh từ bộ nhớ lưu trữ
        foreach ($bannersToDelete as $banner) {
            Storage::delete('public/images/banner/' . $banner->image);
        }

        // Xóa các banner có id trong mảng $ids
        images::destroy($idsArr);
        return redirect()->route('admin.banner.index');
    }
}
