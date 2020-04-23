<?php



namespace HttpClient\Aliyun\ObjectStorageService;

use HttpClient\Aliyun\Signature\AuthorizationSignature;

trait AuthorizesUrls
{
    public function createPresignedUrlForPuttingObject($path, $contentType = '', $expires = '+5 minutes')
    {
        return $this->createPresignedUrl('PUT', $path, $expires, $contentType);

        // $signature = $this->signForQueryString(
        //     'PUT', $date = time() + 300,
        //     sprintf('/%s/%s?security-token=%s', $this->config['bucket'], $filename, $secToken), $contentType
        // );

        // $query = http_build_query([
        //     'OSSAccessKeyId' => $this->config['access_key_id'],
        //     'Expires' => $date,
        //     'Signature' => $signature,
        //     'security-token' => $secToken,
        // ]);

        // return sprintf('%s/%s?%s', $this->getBaseUri(), $filename, $query);
    }

    public function createPresignedUrlForGettingObject($path, $expires = '+5 minutes')
    {
        return $this->createPresignedUrl('GET', $path, $expires);
        // $signature = $this->signForQueryString(
        //     'GET', $date = time() + 300,
        //     sprintf('/%s/%s', $this->config['bucket'], $filename)
        // );

        // $query = http_build_query([
        //     'OSSAccessKeyId' => $this->config['access_key_id'],
        //     'Expires' => $date,
        //     'Signature' => $signature,
        //     // 'security-token' => $secToken,
        // ]);

        // return sprintf('%s/%s?%s', $this->getBaseUri(), $filename, $query);
    }

    public function createPresignedUrlForCopyingObject($source, $to, $expires = '+5 minutes')
    {
        return $this->createPresignedUrl('PUT', $to, $expires, '', ['x-oss-copy-source' => $source]);
        // $signature = $this->signForQueryString(
        //     'PUT', $date = time() + 300,
        //     sprintf('/%s/%s?security-token=%s', $this->config['bucket'], $filename, $secToken),
        //     '', ['x-oss-copy-source' => $copySource]
        // );

        // $query = http_build_query([
        //     'OSSAccessKeyId' => $this->config['access_key_id'],
        //     'Expires' => $date,
        //     'Signature' => $signature,
        //     'security-token' => $secToken,
        // ]);

        // return sprintf('%s/%s?%s', $this->getBaseUri(), $filename, $query);
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