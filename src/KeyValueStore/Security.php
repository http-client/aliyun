<?php

namespace HttpClient\Aliyun\KeyValueStore;

class Security extends Definition
{
    public function ipAddresses($instanceId)
    {
        return $this->request([
            'Action' => 'DescribeSecurityIps',
            'InstanceId' => $instanceId,
        ]);
    }

    public function updateIpAddresses($instanceId, $addresses, array $params = [])
    {
        return $this->request([
            'Action' => 'ModifySecurityIps',
            'InstanceId' => $instanceId,
            'SecurityIps' => is_array($addresses) ? implode(',', $addresses) : $addresses,
        ] + $params);
    }
}
