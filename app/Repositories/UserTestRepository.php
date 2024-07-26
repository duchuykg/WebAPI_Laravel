<?php

namespace App\Repositories;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;
use App\Repositories\Contracts\IUserRepository;
class UserTestRepository implements IUserRepository
{

    public function getAll(){
        return User::all();
    }

    public function getById($id){
        return User::find($id); 
    }

    public function create(array $data){
        return User::create($data);
    }
    
    public function update(int $id, array $data){
        $user = User::find($id);
        if(!$user) throw new NotFoundException();

        return $user->update($data);
    }

    public function delete(int $id){
        $user = User::find($id);
        if(!$user) throw new NotFoundException();

        return $user->delete();
    }

    public function login($data)
    {
        if (!JWTAuth::attempt($data)) {
            throw new UnauthorizedException();
        }
    }

    public function register($data)
    {
        
    }
}

