<?php

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $userIds=['1','2','3'];
        $faker=app(Faker\Generator::class);
        /*$statuses = factory(Status::class)->times(100)->make()->each(function ($status) use ($faker, $user_ids) {
            $status->user_id = $faker->randomElement($user_ids);
        });*/

        $statuses=factory(Status::class)->times(100)->make();
        foreach ($statuses as $status){
            $status->user_id=$faker->randomElement($userIds);
        }
        Status::insert($statuses->toArray());

    }
}
