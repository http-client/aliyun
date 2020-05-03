<?php



namespace HttpClient\Aliyun\KeyManagementService;

class Secret extends Definition
{
    public function list()
    {
        return $this->request([
            'Action' => 'ListSecrets',
        ]);
    }

    public function get($name)
    {
        return $this->request([
            'Action' => 'DescribeSecret',
            'SecretName' => $name,
        ]);
    }

    public function versions($name, array $params = [])
    {
        return $this->request([
            'Action' => 'ListSecretVersionIds',
            'SecretName' => $name,
        ] + $params);
    }

    public function randomPassword($length = null, array $params = [])
    {
        return $this->request([
            'Action' => 'GetRandomPassword',
            'PasswordLength' => $length,
        ] + $params);
    }

    public function create(array $params)
    {
        return $this->request([
            'Action' => 'CreateSecret',
        ] + $params);
    }

    public function put($name, $value, $version, array $params = [])
    {
        return $this->request([
            'Action' => 'PutSecretValue',
            'SecretData' => $value,
            'SecretName' => $name,
            'VersionId' => $version,
        ] + $params);
    }

    public function value($name, $version = null, $versionStage = null)
    {
        return $this->request([
            'Action' => 'GetSecretValue',
            'SecretName' => $name,
            'VersionStage' => $versionStage,
            'VersionId' => $version,
        ]);
    }

    public function delete($name, array $params = [])
    {
        return $this->request([
            'Action' => 'DeleteSecret',
            'SecretName' => $name,
        ] + $params);
    }

    public function forceDelete($name)
    {
        return $this->delete($name, [
            'ForceDeleteWithoutRecovery' => 'true',
        ]);
    }
}
