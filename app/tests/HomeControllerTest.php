<?php
class HomeControllerTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $uf = new UserFactory();
        $userdata = array(
            'factoryType' => 'retail',
            'firstname'     => 'Bob',
            'lastname' => 'B',
            'email'    => 'bob@bob.com',
            'address'  => '12345 Yipsy Drive',
            'city'     => 'Yipsy',
            'state'    => 'CA',
            'phone'    => '1234567',
            'password' => 'bob',
        );
        $uf->populate($userdata);

        $userdata = array(
            'factoryType' => 'commercial',
            'firstname' => 'Lol',
            'lastname' => 'asdf',
            'email' => 'lol@lol.com',
            'address' => 'asdf',
            'city' => 'asdf',
            'state' => 'asdf',
            'phone' => '12345',
            'password' => 'rofl',
            'companyName'   => 'lmao',
            'businessUnitName'  => 'lulz',
            'division'      => 'roflcopter',
        );
        $uf->populate($userdata);
    }

    public function testLogout() {
        $user = User::where('firstname', '=', 'Bob')->first();
        Auth::login($user);

        $this->call('GET','logout');
        $this->assertRedirectedTo('login');
    }

    public function testGetLogin() {
        $this->action('GET','login');
        $this->assertResponseOk();


        $user = User::where('firstname', '=', 'Bob')->first();
        Auth::login($user);
        $this->action('GET','login');
        $this->assertRedirectedTo('dashboard');
        Auth::logout();
    }

    public function testBadLogin() {
        $this->action('POST', 'login', null, array([]));
        $this->assertRedirectedTo('login');

        $info = array(
            'email' => 'notreal@blah.com',
            'password' => 'ohno',
        );
        $this->action('POST', 'login', null, $info);
        $this->assertRedirectedTo('login');
    }

    public function testLoginCommercial()
    {
        $credentials = array(
            'email' => 'lol@lol.com',
            'password' => 'rofl',
        );

        $this->action('POST', 'login', null, $credentials);
        $this->assertRedirectedTo('dashboard');

        $this->action('GET','dashboard');
        $this->assertRedirectedTo('dashboard');

        Auth::logout();
    }

    public function testLoginRetail()
    {
        $credentials = array(
            'email' => 'bob@bob.com',
            'password' => 'bob',
        );

        $this->action('POST', 'login', null, $credentials);
        $this->assertRedirectedTo('dashboard');

        $user = User::where('email','=','bob@bob.com')->first();
        $this->assertEquals($user, Auth::user());

        $this->action('GET','dashboard');
        $this->assertRedirectedTo('dashboard');

        Auth::logout();
    }
    public function testLoginService()
    {
        $credentials = array(
            'email' => 'customerServiceRep@devnull.com',
            'password' => 'asdf',
        );

        $this->action('POST', 'login', null, $credentials);
        $this->assertRedirectedTo('users');

        Auth::logout();
    }

    public function testLoginMarketing()
    {
        $credentials = array(
            'email' => 'marketingRep@devnull.com',
            'password' => 'asdf',
        );

        $this->action('POST','login',null,$credentials);
        $this->assertRedirectedTo('marketingrep');

        Auth::logout();
    }

    public function testGetSignup()
    {
        $this->action('GET', 'signup');
        $this->assertResponseOk();
    }

    public function testbadSignup() {
        $info = array(
            'firstname' => 'John',
            'lastname' => 'Smith',
        );

        $this->action('POST','signup',null,$info);
        $this->assertRedirectedTo('signup');

        $this->assertSessionHasErrors(['email']);
    }

    public function testGoodSignup() {
        $info = array(
            'firstname' => 'John',
            'lastname' => 'Smith',
            'email' => 'jsmith@test.com',
            'address' => 'asdf',
            'city' => 'asdf',
            'state' => 'asdf',
            'phone' => '12345',
            'password' => 'smith'
        );

        $this->action('POST','signup',null,$info);
        $this->assertRedirectedTo('/');
        Auth::logout();
    }

    public function testGetCommercialSignup() {
        $this->action('GET','signupCommercial');
        $this->assertResponseOk();
    }

    public function testBadCommercialSignup() {
        $info = array(
            'firstname' => 'John',
            'lastname' => 'Smith',
        );

        $this->action('POST','signupCommercial',null,$info);
        $this->assertRedirectedTo('signupCommercial');

        $this->assertSessionHasErrors(['email']);
    }

    public function testCommercialSignup() {
        $info = array(
            'firstname' => 'Mike',
            'lastname' => 'Shi',
            'email' => 'Mike@shi.com',
            'address' => 'asdf',
            'city' => 'asdf',
            'state' => 'asdf',
            'phone' => '12345',
            'password' => 'mike',
            'companyName'   => 'Mike',
            'businessUnit'  => 'what',
            'division'      => 'Mike',
        );

        $this->action('POST','signupCommercial',null,$info);
        $this->assertRedirectedTo('users');
    }
}