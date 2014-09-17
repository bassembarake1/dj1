<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return "";
});

/*******************************************
* REGISTER 
********************************************/

Route::post('register', function ()
{
		$rules = array(
			'firstname' => 'Required|Min:1|Max:80',
			'lastname' => 'Required|Min:1|Max:80',
			'registered-id'     => 'Required|Unique:users',
			'phone'       => 'Required', //validate a phone number
			'password'  =>'Required|AlphaNum|Between:6,60|Confirmed',
			'password_confirmation'=>'Required|AlphaNum|Between:6,60'
			);

		$v = Validator::make(Input::all(), $rules);
				
		if( $v->passes() ) {
			
			$phoneNumber = Input::get('phone');			
			$registeredId = Input::get('id');
			$firstName = Input::get('firstname');
			$lastName = Input::get('lastname');
			
			$user = new User();
			$user->firstname = $firstname;
			$user->lastname = $lastName;
			$user->registered-id = $registeredId;
			$user->date-of-birth = Input::get('dob');
			$user->gender = Input::get('gender');
			$user->account-type = 'email';
			$user->img-file-name = Input::get('imageFileName');
			$user->phone = $phoneNumber;
			$user->password = Hash::make(Input::get('password'));
			$tokenGen = $registeredId.$lastName;
			$tokenRegistration = md5(uniqid($tokenGen, true)); 
			$user->token = $tokenRegistration;
			$user->save();

			
			return json_encode(array(
				"response" => "success", 
				"userid" => $user->id
				));
		}
		else
		{ 
			return json_encode(array(
				"response" => "error", 
				"description"=> $v->messages()->all()
				));
		}
});