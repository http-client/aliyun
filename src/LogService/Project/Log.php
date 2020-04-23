<?php



namespace HttpClient\Aliyun\LogService\Project;
use HttpClient\Aliyun\LogService\Definition;
class Log extends Definition
{
    public function get($logstoreName, $from, $to, array $params = [])
    {
        $query = array_merge([
            'type' => 'log',
            'from' => $from,
            'to' => $to,
        ], $params);

        return $this->request('GET', "/logstores/{$logstoreName}", compact('query'));
    }

    public function putLogs(string $logstoreName, $data)
    {
        // dd($data);

        // dd(strlen($data));

        $mergedHeaders = [
            'Content-MD5' => md5($data),
            'Content-Type' => 'application/x-protobuf',
            // 'x-log-bodyrawsize' => ''.strlen($data),
            // 'x-log-compresstype' => 'deflate',
        ];
        // $data = gzcompress($data);
        return $this->request('POST', "/logstores/{$logstoreName}/shards/lb", [], $mergedHeaders, $data);
    }
}
