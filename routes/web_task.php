<?php

Route::group(['prefix' => 'xxx'],function(){
    Route::get('xxx','AAAController@bbb');
});

//「http://XXXXXX.jp/XXX というアクセスが来たときに、 AAAControllerのbbbというAction に渡すRoutingの設定」を書いてみてください