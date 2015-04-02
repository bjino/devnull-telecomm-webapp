<?php

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        DB::table('customer')->delete();
        DB::table('retail')->delete();

        $uf = new UserFactory();

        $userdata = array(
            'factoryType' => 'retail',
            'firstname'     => 'Stanley',
            'lastname' => 'Y',
            'email'    => 'yipsy@yipsy.com',
            'address'  => '12345 Yipsy Drive',
            'city'     => 'Yipsy',
            'state'    => 'CA',
            'phone'    => '1234567',
            'password' => 'yipsy',
        );

        $uf->populate($userdata);

        $userdata = array(
            'factoryType' => 'commercial',
            'firstname'     => 'Ali',
            'lastname' => 'Arsanjani',
            'email'    => 'aa@ibm.com',
            'address'  => '12345 IBM Drive',
            'city'     => 'IBM',
            'state'    => 'CA',
            'phone'    => '1234567',
            'password' => 'ibm',
            'companyName' => 'IBM',
            'businessUnitName' => 'idk',
            'division'    => 'idk',
        );

        $uf->populate($userdata);
    }

}
