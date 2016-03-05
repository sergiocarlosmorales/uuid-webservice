<?php
namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;

class Uuid_Version4Controller extends UnNamedSpacedUuid_Controller
{
    /**
     * @return int
     */
    public function getUuidVersionNumber()
    {
        return 4;
    }

    /**
     * @return string
     */
    function get()
    {
        return Uuid::uuid4()->toString();
    }
}