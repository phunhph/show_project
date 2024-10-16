<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\domains;
use App\Models\images;
use App\Models\projects;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class projectsController extends Controller
{
    public function index(Request $request){
        $banners = images::where([['type',0],['is_active',0]])->get();
        $projects = projects::where('is_active',0)->get();
        $domainsAll =  domains::all();
        if ($request->has('technical')){
            $projects = projects::whereHas('technical',function($query){
                 $query->whereHas('technical',function($query){
                     $query->where('name','like','%'.request('technical').'%');
                 });
            })->get();
        }


        if ($request->has('domain')){
            $projects = projects::whereHas('domain',function($query){
                $query->whereHas('domain',function($query){
                    $query->orWhere('name','like','%'.Str::replace('-',' ',request('domain')).'%' );
                });
            })->get();
        }

        if ($request->has('member')){
            $projects = projects::where('added_by','like','%'.Str::replace('-',' ',request('member')).'%' )->get();
//            $projects = projects::whereHas('users',function($query){
//                $query->whereHas('users',function($query){
//                    $query->orWhere('name','like','%'.Str::replace('-',' ',request('member')).'%' );
//                });
//            })->get();
        }
        return view('clients.pages.projects',compact('banners','projects','domainsAll'));
    }


    public function search(Request $request){
        $banners = images::where([['type',0],['is_active',0]])->get();
        $projects = projects::query();
        if($request->nameSearch){
            $projects = $projects->where('name','like','%'.$request->nameSearch.'%');
        }
        $projects = $projects->where('is_active',0)->get();
        $domainsAll =  domains::all();
        return view('clients.pages.projects',compact('banners','projects','domainsAll'));
    }
}
