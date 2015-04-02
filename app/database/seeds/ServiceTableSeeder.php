<?php

class ServiceTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('services')->delete();

        $service1 = Service::create(array(
            'name' => 'ServiceA',
            'cost' => 100,
            'active' => 1,
            'duration' => 365,
        ));

        $service2 = Service::create(array(
            'name' => 'ServiceB',
            'cost' => 200,
            'active' => 1,
            'duration' => 365,
        ));

        $service3 = Service::create(array(
            'name' => 'ServiceC',
            'cost' => 300,
            'active' => 1,
            'duration' => 365,
        ));

        $service1->save();
        $service2->save();
        $service3->save();
    }

}
