<?php
class DashboardControllerTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $uf = new UserFactory();
        $userdata = array(
            'factoryType' => 'retail',
            'firstname'     => 'Sneha',
            'lastname' => 'J',
            'email'    => 'sneha@sneha.com',
            'address'  => 'asdfadsf',
            'city'     => 'adsf',
            'state'    => 'CA',
            'phone'    => '1234567',
            'password' => 'sneha',
        );
        $uf->populate($userdata);
    }

    public function testNewPassword() {
        $user = User::where('firstname','=','Sneha')->first();

        Auth::login($user);
        $newPass = array(
            'password' => 'sneha2',
        );

        $this->action('GET','myaccount');
        $this->assertResponseOk();


        $this->action('POST','newpass', null, $newPass);
        Auth::logout();

        $credentials = array(
            'email' => 'sneha@sneha.com',
            'password' => 'sneha2',
        );
        $this->action('POST', 'login', null, $credentials);
        $this->assertRedirectedTo('dashboard');
        Auth::logout();


        $credentials = array(
            'email' => 'sneha@sneha.com',
            'password' => 'sneha',
        );
        $this->action('POST', 'login', null, $credentials);
        $this->assertRedirectedTo('login');
    }

    public function testAddRemoveService() {
        $user = User::where('firstname','=','Sneha')->first();
        Auth::login($user);

        $service = Service::where('name','=','ServiceA')->first();
        $info = array(
            'user_id' => $user->id,
            'service' => $service->id,
        );
        $this->action('POST', 'addservice', null, $info);
        $this->assertEquals(count($user->getServices()), 1);

        $this->action('POST','deleteservice', null, $info);
        $this->assertEquals(count($user->getServices()), 0);

        Auth::logout();
    }

    public function testAddRemovePackage() {
        $user = User::where('firstname','=','Sneha')->first();
        Auth::login($user);

        $package = Package::where('name','=','PackageBC')->first();
        $info = array(
            'user_id' => $user->id,
            'package' => $package->id,
        );
        $this->action('POST', 'addpackage', null, $info);
        $this->assertEquals(count($user->getPackages()), 1);

        $this->action('POST','deletepackage',null, $info);

        Auth::logout();
    }

    public function testRefuseServiceInPackage() {
        $user = User::where('firstname','=','Sneha')->first();
        Auth::login($user);
        $uServices = $user->getServices();

        $package = Package::where('name','=','PackageBC')->first();
        $info = array(
            'user_id' => $user->id,
            'package' => $package->id,
        );
        $this->action('POST', 'addpackage', null, $info);

        $service = Service::where('name','=','ServiceB')->first();
        $info = array(
            'user_id' => $user->id,
            'service' => $service->id,
        );
        $this->action('POST', 'addservice', null, $info);
        $this->assertEquals(count($user->getServices()), count($uServices));
        Auth::logout();
    }

    public function testAddDeleteNewService() {

        $serviceCount = count(Service::all());

        $newService = array(
            'servicename' => 'Jeff\'s Service',
            'cost' => 500,
            'cancel_fee' => 100,
            'description' => 'nice',
            'duration' => 50,
            'active' => 1,
        );
        $this->action('POST', 'addnewservice', null, $newService);

        $this->assertEquals($serviceCount+1, count(Service::all()));
        $service = Service::where('name','=','Jeff\'s Service')->first();
        $this->assertNotEmpty($service);

        $this->action('POST','deletenewservice', null, array('service' => $service->name));
        $service = Service::where('name','=','Jeff\'s Service')->first();
        $this->assertEquals($service->active, 0);
    }

    public function testAddDeleteServiceToPackage() {
        $package = Package::where('name','=','PackageAB')->first();
        $service = Service::where('name','=','ServiceC')->first();

        $info = array(
            'package_id' => $package->id,
            'ServiceC' => 1,
        );

        $this->action('POST','addpservice', null, $info);
        $package = Package::where('name','=','PackageAB')->first();
        $this->assertTrue($package->containsService($service->id));

        $this->action('POST','deletepservice',null,$info);
        $package = Package::where('name','=','PackageAB')->first();
        $this->assertFalse($package->containsService($service->id));
    }

    public function testAddDeleteNewPackage() {
        $serviceB = Service::where('name','=','ServiceB')->first();
        $serviceC = Service::where('name','=','ServiceC')->first();

        $info = array(
            'package_name' => 'NicePackage',
            'price' => 500,
            'cancel_fee' => 100,
            'duration' => 365,
            'ServiceB' => 1,
            'ServiceC' => 1,
        );

        $this->action('POST','addnewpackage',null,$info);
        $package = Package::where('name','=','NicePackage')->first();
        $this->assertTrue($package->containsService($serviceB->id));
        $this->assertTrue($package->containsService($serviceC->id));

        $this->action('POST','deletenewpackage', null, array('package'=>$package->name));
        $package = Package::where('name','=','NicePackage')->first();
        $this->assertEquals($package->active, 0);
    }

    public function testThreshold() {
        $user = User::where('firstname','=','Sneha')->first();
        Auth::login($user);

        $thresh = array(
            'threshold' => 100,
        );

        $this->action('GET','DashboardController@doThreshold', $thresh);
        $this->assertResponseOk();
        $this->action('GET','DashboardController@doThreshold',$thresh);
        $this->assertResponseOk();
        Auth::logout();
    }
}