<?php



namespace HttpClient\Aliyun\MessageNotificationService;

class QueueMessage extends Encapsulation
{
    public function send($queueName, string $message, int $delaySeconds = null, int $priority = null)
    {
        return $this->request('POST', "/queues/{$queueName}/messages", [
            'body' => XML::make('Message', [
                'MessageBody' => $message,
                'DelaySeconds' => $delaySeconds,
                'Priority' => $priority,
            ]),
        ]);
    }

    public function receive($queueName, $count = null, $waitSeconds = null)
    {
        $query = http_build_query(array_filter(['numOfMessages' => $count, 'waitseconds' => $waitSeconds]));

        return $this->request('GET',
            '/queues/'.$queueName.'/messages'.(empty($query) ? '' : '?'.$query)
        );
    }

    public function delete($queueName, $receiptHandle)
    {
        return $this->request('DELETE', "/queues/{$queueName}/messages?ReceiptHandle={$receiptHandle}");
    }

    public function peek($queueName)
    {
        return $this->request('GET', "/queues/{$queueName}/messages?peekonly=true");
    }

    public function peekQueueMessages($queueName, $number)
    {
        return $this->request('GET', "/queues/{$queueName}/messages?peekonly=true&numOfMessages={$number}");
    }

    public function changeVisibility($queueName, $receiptHandle, $timeout)
    {
        return $this->request('PUT', "/queues/{$queueName}/messages?receiptHandle={$receiptHandle}&visibilityTimeout={$timeout}");
    }
}
