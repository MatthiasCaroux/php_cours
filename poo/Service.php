<?php
class Service {
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    
}

$service = new Service('https://jsonplaceholder.typicode.com/todos/1');
