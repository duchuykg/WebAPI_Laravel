<?php

namespace App\Repositories;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;
use App\Exceptions\UserAlreadyExistsException;
use App\Repositories\Contracts\IUserRepository;

class UserRepository implements IUserRepository
{
    public function getAll(){
        return User::with([
            'post' => function ($query) {
                $query->select('id', 'user_id', 'description');
            }
        ])->get();
    }

    public function getById($id){
        return User::with([
            'post' => function ($query) {
                $query->select('id AS post_id','user_id', 'category_id', 'description');
            },
            'post.category:id,name'
        ])->find($id); 
    }

    public function create(array $data){
        return User::create(array_merge($data, ['password' => bcrypt($data['password'])]));
    }
    
    public function update(int $id, array $data){
        $user = User::find($id);
        if(!$user) throw new NotFoundException();

        return $user->update(array_merge($data, ['password' => bcrypt($data['password'])]));
    }

    public function delete(int $id){
        $user = User::find($id);
        if(!$user) throw new NotFoundException();

        return $user->delete();
    }
}