<?php

class SetUpSeeder extends Seeder
{
    public function run()
    {
        DB::table('commercial')->delete();
        DB::table('retail')->delete();
        DB::table('customer')->delete();
        DB::table('marketing_rep')->delete();
        DB::table('service_rep')->delete();
        DB::table('users')->delete();

        $uf = new UserFactory();
        $userdata = array(
            'factoryType' => 'service_rep',
            'firstname' => 'Service',
            'lastname' => 'Rep',
            'email' => 'customerServiceRep@devnull.com',
            'address' => ' ',
            'city' => ' ',
            'state' => 'CA',
            'phone' => '6191234567',
            'password' => 'asdf',
        );
        $uf->populate($userdata);

        $userdata = array(
            'factoryType' => 'marketing_rep',
            'firstname' => 'Marketing',
            'lastname' => 'Rep',
            'email' => 'marketingRep@devnull.com',
            'address' => ' ',
            'city' => ' ',
            'state' => 'CA',
            'phone' => '6191234567',
            'password' => 'asdf',
        );

        $uf->populate($userdata);

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
    }

}
