<?php

namespace AgoraApi;

/**
 * https://docs.agora.io/cn/cloud-recording/cloud_recording_api_rest
 */
class Recording
{
    use Request;

    /**
     * 获取云端录制资源
     *
     * @param string $appId
     * @param RecordingBody $recordingBody
     * @return array
     */
    public function acquire(string $appId, RecordingBody $recordingBody): array
    {
        $url = "/v1/apps/{$appId}/cloud_recording/acquire";

        return $this->request('post', $url, [
            'json' => $recordingBody->toArray()
        ]);
    }

    /**
     * 开始云端录制
     *
     * @param string $appId
     * @param string $resourceId
     * @param string $mode
     * @param RecordingBody $recordingBody
     * @return array
     */
    public function start(string $appId, string $resourceId, string $mode, RecordingBody $recordingBody): array
    {
        $url = "/v1/apps/{$appId}/cloud_recording/resourceid/{$resourceId}/mode/{$mode}/start";

        return $this->request('post', $url, [
            'json' => $recordingBody->toArray()
        ]);
    }

    /**
     * 更新合流布局
     *
     * @param string $appId
     * @param string $resourceId
     * @param string $sid
     * @param string $mode
     * @param RecordingBody $recordingBody
     * @return array
     */
    public function updateLayout(string $appId, string $resourceId, string $sid, string $mode, RecordingBody $recordingBody): array
    {
        $url = "/v1/apps/{$appId}/cloud_recording/resourceid/{$resourceId}/sid/{$sid}/mode/{$mode}/updateLayout";

        return $this->request('post', $url, [
            'json' => $recordingBody->toArray()
        ]);
    }

    /**
     * 查询云端录制状态
     *
     * @param string $appId
     * @param string $resourceId
     * @param string $sid
     * @param string $mode
     * @return array
     */
    public function query(string $appId, string $resourceId, string $sid, string $mode): array
    {
        $url = "/v1/apps/{$appId}/cloud_recording/resourceid/{$resourceId}/sid/{$sid}/mode/{$mode}/query";

        return $this->request('get', $url);
    }

    /**
     * 停止云端录制
     *
     * @param string $appId
     * @param string $resourceId
     * @param string $sid
     * @param string $mode
     * @param RecordingBody $recordingBody
     * @return array
     */
    public function stop(string $appId, string $resourceId, string $sid, string $mode, RecordingBody $recordingBody): array
    {
        $url = "/v1/apps/{$appId}/cloud_recording/resourceid/{$resourceId}/sid/{$sid}/mode/{$mode}/stop";

        return $this->request('post', $url, [
            'json' => $recordingBody->toArray()
        ]);
    }
}
