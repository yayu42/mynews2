 {{-- layouts/profle.blade.phpを読み込む --}}
       @extends('layouts.profile')
       
       {{--profile.blade.phpの@yield('title)に'Myプロフィール'を埋め込む --}}
       @section('title','Myプロフィール')
       
       {{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}
       @section('content')
         <div class="container">
             <div class="row">
                 <div class="col-md-8 mx-auto">
                  <h2>Myプロフィール</h2>
                  <form action="{{ action('Admin\ProfileController@create') }}" method="post" enctype="multipart/form-data">
                     
                     @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">氏　名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                     <form_method="post" action="receive.php">
                      
                        <label class="col-md-2">性　別</label>
                        <div class="col-md-10">
                         <select name="gender">
                          <option hidden>選択してください</option>
                          <option value="1">男性</option>
                          <option value="2">女性</option>
                          <option value="3">どちらでもない</option>
                          </select>
                           </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">趣　味</label>
                        <div class="col-md-10">
                         <textarea class="form-control" name="body" rows="5">{{ old('body') }}</textarea>
                          </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">自己紹介欄</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="20">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection
               
