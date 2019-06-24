<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        // generate 10 users
		for ($i=0; $i < 10; $i++) {
	    	// ensure that all the id's are unique
			$j = 0;
			while (j<1000) {
				$randID = $faker->unique()->word;
				$user = User::where('id', '=', $randID)->first();
				if ($user === null) {
   					// user with that id doesn't exist
					factory(App\User::class)->create(['id' => $randID]);
					break;
				}
			}
		}
    }
}
