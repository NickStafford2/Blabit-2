<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class SubscriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// subscribe everybody to admin
    	// find anybody not subscribed to admin 
    	$newUsers = DB::raw(   "SELECT DISTINCT id 
								FROM 			users
								WHERE			id <> admin
									AND 		id NOT IN (	SELECT 	subscriber_user_id
															FROM 	subscription 
															WHERE 	subscribee_user_id = admin)" );

    	foreach ($newUsers as $newUser) {
			User::find($newUser->id)->subscribeTo(User::find('admin'));
    	}


		// attempt to subscribe 10 random users to another random users
		// maybe less, this isn't exact
    	for ($i=0; $i < 10; $i++) { 
			$subscriberID = DB::table('users')->inRandomOrder()
											->select('id')
											->where('id', '<>', 'admin')
											->first();
			$subscribeeID = DB::table('users')->inRandomOrder()
											->select('id')
											->where('id', '<>', 'admin')
											->first();
			if ($subscriberID != $subscribeeID){
				$existingSub  = DB::table('subscription')->whereColumn([
																		[$subscriberID, '=' 'subscriber_user_id'],
																		[$subscribeeID, '=' 'subscribee_user_id']
																		])->get();
				if ($existingSub === null) {
			    	User::find($subscriberID)->subscribeTo(User::find($subscribeeID));
				}
			}
    	}
		/*
		foreach ($users as $user) {
	    	$num = rand(0,$numOfUsers) - 1;
	    	for ($i=0; $i < $num; $i++) { 
	    		try {
		    		$randUserId = $userIDs[rand(0,$numOfUsers)];
		    		User::find($subscriberID)->subscribeTo(User::find($subscribeeID));
	    			
	    		} 
	    		catch (Exception $e) {
	    			
	    		}

	    	}

		}
		// fill subscription table
		$users = DB::table('users')->get();
		$userIDs = $users->pluck('id');
		$numOfUsers = count($users);

		foreach ($users as $user) {
			User::find($user->id)->subscribeTo(User::find('admin'));
	    	$num = rand(0,$numOfUsers) - 1;
	    	for ($i=0; $i < $num; $i++) { 
	    		try {
		    		$randUserId = $userIDs[rand(0,$numOfUsers)];
	    			
	    		} 
	    		catch (Exception $e) {
	    			
	    		}

	    	}

		}

*/
    }
}
