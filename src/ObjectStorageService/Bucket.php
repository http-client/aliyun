<?php

namespace HttpClient\Aliyun\ObjectStorageService;

use HttpClient\Aliyun\Signature\AuthorizationSignature;
use HttpClient\Support\Arr;

class Bucket extends Encapsulation
{
    public function signedRequest($request, $bucket, $expires = '30 minutes')
    {
        if (! is_numeric($expires)) {
            $expires = strtotime($expires);
        }

        $resource = sprintf('/%s/%s', $bucket, $request->getUri()->getPath()); //  '/'.$bucket.'/'.$url;

        if (isset($this->config['security_token'])) {
            $resource .= '?security-token='.$this->config['security_token'];
        }

        $headers = [];

        foreach ($request->getHeaders() as $key => $value) {
            $headers[$key] = implode(',', $value);
        }

        $ch = array_filter(Arr::startsWith($headers, 'x-oss-'));

        $signature = AuthorizationSignature::sign(
            $request->getMethod(), '',
            $request->getHeaderLine('Content-Type'),
            $expires, $ch, $resource, $this->config['access_key_secret'],
        );

        $query = http_build_query([
            'OSSAccessKeyId' => $this->config['access_key_id'],
            'Expires' => $expires,
            'Signature' => $signature,
            'security-token' => $this->config['security_token'] ?? null,
        ]);
        // dd($this->client->getBaseUri());
// return $request->getUri()->__toString();
        return sprintf('%s/%s?%s', $this->getBucketBaseUri($bucket), $request->getUri()->getPath(), $query);
    }

    public function info($bucket)
    {
        return $this->requestBucketEndpoint($bucket, 'GET', '/?bucketInfo');
    }

    public function create($bucket, $acl = null)
    {
        return $this->requestBucketEndpoint($bucket, 'PUT', '/', [
            'headers' => array_filter([
                'x-oss-acl' => $acl,
            ]),
        ]);
    }

    public function delete($bucket)
    {
        return $this->request('DELETE', $this->getBucketBaseUri($bucket));
    }
}
