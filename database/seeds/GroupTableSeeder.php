<?php

use Illuminate\Database\Seeder;
use \App\Usergroups;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {


//        $group= new Usergroups();
//        $group->name="Users";
//        $group->description="Gruppo Utenti";
//        $group->save();

//        $group= new Usergroups();
//        $group->name="Admin";
//        $group->description="Gruppo Amminsitratori";
//        $group->save();
//
//        $group= new Usergroups();
//        $group->name="Leader";
//        $group->description="Gruppo Leader";
//        $group->save();




        $group= new Usergroups();
        $group->name="Francesca";
        $group->description="Gruppo Operativo";
        $group->parent = 3;
        $group->save();

        $group= new Usergroups();
        $group->name="Luciana";
        $group->description="Gruppo Logistico";
        $group->parent = 3;
        $group->save();

        $group= new Usergroups();
        $group->name="Alessia";
        $group->description="Gruppo Marketing";
        $group->parent = 3;
        $group->save();

        $group= new Usergroups();
        $group->name="Silvia";
        $group->description="Gruppo ECM";
        $group->parent = 3;
        $group->save();


    }
}
