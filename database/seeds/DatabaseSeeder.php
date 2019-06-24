<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            CustomContentSeeder::class,
            UsersTableSeeder::class,
            ChatsTableSeeder::class,
            BlabsTableSeeder::class,
            SubscriptionTableSeeder::class

        ]);
    }

}
