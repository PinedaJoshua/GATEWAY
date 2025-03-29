<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;
use GuzzleHttp\Exception\RequestException;

class User2Service{
    use ConsumesExternalService;

    /**
     * the base uri to consume the user2 service
     * @var string
     */
    public $baseUri;
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.users2.base_uri');
        $this->secret = config('services.users2.secret');
    }

    public function obtainUsers2()
    {
        return $this->performRequest('GET', '/users');
    }
    
    public function obtainUser2($id) {
        try {
            return $this->performRequest('GET', "/users/{$id}");
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() == 404) {
                return json_encode(["error" => "User ID does not exist", "code" => 404]);
            }
            return json_encode(["error" => "An unexpected error occurred", "code" => 500]);
        }
    }


    public function createUser2($data)
    {
        return $this-> performRequest('POST', '/users', $data);
    }

    public function editUser2($data, $id)
    {
        return $this -> performRequest('PUT', "/users/{$id}", $data);
    }

    public function deleteUser2($id) {
        return $this->performRequest('DELETE', "/users/{$id}");
    }
    
}