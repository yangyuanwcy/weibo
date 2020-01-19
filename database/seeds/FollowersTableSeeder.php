<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users=User::all();
        $user=$users->first();
        $user_id=$user->id;

        //获取除去ID为$user_id以外的所有用户的ID数组
        $followers=$users->slice($user_id);
        $follower_ids=$followers->pluck('id')->toArray();

        //关注除了ID为$user_id以外的所有用户
        $user->follow($follower_ids);

        //除了ID为$user_id以外的所有用户都关注ID为$user_id的用户
        foreach ($followers as $follower){
            $follower->follow($user_id);
        }
    }
}
