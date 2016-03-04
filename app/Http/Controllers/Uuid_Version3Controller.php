<?php
namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;

class Uuid_Version3Controller extends NameSpacedUuid_Controller
{
    /**
     * @param string $requestedNameSpace
     * @param string $requestedValue
     * @return string
     */
    public function get($requestedNameSpace, $requestedValue)
    {
        $nameSpace = $this->getNameSpace($requestedNameSpace);

        if ($nameSpace === null) {
            $this->handleInvalidNameSpace($requestedNameSpace);
        }

        return Uuid::uuid3($nameSpace, $requestedValue)->toString();
    }

    public function handleInsufficientParameters()
    {
        throw new \Exception("UUID v3 requires a name space and string.");
    }

    function handleInvalidExtraParameters()
    {
        throw new \Exception("UUID v3 only requires a name space and string.");
    }
}