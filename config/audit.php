<?php

return [

    'enabled' => env('AUDITING_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Implementation
    |--------------------------------------------------------------------------
    |
    | Define which Audit model implementation should be used.
    |
    */

    'implementation' => OwenIt\Auditing\Models\Audit::class,

    /*
    |--------------------------------------------------------------------------
    | User Morph prefix & Guards
    |--------------------------------------------------------------------------
    |
    | Define the morph prefix and authentication guards for the user resolving.
    |
    */

    'user' => [
        'primary_key' => 'id',
        'foreign_key' => 'user_id',
        'morph_prefix' => 'user',
        'guards' => [
            'web',
            'api'
        ],
        'resolver' => OwenIt\Auditing\Resolvers\UserResolver::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Audit Resolvers
    |--------------------------------------------------------------------------
    |
    | Define the IP Address, User Agent and URL resolver implementations.
    |
    */

    'resolver' => [
        'user' => OwenIt\Auditing\Resolvers\UserResolver::class,
        'ip_address' => OwenIt\Auditing\Resolvers\IpAddressResolver::class,
        'user_agent' => OwenIt\Auditing\Resolvers\UserAgentResolver::class,
        'url' => OwenIt\Auditing\Resolvers\UrlResolver::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Audit Events
    |--------------------------------------------------------------------------
    |
    | Define the list of Eloquent events that will trigger an Audit.
    | You can disable or enable each event individually using a boolean value.
    |
    */

    'events' => [
        'created' => true,
        'updated' => true,
        'deleted' => true,
        'restored' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Strict Mode
    |--------------------------------------------------------------------------
    |
    | Define whether strict mode is enabled or not.
    |
    */

    'strict' => false,

    /*
    |--------------------------------------------------------------------------
    | Global Ignore
    |--------------------------------------------------------------------------
    |
    | Define which attributes should be ignored from the audit.
    | Note that this setting is global.
    |
    */

    'ignore' => [
        'created_at',
        'updated_at',
    ],

    /*
    |--------------------------------------------------------------------------
    | Audit Timestamps
    |--------------------------------------------------------------------------
    |
    | Define whether the Audits' created_at and updated_at timestamps are
    | logged.
    |
    */

    'timestamps' => true,

    /*
    |--------------------------------------------------------------------------
    | Audit Threshold
    |--------------------------------------------------------------------------
    |
    | Define a threshold for the amount of Audits a model can have.
    | When this threshold is reached, the oldest Audit records are deleted.
    | Note: 0 means no limit.
    |
    */

    'threshold' => 0,

    /*
    |--------------------------------------------------------------------------
    | Redact Attributes
    |--------------------------------------------------------------------------
    |
    | Redact audited attribute values when logging.
    | Note: Use an array with attribute names for enabling.
    |
    */

    'redact' => [],

    /*
    |--------------------------------------------------------------------------
    | Data Transfer Object (DTO)
    |--------------------------------------------------------------------------
    |
    | Define whether the Audit message is being broadcast using a data transfer
    | object.
    |
    */

    'dto' => false,
];
