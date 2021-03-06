<?php



namespace HttpClient\Aliyun;

/**
 * Class Factory.
 *
 * @method static \HttpClient\Aliyun\CertificateAuthorityService\Application certificateAuthorityService(array $options)
 * @method static \HttpClient\Aliyun\CloudMonitor\Application cloudMonitor(array $options)
 * @method static \HttpClient\Aliyun\DomainNameService\Application domainNameService(array $options)
 * @method static \HttpClient\Aliyun\ElasticComputeService\Application elasticComputeService(array $options)
 * @method static \HttpClient\Aliyun\FunctionCompute\Application functionCompute(array $options)
 * @method static \HttpClient\Aliyun\LogService\Application logService(array $options)
 * @method static \HttpClient\Aliyun\MessageNotificationService\Application messageNotificationService(array $options)
 * @method static \HttpClient\Aliyun\NetworkAttachedStorage\Application networkAttachedStorage(array $options)
 * @method static \HttpClient\Aliyun\ObjectStorageService\Application objectStorageService(array $options)
 * @method static \HttpClient\Aliyun\RelationalDatabaseService\Application relationalDatabaseService(array $options)
 * @method static \HttpClient\Aliyun\ResourceAccessManagement\Application resourceAccessManagement(array $options)
 * @method static \HttpClient\Aliyun\SecurityTokenService\Application securityTokenService(array $options)
 * @method static \HttpClient\Aliyun\VirtualPrivateCloud\Application virtualPrivateCloud(array $options)
 */
class Factory
{
    /**
     * @return \HttpClient\Core\Application
     */
    public static function __callStatic(string $name, array $arguments)
    {
        $aliases = [
            'kms' => 'KeyManagementService',
            'oss' => 'ObjectStorageService',
            'rds' => 'RelationalDatabaseService',
        ];

        $app = sprintf('HttpClient\\Aliyun\\%s\\Application', $aliases[$name] ?? ucfirst($name));

        return new $app(...$arguments);
    }
}
