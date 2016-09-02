<?php
return [

    'permission' => 'Permission',

    'roles' => [
        'admin' => 'Administrator',
        'manager' => 'Manager',
        'user' => 'User',
    ],

    'permissions' => [

        'system' => [
            'view' => 'System: View',
            'manage' => 'System: Manage',
        ],

        'users' => [
            'view' => 'Users: View',
            'manage' => 'Users: Manage',
        ],

    ],
];
