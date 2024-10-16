<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\domains;
use App\Models\images;
use App\Models\level;
use App\Models\project_domains;
use App\Models\project_users;
use App\Models\projects;
use App\Models\technical_projects;
use App\Models\technicals;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

use ZipArchive;

class projectsController extends Controller
{
    public function index()
    {
        $projects = projects::with(['level' => function ($query) {
        $query->withTrashed();
    }])->paginate(10);
        $levels = level::all();
        $users = User::all();
        $technicals = technicals::all();
        $domains = domains::all();
        return view('admin.pages.projects.index', compact('projects','levels','users','technicals','domains'));
    }

    public function sortDelete(){
        $projects = projects::onlyTrashed()->with(['level' => function ($query) {
            $query->withTrashed();
        }])->paginate(10);
        return view('admin.pages.projects.sortDelete', compact('projects'));
    }

    public function search(Request $request)
    {
        $query = projects::query();

        // Áp dụng các điều kiện tìm kiếm dựa trên các tham số gửi từ form
        $nameProjectOld = "";
        if ($request->filled('nameProject')) {
            $nameProjectOld = $request->input('nameProject');
            $query->where('name', 'like', '%' . $nameProjectOld . '%');
        }

        $levelOld = "";
        if ($request->filled('level')) {
            $levelOld = $request->input('level');
            $query->where('level_id', $levelOld);
        }

        $authorOld = "";
        if ($request->filled('author')) {
            $authorOld = $request->input('author');
            $query->where('added_by', 'like', '%' . json_encode($authorOld) . '%');
        }

        $technicalOld = "";
        if ($request->filled('technical')) {
            $technicalOld = $request->input('technical');
            $query->orWhereHas('technical', function ($q) use ($technicalOld) {
                $q->whereIn('technicals_id', $technicalOld);
            });
        }


        $domainOld = "";
        if ($request->filled('domains')) {
            $domainOld = $request->input('domains');
            $query->whereHas('domain', function ($q) use ($domainOld) {
                $q ->orWhereIn('domains_id', $domainOld);
            });
        }

        $startDate = "";
        $endDate = "";
        if ($request->filled('startDate') && $request->filled('endDate')) {
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        // Thực hiện truy vấn và paginate kết quả
        $projects = $query->with(['level' => function ($query) {
            $query->withTrashed();
        }])->paginate(10);
        $levels = level::all();
        $users = User::all();
        $technicals = technicals::all();
        $domains = domains::all();
        return view('admin.pages.projects.index', compact('projects', 'startDate', 'endDate','levels','users','technicals','domains','nameProjectOld','levelOld','authorOld','technicalOld','domainOld'));
    }

    public function searchSortDelete(Request $request){
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
        $projects = projects::onlyTrashed()->with(['level' => function ($query) {
            $query->withTrashed();
        }])->whereBetween('created_at', [$startDate, $endDate])->paginate(10);

        return view('admin.pages.projects.sortDelete', compact('projects', 'startDate', 'endDate'));
    }

    public function create()
    {
        $levels = level::all();
        $technicals = technicals::all();
        $domains = domains::all();
        $users = User::all();
        return view('admin.pages.projects.create', compact('levels', 'technicals', 'domains', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameProject' => 'required',
            'description' => 'required',
            'linkDeloy' => 'required',
            'imageProjectAvatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'imagesDescription' => 'required',
            'level' => 'required',
            'technicalsUse' => 'required',
            'domains' => 'required',
            'members' => 'required'
        ], [
            'nameProject.required' => 'Không được để trống tên dự án',
            'description.required' => 'Không được để trống mô tả',
            'linkDeloy.required' => 'Không được để trống link triển khai',
            'imageProjectAvatar.required' => 'Không được để trống ảnh',
            'imageProjectAvatar.image' => 'Ảnh không đúng định dạng',
            'imageProjectAvatar.max' => 'Ảnh không quá 5MB',
            'imagesDescription.required' => 'Không được để trống ảnh mô tả',
            'imagesDescription.max' => 'Ảnh không quá 5MB',
            'level.required' => 'Không được để trống cấp độ',
            'technicalsUse.required' => 'Không được để trống kỹ thuật sử dụng',
            'domains.required' => 'Không được để trống lĩnh vực',
            'members.required' => 'Không được để trống thành viên'
        ]);
        $data = [];


        $idProjects = projects::create([
            'name' => $request->nameProject,
            'slug' => to_slug($request->nameProject),
            'description' => $request->description,
            'deploy_link' => $request->linkDeloy,
            'level_id' => $request->level,
            'added_by' =>  $request->members,
            'is_active' => 0,
            'views' => 0,
            'created_at' => Carbon::now()
        ])->id;

        foreach ($request->imagesDescription as $item) {
            $imagesFile = json_decode($item);
            $extension = pathinfo($imagesFile->name, PATHINFO_EXTENSION);   // .jpg .png .pdf

            $imageName = Str::random(10) . '.' . $extension;
            $data[2][] = [
                'image' => $imageName,
                'is_active' => 0,
                'type' => 2,
                'projects_id' => $idProjects
            ];
            Storage::disk('public')->put('description/' . $imageName, base64_decode($imagesFile->data));
        }

        $imageName = time() . '.' . $request->imageProjectAvatar->extension();
        $request->imageProjectAvatar->storeAs('public/images/projects/avatar/', $imageName);


//        foreach ($request->members as $item) {
//            $data[0][] = [
//                'projects_id' => $idProjects,
//                'author_id' => $item
//            ];
//        }


        foreach ($request->domains as $item) {
            $data[0][] = [
                'projects_id' => $idProjects,
                'domains_id' => $item
            ];
        }

        foreach ($request->technicalsUse as $item) {
            $data[1][] = [
                'projects_id' => $idProjects,
                'technicals_id' => $item
            ];
        }

        $data[2][] = [
            'image' => $imageName,
            'is_active' => 0,
            'type' => 1,
            'projects_id' => $idProjects
        ];
//        DB::table('project_users')->insert($data[0]);
        DB::table('project_domains')->insert($data[0]);
        DB::table('technical_projects')->insert($data[1]);
        DB::table('images')->insert($data[2]);
        return redirect()->route('admin.projects.index');
    }

    public function edit($id)
    {
        $levels = level::all();
        $technicals = technicals::all();
        $domains = domains::all();
        $users = User::all();
        $project = projects::withTrashed()->find($id);
        $images = images::where('projects_id', $id)->get();

        $imagesDes = $images->filter(function ($item) {
            return $item->type == 2;
        });
        $imagesDesOld = [];
        foreach ($imagesDes as $item) {
            $imagesDesOld[] = $item->id;
        }
        $imagesDesOld = implode(',', $imagesDesOld);
        $avatar = $images->filter(function ($item) {
            return $item->type == 1;
        })->first();
        $technicalUse = technical_projects::where('projects_id', $id)->get();
        $domainProjects = project_domains::where('projects_id', $id)->get();
//        $members = project_users::with('users')->whereIn('author_id', json_decode($project->added_by))->get();
        return view('admin.pages.projects.edit', compact('levels', 'technicals', 'domains', 'users', 'project', 'imagesDes', 'avatar', 'technicalUse', 'domainProjects','imagesDesOld'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nameProject' => 'required',
            'description' => 'required',
            'linkDeloy' => 'required',
            'imageProjectAvatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'level' => 'required',
            'technicalsUse' => 'required',
            'domains' => 'required',
            'members' => 'required'
        ], [
            'nameProject.required' => 'Không được để trống tên dự án',
            'description.required' => 'Không được để trống mô tả',
            'linkDeloy.required' => 'Không được để trống link triển khai',
            'imageProjectAvatar.required' => 'Không được để trống ảnh',
            'imageProjectAvatar.image' => 'Ảnh không đúng định dạng',
            'imageProjectAvatar.max' => 'Ảnh không quá 5MB',
            'imagesDescription.required' => 'Không được để trống ảnh mô tả',
            'imagesDescription.max' => 'Ảnh không quá 5MB',
            'level.required' => 'Không được để trống cấp độ',
            'technicalsUse.required' => 'Không được để trống kỹ thuật sử dụng',
            'domains.required' => 'Không được để trống lĩnh vực',
            'members.required' => 'Không được để trống thành viên'
        ]);

        $project = projects::withTrashed()->find($request->id);
        $project->name = $request->nameProject;
        $project->slug = to_slug($request->nameProject);
        $project->description = $request->description;
        $project->deploy_link = $request->linkDeloy;
        $project->level_id = $request->level;
        $project->added_by = $request->members;
        $project->updated_at = Carbon::now();
        $project->save();
        $images = images::where('projects_id', $request->id)->get();

        $avatar = $images->filter(function ($item) {
            return $item->type == 1;
        })->first();

        $imagesDes = $images->filter(function ($item) {
            return $item->type == 2;
        });
        $imagesDesOld = $imagesDes->map(function ($item) {
            return $item->id;
        })->toArray();
        $imageOld = $request->oldImagesDescription;
        $imageOld = explode(',', $imageOld);
        $imageOld = array_map('intval', $imageOld);
        $imagediff = array_diff($imagesDesOld,$imageOld);
        if(!empty($imagediff)) {
//            $image = images::whereIn('id', $imagediff)->get();
//            foreach ($image as $item) {
//                Storage::delete('public/description/' . $item->image);
//            }
//            $image->delete();
            Storage::delete(images::whereIn('id', $imagediff)->pluck('image')->map(function($imageName) {
                return 'public/description/' . $imageName;
            })->toArray());

// Xóa các hình ảnh từ cơ sở dữ liệu
            images::whereIn('id', $imagediff)->delete();
        }

        if ($request->hasFile('imageProjectAvatar')) {
            Storage::delete('public/images/projects/avatar/' . $avatar->image);
            $name = time() . '.' . $request->imageProjectAvatar->clientExtension();
            $request->imageProjectAvatar->storeAs('public/images/projects/avatar/', $name);
            $avatar->image = $name;
            $avatar->save();
        }

        if (!empty($request->imagesDescription)) {
//            foreach ($imagesDes as $item) {
//                Storage::delete('public/description/' . $item);
//                $item->delete();
//            }
            $data = [];
            foreach ($request->imagesDescription as $itemDes) {
                $imagesFile = json_decode($itemDes);
                $extension = pathinfo($imagesFile->name, PATHINFO_EXTENSION);   // .jpg .png .pdf
                $itemDesName = Str::random(10) . '.' . $extension;
                $data[] = [
                    'image' => $itemDesName,
                    'is_active' => 0,
                    'type' => 2,
                    'projects_id' => $request->id
                ];
                Storage::disk('public')->put('description/' . $itemDesName, base64_decode($imagesFile->data));
            }
            DB::table('images')->insert($data);

        }

//        if($project->added_by != json_encode($request->members)){
//            $project_users = project_users::where('projects_id', $request->id)->get();
//
//            $project_users->map(function ($item) {
//                $item->delete();
//            });
//            $data = [];
//            foreach ($request->members as $item) {
//                $data[] = [
//                    'projects_id' => $request->id,
//                    'author_id' => $item
//                ];
//            }
//
//            DB::table('project_users')->insert($data);
//
//        }

        $project_domains = project_domains::where('projects_id', $request->id)->get();
        $domaisProjects = $project_domains->map(function ($item){
            return $item['domains_id'];
        })->toArray();

        $domaisProjects = $this->array_equal($request->domains,$domaisProjects);
        if(!$domaisProjects){
            foreach ($project_domains as $item) {
                $item->delete();
            }
            $data = [];
            foreach ($request->domains as $item) {
                $data[] = [
                    'projects_id' => $request->id,
                    'domains_id' => $item
                ];
            }
            DB::table('project_domains')->insert($data);
        }
        $technical_projects = technical_projects::where('projects_id', $request->id)->get();
        $differencesTechnical = $technical_projects->map(function ($item){
            return $item['technicals_id'];
        })->toArray();
        $differencesTechnical = $this->array_equal($request->technicalsUse,$differencesTechnical);
        if(!$differencesTechnical){
            foreach ($technical_projects as $item) {
                $item->delete();
            }
            $data = [];
            foreach ($request->technicalsUse as $item) {
                $data[] = [
                    'projects_id' => $request->id,
                    'technicals_id' => $item
                ];
            }
            DB::table('technical_projects')->insert($data);
        }


//        $members = project_users::whereIn('author_id', json_decode($project->added_by))->get();
//        $memberDifferences = $members->map(function ($item){
//            return $item['author_id'];
//        })->toArray();
//
//        $memberDifferences = $this->array_equal($request->members,$memberDifferences);
//        if(!$memberDifferences){
//            foreach ($members as $item) {
//                $item->delete();
//            }
//            $data = [];
//            foreach ($request->members as $item) {
//                $data[] = [
//                    'projects_id' => $request->id,
//                    'author_id' => $item
//                ];
//            }
//            DB::table('project_users')->insert($data);
//        }

        return redirect()->route('admin.projects.index');
    }

    public function delete($ids)
    {
        $idsArr = explode(',', $ids);
        projects::whereIn('id', $idsArr)->update(['is_active' => 1]);
        projects::destroy($idsArr);
        return redirect()->route('admin.projects.index');
    }

    public function restore($ids)
    {
        $idsArr = explode(',', $ids);
        projects::withTrashed()->whereIn('id', $idsArr)->update(['is_active' => 0]);
        projects::withTrashed()->whereIn('id', $idsArr)->restore();
        return redirect()->route('admin.projects.sortDeleteRecord');
    }

    public function deployFrom(Request $request) {
        $projects = projects::with(['level' => function ($query) {
            $query->withTrashed();
        }])->paginate(10);
            $levels = level::all();
            $users = User::all();
            $technicals = technicals::all();
            $domains = domains::all();
            return view('admin.pages.projects.deploy', compact('projects','levels','users','technicals','domains'));
    }
    public function deploy(Request $request)
{
    // Xác thực dữ liệu đầu vào
    $request->validate([
        'project' => 'required|file|mimes:zip',
        'data' => 'required|file|mimes:json',
    ]);

    // Tạo tên dự án
    $projectName = 'project_' . time();
    $projectPath = storage_path("app/deployed/{$projectName}");

    // Tạo thư mục cho dự án nếu chưa tồn tại
    if (!is_dir($projectPath)) {
        mkdir($projectPath, 0755, true);
    }

    // Lưu file ZIP
    // Lưu file ZIP
    // Ghi log đường dẫn lưu tệp ZIP
    
$zipFile = $request->file('project');
$zipPath = $zipFile->storeAs('deployed', $zipFile->getClientOriginalName());



    // Kiểm tra xem đường dẫn có hợp lệ không
    if (empty($zipPath)) {
        return response()->json(['message' => 'Đường dẫn tệp ZIP không hợp lệ.'], 400);
    }

    // Giải nén file ZIP
    $zip = new ZipArchive;
    $zipFilePath = storage_path("app/{$zipPath}"); // Đường dẫn đầy đủ đến tệp ZIP
    if ($zip->open($zipFilePath) === TRUE) {
        $zip->extractTo($projectPath);
        $zip->close();
    } else {
        return response()->json(['message' => 'Không thể giải nén file ZIP.'], 400);
    }

    // Cài đặt các thư viện nếu có composer.json
    if (file_exists("{$projectPath}/composer.json")) {
        exec("cd {$projectPath} && composer install");
    }

    // Lưu file JSON
    $jsonFile = $request->file('data');
    // $jsonPath = $jsonFile->storeAs('uploads', $jsonFile->getClientOriginalName());

    // Kiểm tra xem đường dẫn JSON có hợp lệ không
    if (empty($jsonPath)) {
        return response()->json(['message' => 'Đường dẫn tệp JSON không hợp lệ.'], 400);
    }

    // Đọc dữ liệu từ file JSON
    $data = json_decode(file_get_contents(storage_path("app/{$jsonPath}")), true);
    
    if ($data === null) {
        return response()->json(['message' => 'Không thể đọc dữ liệu từ tệp JSON.'], 400);
    }

    // Tạo database (bỏ comment nếu cần)
    // $dbName = 'database_' . str_replace(' ', '_', $projectName);
    // DB::statement("CREATE DATABASE {$dbName}");

    // config(['database.connections.mysql.database' => $dbName]);
    // DB::purge('mysql');
    // DB::reconnect('mysql');

    // Artisan::call('migrate');

    // foreach ($data as $item) {
    //     User::create($item);
    // }

    return response()->json(['message' => 'Triển khai dự án thành công!', 'project_name' => $projectName]);
}



    function array_equal($a, $b) {
        return (
            is_array($a)
            && is_array($b)
            && count($a) == count($b)
            && array_diff($a, $b) === array_diff($b, $a)
        );
    }
}
