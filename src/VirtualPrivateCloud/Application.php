<?php



namespace HttpClient\Aliyun\VirtualPrivateCloud;

use HttpClient\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * The definitions in the container.
     *
     * @var array
     */
    protected $definitions = [
        'request_encapsulation' => Encapsulation::class,
        'switch' => VSwitch::class,
        'zone' => Zone::class,
    ];

    public function get($vpcId, $regionId, array $params = [])
    {
        return $this->request_encapsulation->request([
            'Action' => 'DescribeVpcAttribute',
            'RegionId' => $regionId,
            'VpcId' => $vpcId,
        ] + $params);
    }

    public function list($regionId)
    {
        return $this->request_encapsulation->request([
            'Action' => 'DescribeVpcs',
            'RegionId' => $regionId,
        ]);
    }

    public function create(array $params)
    {
        return $this->request_encapsulation->request(array_merge(['Action' => 'CreateVpc'], $params));
    }

    public function delete($vpcId, $regionId)
    {
        return $this->request_encapsulation->request([
            'Action' => 'DeleteVpc',
            'VpcId' => $vpcId,
            'RegionId' => $regionId,
        ]);
    }
}
