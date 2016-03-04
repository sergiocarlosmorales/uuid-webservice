<?php
namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;

class Uuid_Version5Controller extends NameSpacedUuid_Controller
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

        return Uuid::uuid5($nameSpace, $requestedValue)->toString();
    }

    public function handleInsufficientParameters()
    {
        abort(self::HTTP_STATUS_CODE_BAD_REQUEST, "UUID v5 requires a name space and string.");
    }

    function handleInvalidExtraParameters()
    {
        abort(self::HTTP_STATUS_CODE_BAD_REQUEST, "UUID v5 only requires a name space and string.");
    }
}