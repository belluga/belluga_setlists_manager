<?php

return [
    App\Providers\AppServiceProvider::class,
    MongoDB\Laravel\MongoDBServiceProvider::class,
    MongoDB\Laravel\Auth\PasswordResetServiceProvider::class,
    App\Providers\TenancyServiceProvider::class,
];
