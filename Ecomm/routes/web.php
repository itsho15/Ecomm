<?php
Route::group(['middleware' => 'Maintenance'], function () {

		Route::get('/', function () {
				return view('style.home');
			});
	});

Route::get('maintenance', function () {

		if (setting()->status == 'open') {
			return redirect('/');
		}

		return view('style.maintenance');
	});


Route::get('/make',function(){
   return App\Admin::create(['name'=>'admin','password'=>bcrypt(123456),'email'=>'admin@admin.com']);
});