<?php

class UserHierarchyTest extends TestCase {

	public function testCommercial()
	{
		$userFactory = new UserFactory();
		$userFactory->populate(array(
			'factoryType' => 'commercial',
			'firstname' => 'Ryan',
			'lastname' => 'H',
			'email' => 'ryan@hill.com',
			'address' => '9450 Gilman Drive',
			'city' => 'La Jolla',
			'state' => 'CA',
			'phone' => '1234567',
			'password' => 'ryan',
			'companyName' => 'TESC',
			'businessUnitName' => 'asdf',
			'division' => 'asdf',
		));

		$user = User::where('firstname','=','Ryan')->first();
		$this->assertEquals($user->lastname, 'H');

		$customer = Customer::find($user->userable_id);
		$this->assertNotEmpty($customer);

		$commercial = CommercialCustomer::find($customer->userable_id);
		$this->assertNotEmpty($commercial);
	}

	public function testRetail()
	{
		$userFactory = new UserFactory();
		$userFactory->populate(array(
			'factoryType' => 'retail',
			'firstname' => 'Jesse',
			'lastname' => 'G',
			'email' => 'jesse@gallaway.com',
			'address' => '9450 Gilman Drive',
			'city' => 'La Jolla',
			'state' => 'CA',
			'phone' => '1234567',
			'password' => 'jesse',
		));

		$user = User::where('firstname','=','Jesse')->first();
		$this->assertEquals($user->lastname, 'G');

		$customer = Customer::find($user->userable_id);
		$this->assertNotEmpty($customer);

		$retail = RetailCustomer::find($customer->userable_id);
		$this->assertNotEmpty($retail);
	}

	public function testMarketingRep()
	{
		$userFactory = new UserFactory();
		$userFactory->populate(array(
			'factoryType' => 'marketing_rep',
			'firstname' => 'mrep',
			'lastname' => 'devnull',
			'email' => 'sasdfasd@werwer.com',
			'address' => '9450 Gilman Drive',
			'city' => 'La Jolla',
			'state' => 'CA',
			'phone' => '1234567',
			'password' => 'stanley',
		));

		$user = User::where('firstname','=','mrep')->first();
		$this->assertEquals($user->lastname, 'devnull');

		$marketing = MarketingRep::find($user->userable_id);
		$this->assertNotEmpty($marketing);
	}

	public function testServiceRep()
	{
		$userFactory = new UserFactory();
		$userFactory->populate(array(
			'factoryType' => 'service_rep',
			'firstname' => 'Jeffery',
			'lastname' => 'W',
			'email' => 'jeffery@wang.com',
			'address' => '9450 Gilman Drive',
			'city' => 'La Jolla',
			'state' => 'CA',
			'phone' => '1234567',
			'password' => 'jeffery',
		));

		$user = User::where('firstname','=','Jeffery')->first();
		$this->assertEquals($user->lastname, 'W');

		$serviceRep = ServiceRep::find($user->userable_id);
		$this->assertNotEmpty($serviceRep);
	}

}
