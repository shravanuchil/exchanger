<?php namespace App\Models;

use CodeIgniter\Model;

class CurrencyModel extends Model
{
    protected $table = 'currencies';
    protected $allowedFields = ['code', 'rate', 'last_updated'];

    public function getCode($code = false){
        if ($code === false){
            return $this->select(['code','rate'])->findAll();
        }

        return $this->asArray()
                ->select(['code','rate'])
                ->where(['code' => $code])
                ->first();
    }

    public function getId($code = false){
        if ($code === false){
            return 0;
        }

        return $this->asArray()
                ->select(['id'])
                ->where(['code' => $code])
                ->first();
    }

    public function getById($id = false){
        if ($id === false){
            return [];
        }

        return $this->asArray()
                ->select(['code','rate'])
                ->where(['id' => $id])
                ->first();
    }

    public function update_currencies($quick_update = false){
        
        $updated_time = $this->asArray()->select(['last_updated'])->first();
        if(time() >= $updated_time['last_updated'] + (30*60) || $quick_update){
            
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
                            $currency = $this->getId($code);

                            if($currency){
                                $this->update($currency['id'],['code' => $code, 'rate' => $rate, 'last_updated' => time()]);

                            }else{
                                $this->save(['code' => $code, 'rate' => $rate, 'last_updated' => time()]);

                            }
                        }

            
                    }
            
                }
                catch(Exception $e) {
                    // Handle JSON parse error...
                }
            
            }
        }
    }
}