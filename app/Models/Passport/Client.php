<?php

namespace App\Models\Passport;

use Laravel\Passport\Client as PassportClient;
use MongoDB\Laravel\Eloquent\DocumentModel;

class Client extends PassportClient {
    use DocumentModel;
    protected $primaryKey = '_id';
    protected $keyType = 'string';
}
