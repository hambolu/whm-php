<?php

namespace Ouchestechnology\WhmPhp;

function cpanelApi($baseUrl, $username, $password)
{
    return new CpanelApi($baseUrl, $username, $password);
}

function WhmPhp($baseUrl, $apiKey)
{
    return new WhmPhp($baseUrl, $apiKey);
}

    
