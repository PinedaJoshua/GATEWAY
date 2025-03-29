<?php

namespace App\Http\Controllers;

//use App\Models\User;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use DB;
use App\Services\User1Service;
use Illuminate\Support\Facades\Config; // Import Config facade





class User1Controller extends Controller
{

    public function testConfig()
{
    dd(config('services.users1.base_uri'), config('services.users2.base_uri'));
}

    use ApiResponser;

    public $user1Service;

    public function __construct(User1Service $user1Service){
        $this-> user1Service = $user1Service;
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
        $users = json_decode($this->user1Service->obtainUsers1(), true);
    
        return $this->successResponse([
            'data' => $users['data'],  // Ensure only the users are included
            'site' => 'Site 1'
        ]);
    }
    
    
    

    /* Get all users */
    public function getUsers(){
       
    }

    /*Add a new user*/
    public function add(Request $request){
        $user = json_decode($this->user1Service->createUser1($request->all()), true);
    
        return $this->successResponse($user, Response::HTTP_CREATED);
    }
    
    /*Show details of a single user*/
    public function show($id){
        // Decode JSON to an array
        $user = json_decode($this->user1Service->obtainUser1($id), true);
    
        // If the response contains an "error" key, return it
        if (isset($user['error'])) {
            return $this->errorResponse($user['error'], $user['code']);
        }
    
        return $this->successResponse($user);
    }
    
    

    /*Update an existing user*/
    public function update(Request $request, $id){
        // Decode JSON to an array
        $updatedUser = json_decode($this->user1Service->editUser1($request->all(), $id), true);
    
        return $this->successResponse($updatedUser);
    }
    

    /* Delete a user */
    public function delete($id){
        // Decode JSON to an array
        $response = json_decode($this->user1Service->deleteUser1($id), true);
    
        return $this->successResponse($response);
    }
    




}