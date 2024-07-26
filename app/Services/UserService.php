<?php

namespace App\Services;

use App\Validations\Rules;
use App\Constants\ModelName;
use App\Exceptions\NotFoundException;
use App\Utilities\Traits\ValidateAPI;
use App\Repositories\RepositoryFactory;
use App\Services\Contracts\IUserService;
use App\Repositories\Contracts\IUserRepository;

class UserService implements IUserService
{
    use ValidateAPI;
    // protected $userRepository;
    /**
     * @var IUserRepository
     */
    protected $userRepository;

    // protected $authRepository;

    public function __construct(){
        $this->userRepository = RepositoryFactory::create(ModelName::USER);
        // $this->authRepository = $auth;
    }
    // public function __construct(IUserRepository $userRepository){
    //     $this->userRepository = $userRepository;
    // }

    public function getAll(){
        return $this->userRepository->getAll();
    }

    public function getById($id){
        $foundUser = $this->userRepository->getById($id);

        if ($foundUser) 
            return $foundUser;
        else
            throw new NotFoundException();
    }

    public function create(array $data){        
        $this->validate($data, RULES::USER_RULE);
        return $this->userRepository->create($data);
    }

    public function update(int $id, array $data){
        $this->validate($data, RULES::USER_RULE);   
        return $this->userRepository->update($id, $data);
    }

    public function delete(int $id){
        return $this->userRepository->delete($id);
    }
}

