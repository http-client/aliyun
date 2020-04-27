<?php

namespace HttpClient\Aliyun\ObjectStorageService;

use HttpClient\Aliyun\Signature\AuthorizationSignature;

trait AuthorizesUrls
{
    public function createPresignedUrlForPuttingObject($path, $contentType = '', $expires = '+5 minutes')
    {
        return $this->createPresignedUrl('PUT', $path, $expires, $contentType);
    }

    public function createPresignedUrlForGettingObject($path, $expires = '+5 minutes')
    {
        return $this->createPresignedUrl('GET', $path, $expires);
    }

    public function createPresignedUrlForCopyingObject($source, $to, $expires = '+5 minutes')
    {
        return $this->createPresignedUrl('PUT', $to, $expires, '', ['x-oss-copy-source' => $source]);
    }

    public function createPresignedRequest($method, $url, $expires = '+10 minutes', $headers = [])
    {
        // todo
    }

    public function createPresignedUrl($method, $url, $expires, $contentType = '', $ch = [])
    {
        if (!is_numeric($expires)) {
            $expires = strtotime($expires);
        }

        $resource = '/'.$this->config['bucket'].'/'.$url;

        if (isset($this->config['security_token'])) {
            $resource .= '?security-token='.$this->config['security_token'];
        }

        $signature = AuthorizationSignature::sign(
            $method, '', $contentType, $expires, $ch, $resource, $this->config['access_key_secret']
        );

        // $signature = $this->signForQueryString(
        //     'GET', $date = time() + 300,
        //     sprintf('/%s/%s', $this->config['bucket'], $filename)
        // );

        $query = http_build_query([
            'OSSAccessKeyId' => $this->config['access_key_id'],
            'Expires' => $expires,
            'Signature' => $signature,
            'security-token' => $this->config['security_token'] ?? null,
        ]);

        return sprintf('%s/%s?%s', $this->config['http']['base_uri'], $url, $query);
    }
}
