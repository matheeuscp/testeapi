<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    protected $user = null;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function allUsers(){
        return $this->user->allUsers();
    }
    public function getUser($id){
        return 'asdasd1';
        
    }
    public function updateUser($id){
        return 'asdasd2';
        
    }
    public function saveUser(){
        return $this->user->saveUsers();
        
    }
    public function deleteUser($id){
        return 'asdasd4';
        
    }

}
