<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    //2022.3.21 追記
    public function add()
    {
        return view('admin.mypage.create');
    }
    
    public function create()
    {
        return redirect('admin/mypage/create');
    }
    
    public function edit()
    {
        return view('admin.mypage.edit');
    }
    
    public function update()
    {
        return redirect('admin/mypage/edit');
    }
}
