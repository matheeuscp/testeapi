<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Response;
class UserController extends Controller
{
    protected $user = null;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function allUsers()
    {
        return Response::json($this->user->allUsers(), 200);
    }

    public function getUser($id)
    {
        $user = $this->user->getUser($id);
        if(!$user){
            return Response::json(["response"=>"Usuário não encontrado"], 400);
        }
        return Response::json($user, 200);  
    }

    public function updateUser($id)
    {
        $user = $this->user->updateUser($id);
        if(!$user){
            return Response::json(["response"=>"Usuário não encontrado"], 400);
        }
        return Response::json($user, 200); 
    }

    public function saveUser()
    {
        return Response::json($this->user->saveUsers(),200);
        
    }

    public function deleteUser($id)
    {
        $user = $this->user->deleteUser($id);
        if(!$user){
            return Response::json(["response"=>"Usuário não encontrado"], 400);
        }
        return Response::json(["response"=>"Usuário deletado com sucesso!"], 200); 
        
    }

}
