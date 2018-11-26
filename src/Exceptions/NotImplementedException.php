<?php
namespace App\Exceptions;

class NotImplementedException extends \Exception
{
    public function __construct(string $method) {
        $message = sprintf('Method %s need to be implemented', $method);
        parent::__construct($message);
    }

}