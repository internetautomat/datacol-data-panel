<?php
return [

    'permission' => 'Разрешение',

    'roles' => [
        'admin' => 'Администратор',
        'manager' => 'Менеджер',
        'user' => 'Пользователь',
    ],

    'permissions' => [

        'system' => [
            'view' => 'Система: Просмотр',
            'manage' => 'Система: Управление',
        ],

        'users' => [
            'view' => 'Пользователи: Просмотр',
            'manage' => 'Пользователи: Управление',
        ],

    ],
];
