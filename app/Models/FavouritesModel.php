<?php namespace App\Models;

use CodeIgniter\Model;

class FavouritesModel extends Model
{
    protected $table = 'favourites';
    protected $allowedFields = ['user_id', 'first_currency_id', 'second_currency_id', 'created'];

    public function getCount($user_id){
        return $this->db->table('favourites')
                    ->where('user_id =', $user_id)
                    ->countAllResults();
    }

    public function getFavourites($user_id = false){
        if ($user_id === false){
            return [];
        }

        return $this->db->table('favourites')
                ->where('user_id =', $user_id)
               ->get();
    }
 

}