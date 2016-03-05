<?php
namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;

class Uuid_Version5Controller extends NameSpacedUuid_Controller
{
    /**
     * @return int
     */
    public function getUuidVersionNumber()
    {
        return 5;
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

        return Uuid::uuid5($nameSpace, $requestedValue)->toString();
    }
}