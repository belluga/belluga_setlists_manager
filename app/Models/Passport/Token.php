<?php

namespace App\Models\Passport;

use MongoDB\Laravel\Eloquent\DocumentModel;
use Laravel\Passport\Token as PassportToken;

class Token extends PassportToken {
    use DocumentModel;
    protected $primaryKey = '_id';
    protected $keyType = 'string';
}
