<?php

namespace App\Models\Passport;

use MongoDB\Laravel\Eloquent\DocumentModel;
use Laravel\Passport\AuthCode as PassportAuthCode;

class AuthCode extends PassportAuthCode {
    use DocumentModel;
    protected $primaryKey = '_id';
    protected $keyType = 'string';
}
