<?php



namespace HttpClient\Aliyun\ElasticComputeService;

class SecurityGroup extends Definition
{
    public function create(array $params = [])
    {
        return $this->request([
            'Action' => 'CreateSecurityGroup',
        ] + $params);
    }

    public function authorize(array $params = [])
    {
        return $this->request([
            'Action' => 'AuthorizeSecurityGroup',
        ] + $params);
    }

    public function delete($securityGroupId, $region)
    {
        return $this->request([
            'Action' => 'DeleteSecurityGroup',
            'SecurityGroupId' => $securityGroupId,
            'RegionId' => $region,
        ]);
    }
}
