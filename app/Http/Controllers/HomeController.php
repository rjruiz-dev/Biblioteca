<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use App\User;
use App\Statu;
use DataTables;
use Carbon\Carbon;
use App\Providers\UserWasCreated;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveUserRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use lluminate\Http\RequestfilefileIlluminate\Http\UploadedFileSplFileInfo;
use Illuminate\Http\UploadedFile;

class HomeController extends Controller
{
    public function index()
    {
        return view('layouts.dashboard');
    }

    public function create()
    {
        $user = new User();      
                             
        return view('web.users.partials.form', [
            'genders'   => User::pluck('gender', 'gender'),
            'provinces' => User::pluck('province','province'),
            'status'    => Statu::pluck('state_description', 'id'),           
            'user'      => $user
        ]); 

    }
}
