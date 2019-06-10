<?php 
namespace App;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements JWTSubject
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
    protected $fillable = ['name','nickname', 'email', 'cpf', 'password', ];
    protected $hidden   = ['password', 'remember_token', ];
    protected $casts    = ['email_verified_at' => 'datetime',];

    public function allUsers(){
        return self::all();
    }

    public function saveUsers()
    {
        $input             = Input::all();

        $input['password'] = Hash::make($input['password']);

        $user              = new User();

        $user->fill($input);

        $user->save();

        if(is_null($user)){
            return false;
        }
        return $user;
    }

    public function getUser($id)
    {
        return self::find($id);
    }
    


    public function updateUser($id)
    {
        $user = self::find($id);
        if(is_null($user)){
            return false;
        }
        $input             = Input::all();
        if(isset($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }
        $user->fill($input);
        $user->save();
        return $user;
    }

    public function deleteUser($id)
    {
        $user = self::find($id);
        if(is_null($user)){
            return false;
        }
        return $user->delete();
    }
}
