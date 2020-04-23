<?php



namespace HttpClient\Aliyun\VirtualPrivateCloud;

use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{

    /**
     * The client instances.
     *
     * @var array
     */
    protected $clients = [
        'client' => Client::class,
        'switch' => VSwitch::class,
        'zone' => Zone::class,
    ];

    public function get($vpcId, $regionId, array $params = [])
    {
        return $this->client->request([
            'Action' => 'DescribeVpcAttribute',
            'RegionId' => $regionId,
            'VpcId' => $vpcId,
        ] + $params);
    }

    public function list($regionId)
    {
        return $this->client->request([
            'Action' => 'DescribeVpcs',
            'RegionId' => $regionId,
        ]);
    }

    public function create(array $params)
    {
        return $this->client->request(array_merge(['Action' => 'CreateVpc'], $params));
    }

    public function delete($vpcId, $regionId)
    {
        return $this->client->request([
            'Action' => 'DeleteVpc',
            'VpcId' => $vpcId,
            'RegionId' => $regionId,
        ]);
    }
}
