<?php
namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;

class Uuid_Version1Controller extends Uuid_Controller
{
    /**
     * @return string
     */
    function get()
    {
        return Uuid::uuid1()->toString();
    }

    function handleInvalidExtraParameters()
    {
        abort(self::HTTP_STATUS_CODE_BAD_REQUEST, "UUID v1 does not require any parameter.");
    }
}