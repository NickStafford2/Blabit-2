<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class CustomContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// only run if the database is empty.
    	// possibly check if database is full and throw exception here
    	
    	factory(User::class)->create([	'id'		=>	'admin',
    									'name' 		=> 	'The Watcher',
    									'email' 	=>  'admin@blabbit.com',
    									'img_link' 	=> 	'NlZBaNyTKMSJ4k0RpYMonoSXpksKhlKsNDmU3mp5.png']);

    	factory(User::class)->create([	'id'		=>	'Burnie',
    									'name' 		=> 	'Burnie Burns',
    									'email' 	=>  'burnie@burnie.com',
    									'video' 	=>	'dkpW3NsxzZA']);

    	factory(User::class)->create([	'id'		=>	'Sargon',
    									'name' 		=> 	'Sargon of Akkad',
    									'email' 	=>  'sargon@sargon.com',
    									'img_link' 	=> 	'TsVq3CK03LgKj2Vl3jtULQCISPYJOz2yJXaSa1XF.jpeg',
    									'video' 	=>	'7s0sGPtokfY']);

    	factory(User::class)->create([	'id'		=>	'Vee',
    									'name' 		=> 	'Vee',
    									'email' 	=>  'vee@vee.com',
    									'video' 	=>	'-BTIT1pHhgo',
    									'img_link' 	=> 	'Sj1WkffKqGE6FUFDH1RcCUXTQ6AV1CLZslzSp2mh.jpeg']);

    	factory(User::class)->create([	'id'		=>	'realDonaldTrump',
    									'name' 		=> 	'Donald Trump',
    									'email' 	=>  'donald@trump.com',
    									'video' 	=>	'MKH6PAoUuD0']);

		User::find('admin')				->subscribeTo(User::find('Burnie'));
		User::find('admin')				->subscribeTo(User::find('Sargon'));
		User::find('admin')				->subscribeTo(User::find('Vee'));
		User::find('admin')				->subscribeTo(User::find('realDonaldTrump'));

		User::find('realDonaldTrump')	->subscribeTo(User::find('Burnie'));
		User::find('realDonaldTrump')	->subscribeTo(User::find('Sargon'));
		User::find('realDonaldTrump')	->subscribeTo(User::find('Vee'));

		User::find('Burnie')			->subscribeTo(User::find('realDonaldTrump'));
		User::find('Burnie')			->subscribeTo(User::find('Sargon'));
		User::find('Burnie')			->subscribeTo(User::find('Vee'));

		User::find('Sargon')			->subscribeTo(User::find('realDonaldTrump'));
		User::find('Sargon')			->subscribeTo(User::find('Burnie'));
		User::find('Sargon')			->subscribeTo(User::find('Vee'));

		User::find('Vee')				->subscribeTo(User::find('realDonaldTrump'));
		User::find('Vee')				->subscribeTo(User::find('Burnie'));
		User::find('Vee')				->subscribeTo(User::find('Sargon'));

    }
}
