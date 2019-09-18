<?php

namespace AgoraApi;

/**
 * https://docs.agora.io/cn/Agora%20Platform/dashboard_restful_communication
 */
class Dashboard
{
    use Request;

    /**
     * 获取所有项目
     *
     * @return array
     */
    public function projects(): array
    {
        $url = '/dev/v1/projects';

        return $this->request('get', $url);
    }

    /**
     * 获取单个项目
     *
     * @param string $key id|name
     * @param string $value
     * @return array
     */
    public function project(string $key, string $value): array
    {
        $url = '/dev/v1/project';

        return $this->request('get', $url, [
            'query' => [$key => $value],
        ]);
    }

    /**
     * 创建项目
     *
     * @param string $name
     * @param boolean $enableSignKey
     * @return array
     */
    public function createProject(string $name, bool $enableSignKey = false): array
    {
        $url = '/dev/v1/project';

        return $this->request('post', $url, [
            'form_params' => [
                'name' => $name,
                'enable_sign_key' => $enableSignKey
            ]
        ]);
    }

    /**
     * 修改项目状态
     *
     * @param string $id
     * @param integer $status
     * @return array
     */
    public function setProjectStatus(string $id, int $status = 0): array
    {
        $url = '/dev/v1/project_status';

        return $this->request('post', $url, [
            'json' => [
                'id' => $id,
                'status' => $status
            ]
        ]);
    }

    /**
     * 删除项目
     *
     * @param string $id
     * @return array
     */
    public function deleteProject(string $id): array
    {
        $url = '/dev/v1/project';

        return $this->request('delete', $url, [
            'form_params' => [
                'id' => $id,
            ]
        ]);
    }

    /**
     * 设置项目的录制项目服务器 IP
     *
     * @param string $id
     * @return array
     */
    public function recordingConfig(string $id): array
    {
        $url = '/dev/v1/recording_config';

        return $this->request('post', $url, [
            'form_params' => [
                'id' => $id,
            ]
        ]);
    }

    /**
     * 启用项目 App Certificate
     *
     * @param string $id
     * @param boolean $enable
     * @return array
     */
    public function signKey(string $id, bool $enable = false): array
    {
        $url = '/dev/v1/signkey';

        return $this->request('post', $url, [
            'json' => [
                'id' => $id,
                'enable' => $enable,
            ]
        ]);
    }

    /**
     * 重置项目的 App Certificate
     *
     * @param string $id
     * @return array
     */
    public function resetSignKey(string $id): array
    {
        $url = '/dev/v1/reset_signkey';

        return $this->request('post', $url, [
            'json' => [
                'id' => $id
            ]
        ]);
    }

    /**
     * 获取用量数据
     * 该响应中 audio，sd，hd 及 hdp 的单位为分钟
     *
     * @param string $fromDate YYYY-MM-DD
     * @param string $toDate YYYY-MM-DD
     * @param array $projectIds
     * @return array
     */
    public function usage(string $fromDate, string $toDate, array $projectIds = []): array
    {
        $url = '/dev/v1/usage';

        return $this->request('get', $url, [
            'query' => [
                'from_date' => $fromDate,
                'to_date' => $toDate,
                'projects' => implode(',', $projectIds),
            ]
        ]);
    }

    /**
     * 创建规则
     *
     * @param string $appId
     * @param string|null $cname
     * @param string|null $uid
     * @param string|null $ip
     * @param integer $time
     * @param array $privileges
     * @return array
     */
    public function createKickingRule(string $appId, ?string $cname = null, ?string $uid, ?string $ip = null, int $time = 60, array $privileges = ['join_channel']): array
    {
        $url = '/dev/v1/kicking-rule';

        $json = [
            'appid' => $appId,
            'time' => $time,
            'privileges' => $privileges,
        ];
        if ($cname !== null) {
            $json['cname'] = $cname;
        }
        if ($uid !== null) {
            $json['uid'] = $uid;
        }
        if ($ip !== null) {
            $json['ip'] = $ip;
        }

        return $this->request('post', $url, [
            'json' => $json
        ]);
    }

    /**
     * 获取规则列表
     *
     * @param string $appId
     * @return array
     */
    public function kickingRule(string $appId): array
    {
        $url = '/dev/v1/kicking-rule';

        return $this->request('get', $url, [
            'query' => [
                'appid' => $appId
            ]
        ]);
    }

    /**
     * 更新规则
     *
     * @param string $appId
     * @param string $id
     * @param integer $time
     * @return array
     */
    public function updateKickingRule(string $appId, string $id, int $time): array
    {
        $url = '/dev/v1/kicking-rule';

        return $this->request('put', $url, [
            'json' => [
                'appid' => $appId,
                'id' => $id,
                'time' => $time,
            ]
        ]);
    }

    /**
     * 删除规则
     *
     * @param string $appId
     * @param string $id
     * @return array
     */
    public function deleteKickingRule(string $appId, string $id): array
    {
        $url = '/dev/v1/kicking-rule';

        return $this->request('delete', $url, [
            'query' => [
                'appid' => $appId,
                'id' => $id,
            ]
        ]);
    }

    /**
     * 查询某个用户在指定频道中的状态
     *
     * @param string $appId
     * @param string $uid
     * @param string $cname
     * @return array
     */
    public function channelUserProperty(string $appId, string $uid, string $cname): array
    {
        $url = "/dev/v1/channel/user/property/{$appId}/{$uid}/{$cname}";

        return $this->request('get', $url);
    }

    /**
     * 查询频道内的分角色用户列表
     *
     * @param string $appId
     * @param string $cname
     * @return array
     */
    public function channelUser(string $appId, string $cname): array
    {
        $url = "/dev/v1/channel/user/{$appId}/{$cname}";

        return $this->request('get', $url);
    }

    /**
     * 分页查询厂商频道列表
     *
     * @param string $appId
     * @param integer $pageNo
     * @param integer $pageSize
     * @return array
     */
    public function channelAppId(string $appId, int $pageNo = 0, int $pageSize = 100): array
    {
        $pageSize = ($pageSize <= 0 || $pageSize > 500) ? 100 : $pageSize;

        $url = "/dev/v1/channel/{$appId}";

        return $this->request('get', $url, [
            'query' => [
                'page_no' => $pageNo,
                'page_size' => $pageSize,
            ]
        ]);
    }
}
