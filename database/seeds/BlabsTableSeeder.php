<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Chat;
use App\Blab;

class BlabsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = DB::table('users')->get();
        $userIDs = $users->pluck('id');

        $chats = DB::table('chats')->get();
        $chatIDs = $chats->pluck('id');

        $faker = Faker\Factory::create();

        $users = User::all();
        $numOfUsers = count($users);

        $chats = Chat::all();
        $numOfChats = count($chats);


        foreach ($chats as $chat) {
            $numberOfBlabs = rand(0,20);

            for ($i=0; $i < $numberOfBlabs; $i++) { 
                $user = User::inRandomOrder()->first(); //all()->random(1);
                //$userIndex = rand(0,$numOfUsers);
                //$user = $users[$userIndex];
                $id = $user->id;
                factory(Blab::class)->create([  'user_id' => $user->id,
                                                'chat_id' => $chat->id ]);
            }
        }

    }
}
