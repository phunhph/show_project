<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class OurTeamController extends Controller
{
    public function index(){
        $allUser = User::paginate(9);
        return view('clients.pages.ourTeam',compact('allUser'));
    }

    public function single($id){
        $member = User::find($id);
        return view('clients.pages.teamSingle',compact('member'));
    }
}
