<?php
namespace Ouchestechnology\WhmPhp;

class CpanelApi
{
    protected $baseUrl;
    protected $username;
    protected $password;

    public function __construct($baseUrl, $username, $password)
    {
        $this->baseUrl = $baseUrl;
        $this->username = $username;
        $this->password = $password;
    }

    protected function makeRequest($endpoint, $params = [], $method = 'GET')
    {
        $client = new Client([
            'base_uri' => $this->baseUrl,
            'auth' => [$this->username, $this->password],
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request($method, $endpoint, ['query' => $params]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function createCpanelAccount($username, $domain, $password)
    {
        $params = [
            'username' => $username,
            'domain' => $domain,
            'password' => $password,
        ];

        return $this->makeRequest('createacct', $params, 'POST');
    }

    public function createHostingPackage($name, $quota, $maxEmailAccounts, $maxDatabases, $maxSubdomains)
    {
        $params = [
            'name' => $name,
            'quota' => $quota,
            'max_email_acc' => $maxEmailAccounts,
            'max_sql' => $maxDatabases,
            'max_sub' => $maxSubdomains,
        ];

        return $this->makeRequest('addpkg', $params, 'POST');
    }

    public function getAllHostingPackages()
    {
        return $this->makeRequest('listpkgs');
    }

    public function getAllUsers()
    {
        return $this->makeRequest('listaccts');
    }

    public function suspendCpanelAccount($username)
    {
        $params = [
            'user' => $username,
        ];

        return $this->makeRequest('suspendacct', $params, 'POST');
    }

    // Function to unsuspend a cPanel account
    public function unsuspendCpanelAccount($username)
    {
        $params = [
            'user' => $username,
        ];

        return $this->makeRequest('unsuspendacct', $params, 'POST');
    }

    // Function to change the password of a cPanel account
    public function changeCpanelAccountPassword($username, $password)
    {
        $params = [
            'user' => $username,
            'pass' => $password,
        ];

        return $this->makeRequest('passwd', $params, 'POST');
    }

    // Function to delete a cPanel account
    public function deleteCpanelAccount($username)
    {
        $params = [
            'user' => $username,
        ];

        return $this->makeRequest('removeacct', $params, 'POST');
    }

    public function autoLoginToCpanel($username)
    {
        $params = [
            'user' => $username,
            'goto_uri' => '/cpanel',
        ];

        return $this->makeRequest('login', $params, 'POST');
    }

    // Function for upgrading/downgrading a cPanel account package
    public function upgradeDowngradePackage($username, $newPackage)
    {
        $params = [
            'user' => $username,
            'pkg' => $newPackage,
        ];

        return $this->makeRequest('changepackage', $params, 'POST');
    }

    // Function for domain management (example: add an addon domain)
    public function addAddonDomain($username, $domain, $subdomain, $dir)
    {
        $params = [
            'user' => $username,
            'domain' => $domain,
            'subdomain' => $subdomain,
            'dir' => $dir,
        ];

        return $this->makeRequest('addondomain', $params, 'POST');
    }

}
