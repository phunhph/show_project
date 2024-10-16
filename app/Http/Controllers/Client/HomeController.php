<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\domains;
use App\Models\images;
use App\Models\projects;
use App\Models\technicals;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = images::where([['type',0],['is_active',0]])->get();
        $projects = projects::where('is_active',0)->get();
        return view('clients.pages.home',compact('banners','projects'));
    }

    public function single($slug){
        $project = projects::where([['is_active',0],['slug',$slug]])->first();
        $images = images::where([['projects_id',$project->id],['is_active',0]])->get();
        $avatar = $images->filter(function($image){
            return $image->type == 1;
        })->first();
        $desribe= $images->filter(function($image){
            return $image->type == 2;
        });

        $project->increment('views');
        $project->save();
//        $members = json_decode($project->added_by);
//        $members = User::whereIn('id',$members)->get();
        $domainsAll =  domains::all();
        $technicals = technicals::all();
        return view('clients.pages.single',compact('project','avatar','domainsAll','technicals','desribe'));
    }
}
