<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Utilities\Traits\ResponseAPI;
use App\Services\Contracts\IAuthService;
use App\Services\Contracts\IUserService;
use App\Exceptions\InvalidArgumentException;
use App\Exceptions\UserAlreadyExistsException;
use App\Exceptions\InvalidCredentialsException;

class AuthController extends Controller
{
    use ResponseAPI;
    protected $authSerivce;
    public function __construct(IAuthService $authSerivce) {
        $this->authSerivce = $authSerivce;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    
    public function login(Request $request)
    {
        $data = $request->all();

        try {
            $token = $this->authSerivce->login($data);
            return $this->sendLoginSuccess($token);
        } catch (InvalidCredentialsException $e) {
            return $this->sendError($e->getCode(), $e->getMessage());
        } 
        catch (InvalidArgumentException $e){
            return $this->sendError($e->getCode(), $e->getMessage());
        } catch (Exception $e){
            return $this->sendError(500, 'Internal Server Error');
        }       
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) 
    {
        $data = $request->all();

        try {
            $data = $this->authSerivce->register($data);
            return $this->sendCreateSuccess($data);
        } catch (UserAlreadyExistsException $e){
            return $this->sendError($e->getCode(), $e->getMessage());
        } catch (InvalidArgumentException $e){
            return $this->sendError($e->getCode(), $e->getMessage());
        } catch (Exception $e){
            return $this->sendError(500, 'Internal Server Error');
        }       
    }
}
