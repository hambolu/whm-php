<?php
namespace Ouchestechnology\WhmPhp;
use Illuminate\Support\Facades\Http;

class CpanelApi
{
    protected $baseUrl;
    protected $username;
    protected $password;
    protected $type;


    public function __construct($path)
    {
        $this->baseUrl = config('app.baseUrl');
        $this->username    = config('app.username');
        $this->password    = config('app.password');
        //$this->type    = $type;
        $this->path    = $path;
    }

    protected function makeRequest($type)
    {
        $response = Http::withBasicAuth($this->username, $this->password)->$type($this->baseUrl.$this->path);
        //dd($type, $this->path, $response, $this->baseUrl.$this->path);

        return $response->json();

        
    }

    public function createCpanelAccount($username, $domain, $password)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->auth,
            'Accept' => 'application/json',
        ])->post($this->baseUrl.'/createacct',[
            'username' => $username,
            'domain' => $domain,
            'password' => $password,
        ]);

        return $response->json();
    }

    public function createHostingPackage($name, $quota, $maxEmailAccounts, $maxDatabases, $maxSubdomains)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->auth,
            'Accept' => 'application/json',
        ])->post($this->baseUrl.'/addpkg',[
            'name' => $name,
            'quota' => $quota,
            'max_email_acc' => $maxEmailAccounts,
            'max_sql' => $maxDatabases,
            'max_sub' => $maxSubdomains,
        ]);

        return $response->json();
        
    }

    public function getAllHostingPackages($type)
    {
         
        //$response = Http::withBasicAuth($this->username, $this->password)->$type($this->baseUrl.'/listpkgs');

        return $this->makeRequest($type);
    }

    public function getAllUsers()
    {

        return $this->makeRequest('listaccts?api.version=1');
    }

    public function suspendCpanelAccount($username)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->auth,
            'Accept' => 'application/json',
        ])->post($this->baseUrl.'/suspendacct',[
            'user' => $username,
        ]);

        return $response->json();
    }

    // Function to unsuspend a cPanel account
    public function unsuspendCpanelAccount($username)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->auth,
            'Accept' => 'application/json',
        ])->post($this->baseUrl.'/unsuspendacct',[
            'user' => $username,
        ]);

        return $response->json();

        
    }

    // Function to change the password of a cPanel account
    public function changeCpanelAccountPassword($username, $password)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->auth,
            'Accept' => 'application/json',
        ])->post($this->baseUrl.'/passwd',[
            'user' => $username,
            'pass' => $password,
        ]);

        return $response->json();
        
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
