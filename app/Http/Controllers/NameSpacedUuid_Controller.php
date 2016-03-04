<?php
namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;

class NameSpacedUuid_Controller extends Uuid_Controller
{
    const NS_DNS = 'dns';
    const NS_OID = 'oid';
    const NS_URL = 'url';
    const NS_X500 = 'x500';

    protected function handleInvalidNameSpace($nameSpace)
    {
        $validNameSpaces = implode(", ", $this->getValidNameSpaces());
        abort(
            self::HTTP_STATUS_CODE_BAD_REQUEST,
            "Invalid name space: '$nameSpace', valid values are: {$validNameSpaces}."
        );
    }

    /**
     * @param $requestedNameSpace
     * @return null|string
     */
    protected function getNameSpace($requestedNameSpace)
    {
        switch ($requestedNameSpace) {
            case self::NS_DNS:
                return Uuid::NAMESPACE_DNS;
            case self::NS_URL:
                return Uuid::NAMESPACE_URL;
            case self::NS_OID:
                return Uuid::NAMESPACE_OID;
            case self::NS_X500:
                return Uuid::NAMESPACE_X500;
            default:
                return null;
        }
    }

    /**
     * @return string[]
     */
    protected function getValidNameSpaces()
    {
        return [
            self::NS_DNS,
            self::NS_OID,
            self::NS_URL,
            self::NS_X500
        ];
    }
}