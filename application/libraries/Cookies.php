<?php
/**
 * Classe para maniupular dados do cookie
 * 
 * @package Auth\Service;
 * @author Jordan Duarte
 * @todo //setcookie ("biscoit",10,false, "/", "fisicompany.com",0);    
 */
class Cookies
{
    protected $namespace = "authenticate";
    protected $time = null;
    protected $domain = null;
    protected $cookies = [];
    
    public function __construct($time = '', $domain = '')
    {
        $this->domain = $domain;
        $this->time = $time;
    }
    
    public function addCookie(array $params)
    {
        $this->cookies = $params;
        return $this->setCookie();
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }

    public function getDomain()
    {
        return $this->domain;
    }

    public function setDomain($domain)
    {
        $this->domain = $domain;
        return $this;
    }
    
    public function hasNamespace($namespace = null)
    {
        $namespaceUsed = $this->namespace;
        if ($namespace) {
            $namespaceUsed = $namespace;
        }
        return isset($_COOKIE[$namespaceUsed]);
    }
    
    public function getCookie($type = true)
    {
        return json_decode($_COOKIE[$this->namespace], $type);
    }
    
    public function destroy()
    {
        unset($_COOKIE[$this->namespace]);
        return $this;
    }
    
    /**
     * Setar valor do domínio na mão para não dar erro
     *
     * @return \Auth\Service\Cookie
     */
    private function setCookie()
    {
        setcookie("authenticate", json_encode($this->cookies), $this->time, "/", "fisicompany.com", 0);
        return $this;
    }
}