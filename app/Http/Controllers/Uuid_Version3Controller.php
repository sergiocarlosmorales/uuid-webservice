<?php
namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;

class Uuid_Version3Controller extends NameSpacedUuid_Controller
{
    /**
     * @return int
     */
    public function getUuidVersionNumber()
    {
        return 3;
    }

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
}