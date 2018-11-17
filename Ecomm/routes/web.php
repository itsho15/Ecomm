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


		Route::get('lang/{lang}', function ($lang) {
				session()->has('lang') ? session()->forget('lang') :'';
				$lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
				return back();
		});
