Introduction

Ouchestechnology/whm-php is a Laravel package that provides a convenient wrapper around the cPanel API, allowing you to interact with cPanel accounts and perform various actions programmatically.
Installation

You can install the package via composer:

bash

composer require ouchestechnology/whm-php

Configuration

    Add the service provider to the config/app.php file:


    'providers' => [
        // Other providers...
        Ouchestechnology\WhmPhp\WhmPackageServiceProvider::class,
    ],

Add the package configuration to your Laravel app's config/services.php file:


    'whm' => [
        'base_url' => env('BASE_URL'),
        'api_key' => env('WHM_API_KEY'),
    ],

Open the .env file in your Laravel application and add the following cPanel credentials:


    BASE_URL=https://your-cpanel-host.com
    CPANEL_USERNAME=your_cpanel_username
    CPANEL_PASSWORD=your_cpanel_password
    WHM_API_KEY=your_api_key

Replace https://your-cpanel-host.com, your_cpanel_username, and your_cpanel_password with your actual cPanel credentials.

Usage
Create a cPanel Account

use Ouchestechnology\WhmPhp\CpanelApi;

$cpanel = new CpanelApi(config('cpanel.base_url'), config('cpanel.username'), config('cpanel.password'));

// Create a new cPanel account
    $response = $cpanel->createCpanelAccount('newaccount', 'example.com', 'secretpassword');

// Get all hosting packages
    $response = $cpanel->getAllHostingPackages();

// Get all cPanel users
    $response = $cpanel->getAllUsers();

// Get all hosting packages
    $response = $cpanel->getAllHostingPackages();

The Ouchestechnology/whm-php is open-sourced software licensed under the MIT license.