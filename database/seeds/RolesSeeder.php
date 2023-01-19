<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data=array(
            array('id'=>Str::uuid(),'roles'=>'admin'),
            array('id'=>Str::uuid(),'roles'=>'user'),
            array('id'=>Str::uuid(),'roles'=>'support_team'),
            array('id'=>Str::uuid(),'roles'=>'shipping_team'),
            array('id'=>Str::uuid(),'roles'=>'store_manager'));

        DB::table('roles')->insert($data);
    }
}
