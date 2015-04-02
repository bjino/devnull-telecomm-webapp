<?php

class UserTest extends TestCase {

    public function setUp() {
        parent::setUp();
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
            'firstname'     => 'Commer',
            'lastname' => 'Cial',
            'email'    => 'asdf@ykawerjo.com',
            'address'  => '12345 Yipsy Drive',
            'city'     => 'Yipsy',
            'state'    => 'CA',
            'phone'    => '1234567',
            'password' => 'commer',
            'companyName'   => 'lmao',
            'businessUnitName'  => 'lulz',
            'division'      => 'roflcopter',
        );
        $uf->populate($userdata);
    }

    public function testUserService() {
        $user = User::where('firstname','=','Stanley')->first();

        $this->assertEmpty($user->getServices());
        $availableServices = $user->availableServices();
        $this->assertEquals(count(Service::all()), count($availableServices));

        $service = Service::where('name','=','ServiceA')->first();
        $user->services()->attach($service->id);

        $availableServices = $user->availableServices();
        foreach($availableServices as $aService) {
            $this->assertNotEquals($service->id, $aService);
        }
    }

    public function testUserPackage() {
        $user = User::where('firstname','=','Stanley')->first();

        $this->assertEmpty($user->getPackages());
        $availablePackages = $user->availablePackages();
        $this->assertEquals(count(Package::all()), count($availablePackages));

        $package = Package::where('name','=','PackageBC')->first();
        $user->packages()->attach($package->id);

        $availablePackages = $user->availablePackages();
        foreach($availablePackages as $aPackage) {
            $this->assertNotEquals($package->id, $aPackage);
        }
    }

    public function testGetType() {
        $user = User::where('firstname','=','Stanley')->first();

        $type = $user->getCustomerType();
        $this->assertEquals($type, 'Retail');

        $user = User::where('firstname','=','Commer')->first();
        $type = $user->getCustomerType();
        $this->assertEquals($type, 'Commercial');
    }

    public function testGetCost() {
        $user = User::where('firstname','=','Stanley')->first();
        $cost = $user->getServiceCost();
    }
}