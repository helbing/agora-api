<?php

namespace AgoraApi;

use AgoraApi\Agora\RtcTokenBuilder;
use AgoraApi\Agora\RtmTokenBuilder;

class Token
{
    public const ROLE_ATTENDEE = 0;
    public const ROLE_PUBLISHER = 1;
    public const ROLE_SUBSCRIBER = 2;
    public const ROLE_ADMIN = 101;

    public const ROLE_RTM_USER = 1;

    /**
     * @var string
     */
    private $appId;

    /**
     * @var string
     */
    private $appCertificate;

    public function __construct(string $appId, string $appCertificate)
    {
        $this->appId = $appId;
        $this->appCertificate = $appCertificate;
    }

    /**
     * 生成 RTC Token
     *
     * @param string $channelName
     * @param string $uid
     * @param integer $role
     * @param integer $expireSecond
     * @return string
     */
    public function rtc(string $channelName, string $uid, int $role = self::ROLE_PUBLISHER, int $expireSecond = 1440): string
    {
        return RtcTokenBuilder::buildTokenWithUid($this->appId, $this->appCertificate, $channelName, $uid, $role, time() + $expireSecond);
    }

    /**
     * 生成 RTM Token
     *
     * @param string $userAccount
     * @param integer $role
     * @param integer $expireSecond
     * @return string
     */
    public function rtm(string $userAccount, int $role = self::ROLE_RTM_USER, int $expireSecond = 1440): string
    {
        return RtmTokenBuilder::buildToken($this->appId, $this->appId, $userAccount, $role, time() + $expireSecond);
    }
}
