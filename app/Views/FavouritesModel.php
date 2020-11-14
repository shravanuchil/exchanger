<?php namespace App\Models;

use CodeIgniter\Model;

class FavouritesModel extends Model
{
    protected $table = 'favourites';
    protected $allowedFields = ['user_id', 'first_currency_id', 'second_currency_id', 'created'];

    public function getFavourites($user_id = false){
        if ($user_id === false){
            return [];
        }

        return $this->asArray()
                ->join('currencies', 'favourites.first_currency_id = currencies.id')
                ->where(['user_id' => $user_id]);
    }
 

}