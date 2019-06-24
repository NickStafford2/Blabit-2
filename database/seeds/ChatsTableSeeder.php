<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Chat;

class ChatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Chat::class)->create([  'user_id'       => 'admin',
                                        'title'         => 'Global Chat',
                                        'description'   => 'Free for all. Go wild',
                                        'video'         => 'OBrmgPVP-_8'            ]);

        $users = DB::table('users')->get();
        $userIDs = $users->pluck('id');

        $faker = Faker\Factory::create();

        $users = User::all();
        $numOfUsers = count($users);


        foreach ($users as $user) {
            $numberOfChats = rand(0,10) - 4;
            if ($numberOfChats < 0 ) {
                $numberOfChats = 0;
            }
            for ($i=0; $i < $numberOfChats; $i++) { 
                factory(Chat::class)->create(['user_id' => $user->id]);
            }
        }

    }
}
