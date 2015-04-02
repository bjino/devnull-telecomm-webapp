<?php

class PackageTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('packages')->delete();

        $package1 = Package::create(array(
            'name' => 'PackageAB',
            'cost' => 100,
            'active' => 1,
            'duration' => 365,
        ));

        $package2 = Package::create(array(
            'name' => 'PackageBC',
            'cost' => 200,
            'active' => 1,
            'duration' => 365,
        ));

        $serviceA = Service::where('name','=','ServiceA')->first();
        $serviceB = Service::where('name','=','ServiceB')->first();
        $serviceC = Service::where('name','=','ServiceC')->first();

        $package1->services()->attach($serviceA->id);
        $package1->services()->attach($serviceB->id);

        $package2->services()->attach($serviceB->id);
        $package2->services()->attach($serviceC->id);

    }

}
