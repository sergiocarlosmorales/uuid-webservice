<?php
namespace App\Http\Controllers;

abstract class Uuid_Controller extends Controller
{
    const HTTP_STATUS_CODE_BAD_REQUEST = 400;

    /**
     * @return int
     */
    abstract function getUuidVersionNumber();

    /**
     * @return string
     */
    abstract function getInvalidExtraParametersMessage();

    protected function handleInvalidExtraParameters()
    {
        abort(static::HTTP_STATUS_CODE_BAD_REQUEST, $this->getInvalidExtraParametersMessage());
    }
}