<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Profile;
use App\ProfileHistory;
use Carbon\Carbon;
use Storage;

class ProfileController extends Controller
{
    public function add()
    {
        return view('admin.profile.create');
    }
    
    
    public function create(Request $request)
  {
      
      $this->validate($request, Profile::$rules);
      
      $profile = new Profile;
      $profile_form = $request->all();
      
      if (isset($profile_form['image'])) {
          $path = Storage::disk('s3')->putFile('/',$profile_form['image'],'public');
          $profile->image_path = Storage::disk('s3')->url($path);
      } else {
          $profile->image_path = null;
      }
      
      //フォームから送信されてきた_tokenを削除する
      unset($profile_form['_token']);
      //フォームから送信されてきたimageを削除する
      unset($profile_form['image']);
      
      //データベースに保存する
      $profile->fill($profile_form);
      $profile->save();
      

        return redirect('admin/profile/create');
    }
    
    //larabel 15で追記
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            //検索されたら検索結果を取得する
            $posts = Profile::where('', $cond_title)->get();
        } else {
            //それ以外はすべてプロフィールを取得する
            $posts = Profile::all();
        }
        return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
        }

    public function edit(Request $request)
    {
        //profile modelからデータを取得する
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' => $profile]);
        }
        
        public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Profile::$rules);
      // Profile Modelからデータを取得する
      $profile = Profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $profile_form = $request->all();
      if ($request->remove == 'true') {
          $profile_form['image_path'] = null;
      } elseif ($request->file('image')) {
          $path = Storage::disk('s3')->putFile('/',$profile_form['image'],'public');
          $profile->image_path = Storage::disk('s3')->url($path);
      } else {
          $profile_form['image_path'] = $profile->image_path;
      }
      
      unset($profile_form['image']);
      unset($profile_form['remove']);
      unset($profile_form['_token']);

      // 該当するデータを上書きして保存する
      $profile->fill($profile_form)->save();
      
     $history = new ProfileHistory();
        $history->profile_id = $profile->id;
        $history->edited_at = Carbon::now();
        $history->save();
      
      return redirect('admin/profile/');
      
}

public function delete(Request $request)
  {
      // 該当するProfile Modelを取得
      $profile = Profile::find($request->id);
      // 削除する
      $profile->delete();
      return redirect('admin/profile/');
  }  
  
}