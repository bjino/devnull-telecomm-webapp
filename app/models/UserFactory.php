<?php

class UserFactory extends Eloquent {
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	
	public function populate($attr, $exists = false) {
        if($attr['factoryType'] === "commercial")
          {
                $commercial = CommercialCustomer::create(array(
                    'companyName' => $attr['companyName'],
                    'businessUnitName' => $attr['businessUnitName'],
                    'division' => $attr['division'],
                ));

                $customer = Customer::create(array(
                    'paymentMethod' => NULL,
                    'billingAddress' => NULL,
                ));

                $user = User::create(array(
                    'firstname'     => $attr['firstname'],
                    'lastname' => $attr['lastname'],
                    'email'    => $attr['email'],
                    'address'  => $attr['address'],
                    'city'     => $attr['city'],
                    'state'    => $attr['state'],
                    'phone'    => $attr['phone'],
                    'password' => Hash::make($attr['password']),
                ));

                $customer->user()->save($user);
                $commercial->user()->save($customer);
          }
          
          if($attr['factoryType'] === "retail")
          {
              $retail = RetailCustomer::create(array());

              $customer = Customer::create(array(
                  'paymentMethod' => NULL,
                  'billingAddress' => NULL,
              ));

              $user = User::create(array(
                  'firstname'     => $attr['firstname'],
                  'lastname' => $attr['lastname'],
                  'email'    => $attr['email'],
                  'address'  => $attr['address'],
                  'city'     => $attr['city'],
                  'state'    => $attr['state'],
                  'phone'    => $attr['phone'],
                  'password' => Hash::make($attr['password']),
              ));

              $customer->user()->save($user);
              $retail->user()->save($customer);
          }
        if($attr['factoryType'] === "service_rep")
        {
            $service_rep = ServiceRep::create(array());
            $user = User::create(array(
                'firstname'     => $attr['firstname'],
                'lastname' => $attr['lastname'],
                'email'    => $attr['email'],
                'address'  => $attr['address'],
                'city'     => $attr['city'],
                'state'    => $attr['state'],
                'phone'    => $attr['phone'],
                'password' => Hash::make($attr['password']),
            ));

            $service_rep->user()->save($user);
        }

        if($attr['factoryType'] === "marketing_rep")
        {
            $marketing_rep = MarketingRep::create(array());
            $user = User::create(array(
                'firstname'     => $attr['firstname'],
                'lastname' => $attr['lastname'],
                'email'    => $attr['email'],
                'address'  => $attr['address'],
                'city'     => $attr['city'],
                'state'    => $attr['state'],
                'phone'    => $attr['phone'],
                'password' => Hash::make($attr['password']),
            ));

            $marketing_rep->user()->save($user);
        }

        if($attr['factoryType'] === "user")
        {
            $user = User::create(array(
                'firstname'     => $attr['firstname'],
                'lastname' => $attr['lastname'],
                'email'    => $attr['email'],
                'address'  => $attr['address'],
                'city'     => $attr['city'],
                'state'    => $attr['state'],
                'phone'    => $attr['phone'],
                'password' => Hash::make($attr['password']),
            ));
            $user->save();

        }

    }
}
