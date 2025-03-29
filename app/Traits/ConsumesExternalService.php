<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

trait ConsumesExternalService
{
    /**
     * Send a request to any service.
     * @return string
     */
    public function performRequest($method, $requestUrl, $form_params = [], $headers = [])
    {
        // Ensure that baseUri is defined in the class using this trait
        if (!isset($this->baseUri)) {
            throw new \Exception("Base URI is not set.");
        }

        // Create a new client request
        $client = new Client([
            'base_uri' => $this->baseUri
        ]);

        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }      

        try {
            $options = ['headers' => $headers];

            // Decide whether to use JSON or form_params
            if (!empty($form_params)) {
                if (isset($headers['Content-Type']) && $headers['Content-Type'] === 'application/json') {
                    $options['json'] = $form_params; // JSON request
                } else {
                    $options['form_params'] = $form_params; // Form-encoded request
                }
            }

            $response = $client->request($method, $requestUrl, $options);

            return $response->getBody()->getContents();
        } catch (RequestException $e) {
            return $e->getMessage();
        }
    }
}
