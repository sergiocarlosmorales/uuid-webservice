<?php
namespace App\Http\Controllers;

abstract class UnNamedSpacedUuid_Controller extends Uuid_Controller
{
    /**
     * @return string
     */
    public function getInvalidExtraParametersMessage()
    {
        $uuidVersionNumber = $this->getUuidVersionNumber();
        return "UUID v{$uuidVersionNumber} does not require any parameter.";
    }
}