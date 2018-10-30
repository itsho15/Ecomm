<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Model\Setting;
class CreateSettingsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('settings', function (Blueprint $table) {
				$table->increments('id');
				$table->string('sitename_ar')->nullable();
				$table->string('sitename_en')->nullable();
				$table->string('logo')->nullable();
				$table->string('icon')->nullable();
				$table->string('email')->nullable();
				$table->string('main_lang')->default('ar');
				$table->longtext('description')->nullable();
				$table->longtext('keywords')->nullable();
				$table->enum('status', ['open', 'close'])->default('open');
				$table->longtext('message_maintenance')->nullable();
				$table->timestamps();
			});
		// Insert some stuff
	    Setting::firstOrCreate(
	        array(
	            'main_lang' => 'ar',
	        )
	    );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('settings');
	}
}
