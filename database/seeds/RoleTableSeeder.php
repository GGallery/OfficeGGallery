<?php

use Illuminate\Database\Seeder;
use App\Usergroups;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $user_role= new Usergroups();
        $user_role->name="User";
        $user_role->description="a normal user";
        $user_role->save();

        $admin_role= new Usergroups();
        $admin_role->name="Admin";
        $admin_role->description="Admin user";
        $admin_role->save();

        $author_role= new Usergroups();
        $author_role->name="Author";
        $author_role->description="Author user";
        $author_role->save();
    }
}
