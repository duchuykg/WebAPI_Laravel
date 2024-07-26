<?php

namespace App\Services;

use App\Validations\Rules;
use App\Constants\ModelName;
use App\Exceptions\NotFoundException;
use App\Utilities\Traits\ValidateAPI;
use App\Repositories\RepositoryFactory;
use App\Services\Contracts\IPostService;

class PostService implements IPostService
{
    use ValidateAPI;
    // protected PostRepository $postRepository;
    protected $postRepository;
    
    public function __construct(){
        $this->postRepository = RepositoryFactory::create(ModelName::POST);
    }

    public function getAll(){
        return $this->postRepository->getAll();
    }

    public function getById($id){
        $foundPost = $this->postRepository->getById($id);

        if ($foundPost) 
            return $foundPost;
        else
            throw new NotFoundException();
    }

    public function create(array $data){        
        $this->validate($data, RULES::POST_RULE);
        return $this->postRepository->create($data);
    }

    public function update(int $id, array $data){
        $this->validate($data, RULES::POST_RULE);   
        return $this->postRepository->update($id, $data);
    }

    public function delete(int $id){
        return $this->postRepository->delete($id);
    }
}

