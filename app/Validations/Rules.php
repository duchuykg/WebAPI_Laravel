<?php

namespace App\Validations;

class Rules
{
    public const AUTH_RULE = [
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ];

    public const ACCOUNT_RULE = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
        'is_admin' => 'required'
    ];
    
    public const CATEGORY_RULE = [
        'name' => 'required', 
        'slug' => 'required',
    ];

    public const USER_RULE = [
        'name' => 'required', 
        'email' => 'required',
        'password' => 'required', 
        'type' => 'required|in:0,1',
    ];

    public const POST_RULE = [
        'title' => 'required',
        'description' => 'required',
        'content' => 'required',
        'image' => 'required',
        'view_count' => 'required',
        'user_id' => 'required|exists:users,id',
        'new_post' => 'required',
        'slug' => 'required',
        'category_id' => 'required|exists:categories,id',
        'highlight_post' => 'required'
    ];
}