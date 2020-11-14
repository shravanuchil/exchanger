<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{

		$email = \Config\Services::email();

		$email->setFrom('shravanuchil@gmail.com', 'Shravan Uchil');
		$email->setTo('shravanuchil@gmail.com');

		$message = "This message is to check the email <br>
		<a href='https://vcare.webkarya.in'>Sign in</a>
		welcome
		";
		$email->setSubject('Email Test');
		$email->setMessage($message);

		

		//$email->send()





		return view('welcome_message');
	}

	//--------------------------------------------------------------------

}
