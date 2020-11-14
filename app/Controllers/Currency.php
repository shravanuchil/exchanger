<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\FavouritesModel;
use App\Models\CurrencyModel;
use CodeIgniter\Controller;

class Currency extends BaseController
{
    private function validate_login(){
        $session = session();
       $user = $session->get('user');
       if($user->id){
        return true;
       }
    }

    public function index(){
        if(!$this->validate_login()){
            return redirect()->to('/user/login');
        }

        $cur_model = new CurrencyModel();
        $cur_model->update_currencies();

        $session = session();
       $user = $session->get('user');
       $data['user'] = $user;

        helper('form');
        $cur_model = new CurrencyModel();
        $data['amount'] = 1;
        if($this->request->getMethod() === 'post'){

            $first_code = $this->request->getPost('first_code');
            $second_code = $this->request->getPost('second_code');
            $button  = $this->request->getPost('button');

            if($button == 'favourite'){
                $fav_model = new FavouritesModel();
                $session = session();
                $user = $session->get('user');
                $count = $fav_model->getCount($user->id);
                $first_rate = $cur_model->getId($first_code);
                $second_rate = $cur_model->getId($second_code);
                if($count < 6){
                    $fav_model->save(['user_id' => $user->id, 'first_currency_id' => $first_rate['id'], 'second_currency_id' => $second_rate['id'], 'created' => date('Y-m-d H:i:s')]);
                    $data['sccMsg'] = 'Currencies added tp your favourite list';
                }else{
                    //your favourite list is already full
                    $data['errMsg'] = 'your favourite list is already full';
                }

            }else{

            $first_rate = $cur_model->getCode($first_code);

            $second_rate = $cur_model->getCode($second_code);

            $data['first_rate'] = $first_rate;
            $data['second_rate'] = $second_rate;
            $data['amount'] = $this->request->getPost('amount');;
        }



        }


            $curencies = $cur_model->getCode();
            $codes = [];

            foreach($curencies as $currency){
                $codes[$currency['code']] = $currency['code'];
            }
            $data['codes'] = $codes;
            echo view('header', $data);
            echo view('convertor', $data);
            echo view('footer', ['custom_js' => 'makefavourite']);
    }
}