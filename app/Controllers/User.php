<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CurrencyModel;
use App\Models\FavouritesModel;
use CodeIgniter\Controller;
use Config\MyConfig;

class User extends BaseController
{
    private function validate_login(){
        $session = session();
       $user = $session->get('user');
       if($user->id){
        return true;
       }
    }

	public function index()
	{
       if(!$this->validate_login()){
           return redirect()->to('/user/login');
       }else{
        return redirect()->to('/user/dashboard');
       }
    }
    
    public function register(){

        $config = new MyConfig();

        $model = new UserModel();
        helper('form');

        if ($this->request->getMethod() === 'post' && $this->validate([
            'username' => 'required|min_length[6]|max_length[50]',
            'email'  => 'required|valid_email',
            'first_name'  => 'required',
            'dob'  => 'required'
        ]))
        {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
            $password = substr( str_shuffle( $chars ), 0, 8 );
            $password1= sha1($password); //Encrypting Password
            $username = $this->request->getPost('username');
            $email_id = $this->request->getPost('email');

            $img = $this->request->getFile('age_doc');
            $newName = '';
            if($img->isValid() && !$img->hasMoved()){
                $newName = $img->getRandomName();
                $img->move(WRITEPATH.'uploads/'.$this->request->getPost('username').'/', $newName);
            }

            $new_user_data = [
                'username' => $username,
                'email' => $email_id,
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'phone' => $this->request->getPost('phone'),
                'dob' => $this->request->getPost('dob'),
                'age_proof' => $this->request->getPost('username'). "/".$newName,
                'pass1' => $password,
                'password' => $password1
            ];

            
            if($model->save($new_user_data)){

            $email = \Config\Services::email();

            $email->setFrom($config->adminEmail, $config->siteName);
            $email->setTo($email_id);


            $email->setSubject('Welcome to '.$config->siteName);
            $message = 'Hello,'. $first_name. "<br >". ' Please login <br > username :' .$username . "<br >". "password : ". $password;
            $email->setMessage($message);
            $email->send();
            return redirect()->to('/user/login');
            }

        }else{
            echo view('header');
            echo view('register');
            echo view('footer');
        }
    }

    public function dashboard(){
       if(!$this->validate_login()){
            return redirect()->to('/user/login');
        }

        $cur_model = new CurrencyModel();
        $cur_model->update_currencies();

       $fav_model = new FavouritesModel();

       $session = session();
       $user = $session->get('user');
       $data['user'] = $user;

       $favourites = $fav_model->getFavourites($user->id);
       $favourite_array = [];
        foreach($favourites->getResult() as $favourite){
            $first_currency = $cur_model->getById($favourite->first_currency_id);
            $second_currency = $cur_model->getById($favourite->second_currency_id);
            $favourite_array[] = [$favourite, 'first_currency' => $first_currency, 'second_currency' => $second_currency];

        }
       $data['favourites'] = $favourite_array;

       echo view('header', $data);
       echo view('dashboard', $data);
       echo view('footer', ['custom_js' => 'makefavourite']);
    }

    public function login(){
        $model = new UserModel();
        $session = session();


        helper('form');

        if ($this->request->getMethod() === 'post' && $this->validate([
            'username' => 'required',
            'password'  => 'required'
        ]))
        {
            $username = $this->request->getPost('username');
            $pass = sha1($this->request->getPost('password'));
            $user = $model->validate_user($username, $pass);
            
            if($user){
                $session->set('user', $user);
                return redirect()->to('dashboard');
            }
        }
        else{
            echo view('header');
            echo view('login');
            echo view('footer');
        }

    }

    public function logout(){
        $session = session();
       $user = $session->get('user');
       if($user->id){
           //destroy session
           $session->destroy();
           return redirect()->to('/user/login');
       }
    }


    public function update_currencies(){


        $cur_model = new CurrencyModel();
        $cur_model->update_currencies();

    /*        
        $req_url = 'https://v6.exchangerate-api.com/v6/9fc649924608314f6d2bc307/latest/USD';
        $response_json = file_get_contents($req_url);
        
        // Continuing if we got a result
        if(false !== $response_json) {
        
            // Try/catch for json_decode operation
            try {
        
                // Decoding
                $response = json_decode($response_json);
        
                // Check for success
                if('success' === $response->result) {
        
                    foreach($response->conversion_rates as $code => $rate){
                        $currency = $cur_model->getId($code);

                        if($currency){
                            $cur_model->update($currency['id'],['code' => $code, 'rate' => $rate, 'last_updated' => $response->time_last_update_unix]);

                        }else{
                            $cur_model->save(['code' => $code, 'rate' => $rate, 'last_updated' => $response->time_last_update_unix]);

                        }
                        echo "<br> updated .".$code;
                    }

        
                }
        
            }
            catch(Exception $e) {
                // Handle JSON parse error...
            }
        
        }
        */

    }


}
