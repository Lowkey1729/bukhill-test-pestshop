<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Expiration Minutes
    |--------------------------------------------------------------------------
    |
    | This value controls the number of minutes until an issued token will be
    | considered expired. If this value is null, access tokens do
    | not expire.
    |
    */

    'expiration' => '+1 hour',

    /*
   |--------------------------------------------------------------------------
   | Can only be used after
   |--------------------------------------------------------------------------
   |
   | This value controls the number of minutes before the user can start
   | using the generated token
   |
   */

    'used_after' => 'o minute',

];
