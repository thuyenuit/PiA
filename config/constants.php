<?php

return [
    'PAGE_SIZE' => 10,
    'ACCEPT_IMAGE_TYPES' => 'image/gif,image/png,image/jpeg',

    'DEFAULT' => [
        'ICON' => 'images/favicon.png',
        'LOGO' => 'images/logo.png',
        'AVATAR' => 'images/avatar.png',
        'LOGIN_BG' => 'images/login_bg.jpg',
    ],
    'UPLOAD' => [
        'LOGO_ICON' => 'uploads/app',
    ],
    'LOCALE_TABS' => [
        'validation',
        'auth',
        'passwords',
        'datatables',
        'email',
        'layouts',
        'home',
        'translations',
        'members',
        'field_groups',
        'fields'
    ],
    'CONFIG_KEY' => [
        'SITE_LOGO' => 'site_logo',
        'SITE_FAVICON' => 'site_favicon',
        'LOGIN_IMAGE' => 'login_image',
        'DEFAULT_AVATAR_IMAGE' => 'default_avatar_image',
    ],
    'SYSTEM_PERMISSIONS' => [
        'assets_view',
        'assets_manage',
        'translations_view',
        'translations_manage',
        'groups_view',
        'groups_manage',
        'users_view',
        'users_manage',
        'payment_gateway_view',
        'payment_gateway_manage',
    ],
    'ORG_PERMISSIONS' => [
        'custom_fields_view',
        'custom_fields_manage',
        'clubs_view',
        'clubs_create',
        'clubs_edit',
        'clubs_delete',
        'members_view',
        'members_create',
        'members_edit',
        'members_delete',
        'payments_view',
        'payments_create',
        'payments_edit',
        'payments_delete',
        'report_clubs',
        'report_members',
        'report_payments',
    ],
];

