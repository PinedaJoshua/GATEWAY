<?php

namespace App\Http\Controllers;

//use App\Models\User;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use DB;
use App\Services\User2Service;





class User2Controller extends Controller
{

    use ApiResponser;

    public $user2Service;

    public function __construct(User2Service $user2Service){
        $this-> user2Service = $user2Service;
    }


    

    /* Helper method to return a successful JSON response */
    protected function successResponse($data, $code = Response::HTTP_OK){
        return response()->json(['data' => $data], $code);
    }

    /* Helper method to return an error JSON response */
    protected function errorResponse($message, $code){
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    /* Return the list of users */
    public function index() {
        $users = json_decode($this->user2Service->obtainUsers2(), true);
    
        return $this->successResponse([
            'data' => $users['data'],  // Ensure only the users are included
            'site' => 'Site 2'
        ]);
    }
    
    
    

    /* Get all users */
    public function getUsers(){
       
    }

    /*Add a new user*/
    public function add(Request $request){
        $user = json_decode($this->user2Service->createUser2($request->all()), true);
    
        return $this->successResponse($user, Response::HTTP_CREATED);
    }
    
    /*Show details of a single user*/
    public function show($id){
        // Decode JSON to an array
        $user = json_decode($this->user2Service->obtainUser2($id), true);
    
        // If the response contains an "error" key, return it
        if (isset($user['error'])) {
            return $this->errorResponse($user['error'], $user['code']);
        }
    
        return $this->successResponse($user);
    }
    
    

    /*Update an existing user*/
    public function update(Request $request, $id){
        // Decode JSON to an array
        $updatedUser = json_decode($this->user2Service->editUser2($request->all(), $id), true);
    
        return $this->successResponse($updatedUser);
    }
    

    /* Delete a user */
    public function delete($id){
        // Decode JSON to an array
        $response = json_decode($this->user2Service->deleteUser2($id), true);
    
        return $this->successResponse($response);
    }
    




}