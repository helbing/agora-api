<?php

namespace AgoraApi;

/**
 * https://docs.agora.io/cn/cloud-recording/cloud_recording_api_rest
 */
class RecordingBody
{
    /**
     * @var string
     */
    private $cname;

    /**
     * @var string
     */
    private $uid;

    /**
     * @var array
     */
    private $clientRequest;

    public function __construct(string $cname, string $uid, array $clientRequest = [])
    {
        $this->cname = $cname;
        $this->uid = $uid;
        $this->clientRequest = $clientRequest;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'cname' => $this->cname,
            'uid' => $this->uid,
            'clientRequest' => $this->clientRequest
        ];
    }
}
