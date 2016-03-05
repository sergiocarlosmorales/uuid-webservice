<?php
namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;

class Uuid_Version1Controller extends UnNameSpacedUuid_Controller
{
    /**
     * @return int
     */
    public function getUuidVersionNumber()
    {
        return 1;
    }

    /**
     * @return string
     */
    function get()
    {
        return Uuid::uuid1()->toString();
    }
}