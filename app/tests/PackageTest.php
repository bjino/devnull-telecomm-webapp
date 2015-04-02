<?php

class PackageTest extends TestCase {

    public function testPackage() {
        $package = Package::where('name','=','PackageAB')->first();
        $services = $package->getServices();
        $this->assertNotEmpty($services);

        $this->assertTrue($package->containsService(Service::where('name','=','ServiceA')->first()->id));
        $this->assertTrue($package->containsService(Service::where('name','=','ServiceB')->first()->id));
        $this->assertFalse($package->containsService(Service::where('name','=','ServiceC')->first()->id));
        $this->assertNotEmpty($package->availableServices());

    }

    public function testPackageServices() {
        $package = Package::create(array(
            'name' => 'PackageD',
            'cost' => 100,
            'active' => 1,
        ));

        $service = Service::create(array(
           'name' => 'ServiceD',
            'cost' => 400,
            'active' => 1,
        ));

        $package->services()->attach($service->id);
        $this->assertNotEmpty($package->services());
    }

}
