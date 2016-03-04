<?php
namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;

class Uuid_Version4Controller extends Uuid_Controller
{
    /**
     * @return string
     */
    function get()
    {
        return Uuid::uuid4()->toString();
    }

    function handleInvalidExtraParameters()
    {
        throw new \Exception("UUID v4 does not require any parameter.");
    }
}