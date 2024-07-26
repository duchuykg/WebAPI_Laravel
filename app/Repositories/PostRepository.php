<?php

namespace App\Repositories;

use App\Models\Post;
use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\IPostRepository;

class PostRepository implements IPostRepository
{

    public function getAll(){
        return Post::with([
            'category' => function ($query) {
                $query->select('id', 'name', 'slug');
            },
            'user' => function ($query) {
                $query->select('id', 'name', 'email', 'type');
            }
        ])->get();

    }

    public function getById($id){
        return Post::with([
            'category' => function ($query) {
                $query->select('id', 'name', 'slug');
            },
            'user' => function ($query) {
                $query->select('id', 'name', 'email', 'type');
            }
        ])->find($id);
    }

    public function create(array $data){
        return Post::create($data);
    }
    
    public function update(int $id, array $data){
        $post = Post::find($id);
        if(!$post) throw new NotFoundException();

        return $post->update($data);
    }

    public function delete(int $id){
        $post = Post::find($id);
        if(!$post) throw new NotFoundException();

        return $post->delete();
    }
}

