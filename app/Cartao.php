<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use App\User;

class Cartao extends Authenticatable implements JWTSubject
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
    protected $fillable = ['nome_cartao','numero_cartao', 'vencimento', 'user_id'];
    protected $hidden   = ['cod_seguranca', ];

    public function allCartoes($tokenJson){
        $tokenJson = JWTAuth::getToken();
        $apy       = JWTAuth::getPayload($tokenJson)->toArray();
        $cartoes   = User::with('cartaos')->find($apy['sub']);
        return $cartoes;
    }

    function user() {
        return $this->belongsTo('App\User');
    }
}
