<?php
namespace App\Http\Controllers;


class InvalidUuid_VersionController extends Controller
{
    public function invalidUuidVersion($version)
    {
        abort(
            self::HTTP_STATUS_CODE_BAD_REQUEST,
            "Invalid UUID version requested: '$version'."
        );
    }

    public function unsupportedVersion()
    {
        abort(
            self::HTTP_STATUS_CODE_NOT_IMPLEMENTED,
            "UUID version not supported."
        );
    }
}