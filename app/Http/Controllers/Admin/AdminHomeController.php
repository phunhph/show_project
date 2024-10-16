<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\projects;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminHomeController extends Controller
{
    public function index(){

        $totalProjects = projects::count();

        $firstDayOfMonth = Carbon::now()->startOfMonth()->toDateTimeString();
        $lastDayOfMonth = Carbon::now()->endOfMonth()->toDateTimeString();

// Lấy ngày đầu tiên và cuối cùng của tháng trước
        $firstDayOfLastMonth = Carbon::now()->subMonth()->startOfMonth()->toDateTimeString();
        $lastDayOfLastMonth = Carbon::now()->subMonth()->endOfMonth()->toDateTimeString();
// Số lượng dự án trong tháng hiện tại và trong tháng trước
        $projectsThisMonth = projects::whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])->count();
        $projectsLastMonth = projects::whereBetween('created_at', [$firstDayOfLastMonth, $lastDayOfLastMonth])->count();

// Tính toán phần trăm tăng/giảm
        if ($projectsLastMonth == 0) {
            $percentageChange = ($projectsThisMonth > 0) ? 100 : 0; // Nếu không có dự án tháng trước, chỉ tính phần trăm tăng nếu có dự án tháng này
        } else {
            $percentageChange = (($projectsThisMonth - $projectsLastMonth) / $projectsLastMonth) * 100;
        }

// Thống kê số lượng dự án trong mỗi lĩnh vực
        $projectsPerDomain = projects::select('domains.name as domain_name', \DB::raw('count(*) as project_count'))
            ->join('project_domains', 'projects.id', '=', 'project_domains.projects_id')
            ->join('domains', 'project_domains.domains_id', '=', 'domains.id')
            ->groupBy('domains.name')
            ->get();


        return view('admin.pages.home',compact('totalProjects','projectsPerDomain','percentageChange'));
    }
}
