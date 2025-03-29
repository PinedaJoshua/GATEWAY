<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;
use GuzzleHttp\Exception\RequestException;

class User1Service{
    use ConsumesExternalService;

    /**
     * the base uri to consume the user1 service
     * @var string
     */
    public $baseUri;
    public $secret;
    

    public function __construct()
    {
        $this->baseUri = config('services.users1.base_uri');
        $this->secret = config('services.users1.secret');
    }

    public function obtainUsers1()
    {
        return $this->performRequest('GET', '/users');
    }
    
    public function obtainUser1($id) {
        try {
            return $this->performRequest('GET', "/users/{$id}");
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() == 404) {
                return json_encode(["error" => "User ID does not exist", "code" => 404]);
            }
            return json_encode(["error" => "An unexpected error occurred", "code" => 500]);
        }
    }


    public function createUser1($data)
    {
        return $this-> performRequest('POST', '/users', $data);
    }

    public function editUser1($data, $id)
    {
        return $this -> performRequest('PUT', "/users/{$id}", $data);
    }

    public function deleteUser1($id) {
        return $this->performRequest('DELETE', "/users/{$id}");
    }
    
}