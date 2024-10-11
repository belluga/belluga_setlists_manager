<?php

namespace App\Models\Passport;

use MongoDB\Laravel\Eloquent\DocumentModel;
use Laravel\Passport\PersonalAccessClient as PassportPersonalAccessClient;

class PersonalAccessClient extends PassportPersonalAccessClient {
    use DocumentModel;
    protected $primaryKey = '_id';
    protected $keyType = 'string';
}
