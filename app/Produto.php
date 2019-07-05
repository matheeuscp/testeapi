<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

class Produto extends Authenticatable implements JWTSubject
{
    use Notifiable;
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    protected $fillable = ['barCode','nome', 'preco'];

    public function allProducts($tokenJson){
        $input     = Input::all();
        if(!empty($input['nome'])){
            $tokenJson = JWTAuth::getToken();
            $apy       = JWTAuth::getPayload($tokenJson)->toArray();
            $prod      = self::where('nome', 'like', trim($input['nome']) .'%')->take(10)->get();
            return $prod;
        }
    }

    // public function saveCartao()
    // {
    //     $tokenJson = JWTAuth::getToken();
    //     $apy       = JWTAuth::getPayload($tokenJson)->toArray();
        
    //     $input             = Input::all();
    //     $input['user_id'] = $apy['sub'];

    //     $cartao              = new Cartao();

    //     $cartao->fill($input);
    //     $cartao->save();

    //     if(is_null($cartao)){
    //         return false;
    //     }
    //     return $cartao;
    // }
}
