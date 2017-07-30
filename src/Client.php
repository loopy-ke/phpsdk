<?php

namespace Loopy;

class Client
{
    const ENDPOINT = 'https://loopy.us.to/v2/';
    protected $key;
    protected $secret;

    public function __construct($key, $secret)
    {
        $this->key = $key;
        $this->secret = $secret;
    }

    public function signUrl($url)
    {
        return sha1($this->key . "$url" . $this->secret);
    }

    public function getEndPoint()
    {
        return static::ENDPOINT;
    }

    public function getPdfUrl($resource, $params = [])
    {
        $query = http_build_query($params);
        return $this->getEndPoint() . $this->key . "/" . $this->signUrl($resource) . "/pdf?$query" . (count($params) > 0 ? '&' : '') . "url=" . urlencode($resource);
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param mixed $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

}