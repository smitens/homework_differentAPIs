<?php
class UseAPI {
    protected string $url;
    protected string $key;

    public function __construct(string $url, string $key = "")
    {
        $this->url = $url;
        $this->key = $key;
    }

    protected function apiResponse ($url): string
    {
        $apiResponse = file_get_contents($url);
        if ($apiResponse !== false) {
            return $apiResponse;
        } else {
            return "Error! Unable to get data from the API.";
        }
    }
}

class CatFacts extends UseAPI {
    public function getRandomFacts ($type, $amount): string
    {
        $endpoint = "$this->url/facts/random?animal_type=$type&amount=$amount";
        return $this->apiResponse($endpoint);
    }
}

class NameFacts extends UseAPI {
    public string $name;
    public function __construct(string $url, string $name, string $key = "")
    {
        parent::__construct($url, $key);
        $this->name = $name;
    }
    public function getNameFacts (): string
    {
        $endpoint = "$this->url?name=$this->name";
        return $this->apiResponse($endpoint);
    }
}

class ValidateEmail extends UseAPI {
    public string $email;
    public function __construct(string $url, string $email)
    {
        $key = getenv('EMAILVALIDATION_API_KEY');
        parent::__construct($url, $key);
        $this->email = $email;
    }
    public function validateEmail (): string
    {
        $endpoint = "$this->url/v1/info?apikey=$this->key=$this->email";
        return $this->apiResponse($endpoint);
    }
}