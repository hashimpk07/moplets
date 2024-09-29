<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		DB::table('executives')->insert([
			'name' => 'Admin',
			'username' => 'admin',
			'password' => '$2y$10$3vXau.zMWIMArd75mbHvPOTnZJ1cI04Kz0yCc90rfvN1had3lBOXG' ,
		]);
		//Brand
		DB::table('settings')->insert([
			'code' => 'BRAND_NAME',
			'name' => 'Brand Name',
			'value' => 'Qudratom R & D',
			'is_autoload' => 1 ,
		]
		);

		DB::table('settings')->insert([
			'code' => 'BRAND_IMAGE',
			'name' => 'Brand Image',
			'value' => 'logo.png',
			'is_autoload' => 1 ,
		]
		);

		DB::table('settings')->insert([
				'code' => 'BRAND_COLOR',
				'name' => 'Brand Color',
				'value' => '#FFBC00',
				'is_autoload' => 1 ,
			]
		);
		//--
		//Module --
		DB::table('settings')->insert([
				'code' => 'MODULE_REGION',
				'name' => 'Region Module',
				'value' => '1',
				'is_autoload' =>1 ,
			]
		);
		DB::table('settings')->insert([
				'code' => 'MODULE_BRANCH',
				'name' => 'Branch Module',
				'value' => '1',
				'is_autoload' =>1 ,
			]
		);
		DB::table('settings')->insert([
				'code' => 'MODULE_EMPLOYEE',
				'name' => 'Employee Module',
				'value' => '1',
				'is_autoload' =>1 ,
			]
		);
		//--

		DB::table('settings')->insert([
			'code' => 'API_KEY',
			'name' => 'API Key',
			'value' => '',
			'is_autoload' => 1 ,
		]
		);

		DB::table('settings')->insert([
			'code' => 'IVR_API_KEY',
			'name' => 'IVR Key',
			'value' => '',
			'is_autoload' =>1 ,
		]
		);
		DB::table('settings')->insert([
			'code' => 'IVR_URL_FORMAT',
			'name' => 'IVR URL Format',
			'value' => '',
			'is_autoload' =>1 ,
		]
		);

		DB::table('settings')->insert([
			'code' => 'DTMF_CHARACTER_POSITION',
			'name' => 'DTMF Character Position',
			'value' => '3',
			'is_autoload' =>1 ,
		]
		);
		DB::table('settings')->insert([
			'code' => 'DTMF_SUCCESS_CHARACTER',
			'name' => 'Success character',
			'value' => '',
			'is_autoload' =>1 ,
		]
		);

		DB::table('settings')->insert([
			'code' => 'IVR_DELAY',
			'name' => 'Delay',
			'value' => '',
			'is_autoload' =>'1' ,
		]
		);

		DB::table('settings')->insert([
			'code' => 'START_TIME',
			'name' => 'Start Time',
			'value' => '12:00',
			'is_autoload' =>'1' ,
		]
		);

		DB::table('settings')->insert([
			'code' => 'END_TIME',
			'name' => 'END Time',
			'value' => '23:59',
			'is_autoload' =>'1' ,
		]
		);
		DB::table('settings')->insert([
			'code' => 'PROCESS_PAST_CALLS',
			'name' => 'Process Past Calls',
			'value' => '1',
			'is_autoload' =>'1' ,
		]
		);

	}

}
