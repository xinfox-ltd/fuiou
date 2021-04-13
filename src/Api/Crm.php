<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Fuiou\Api;

use XinFox\Fuiou\Exceptions\ApiException;
use XinFox\Fuiou\Exceptions\InvalidArgumentException;
use XinFox\Fuiou\Model\User;

/**
 * 上海富有支付--CRM接口
 * Class Crm
 * @package XinFox\Fuiou\Api
 */
class Crm extends Api
{
    /**
     * 通过手机号调账
     * @param int $phone
     * @param mixed $adjustAmt 调账金额（分），最大10 万元
     * @param string $operator 操作人
     * @param string $cardNo 实体卡号，纯数字
     * @param string $adjustPwd 调账密码明文
     * @param string $adjustType 调账类型：01 主账户；02 子账户，默认为01
     * @param string $cardId 卡 ID，为空则对默认卡进行调账
     * @return mixed
     * @throws ApiException
     */
    public function adjustByPhone(
        int $phone,
        $adjustAmt,
        string $operator,
        string $cardNo = '',
        string $adjustPwd = '',
        string $adjustType = '01',
        $cardId = ''
    ) {
        return $this->adjust($adjustAmt, $operator, $phone, '', $cardNo, $adjustPwd, $adjustType, $cardId);
    }

    /**
     * 通过openid调账
     * @param string $openId
     * @param mixed $adjustAmt 调账金额（分），最大10 万元
     * @param string $operator 操作人
     * @param string $cardNo 实体卡号，纯数字
     * @param string $adjustPwd 调账密码明文
     * @param string $adjustType 调账类型：01 主账户；02 子账户，默认为01
     * @param string $cardId 卡 ID，为空则对默认卡进行调账
     * @return mixed
     * @throws ApiException
     */
    public function adjustByOpenId(
        string $openId,
        $adjustAmt,
        string $operator,
        string $cardNo = '',
        string $adjustPwd = '',
        string $adjustType = '01',
        $cardId = ''
    ) {
        return $this->adjust($adjustAmt, $operator, '', $openId, $cardNo, $adjustPwd, $adjustType, $cardId);
    }

    /**
     * 调账接口 1
     * @param mixed $adjustAmt 调账金额（分），最大10 万元
     * @param string $operator 操作人
     * @param mixed $phone 手机号
     * @param string|null $openId 用户 openId，手机号和 openId 不能同时为空，当手机号为空时请传空串
     * @param string|null $cardNo 实体卡号，纯数字
     * @param string|null $adjustPwd 调账密码明文
     * @param string|null $adjustType 调账类型：01 主账户；02 子账户，默认为01
     * @param string|null $cardId 卡 ID，为空则对默认卡进行调账
     * @return mixed
     * @throws ApiException
     */
    private function adjust(
        $adjustAmt,
        string $operator,
        $phone = '',
        string $openId = '',
        string $cardNo = '',
        string $adjustPwd = '',
        string $adjustType = '',
        $cardId = ''
    ) {
//        mchntCd+"|"+phone+"|"+cardNo+"|"+adjustPwd+"|"+adjustAmt +"|"+salt 做 MD5 加密。
        return $this->request(
            '/api/adjust.action',
            [
                'phone' => $phone,
                'cardNo' => $cardNo,
                'adjustAmt' => $adjustAmt,
                'adjustPwd' => $adjustPwd,
                'operator' => $operator,
                'adjustType' => $adjustType,
                'cardId' => $cardId,
                'openId' => $openId
            ],
            [$phone, $cardNo, $adjustPwd, $adjustAmt]
        );
    }

    /**
     * 通过手机号查询余额
     * @param int $phone
     * @param $cardId
     * @return array
     * @throws ApiException
     */
    public function queryBalanceByPhone(int $phone, $cardId = ''): array
    {
        return $this->queryBalance($phone, '', $cardId);
    }

    /**
     * 通过openid查询余额
     * @param string $openId
     * @param $cardId
     * @return array
     * @throws ApiException
     */
    public function queryBalanceByOpenId(string $openId, $cardId = ''): array
    {
        return $this->queryBalance('', $openId, $cardId);
    }

    /** 余额查询接口 2
     * @param mixed $phone 手机号
     * @param string $openId 用户 openId，手机号和 openId 不能同时为空，当手机号为空时请传空串
     * @param string $cardId 卡 ID，为空则查询默认卡余额
     * @return array
     * @throws ApiException
     */
    private function queryBalance($phone, string $openId = '', string $cardId = ''): array
    {
        //phone +"|"+ mchntCd +"|"+salt 做 MD5 加密。
        $key = $this->sign2($phone);
        return $this->request(
            '/api/queryBalance.action',
            [
                'phone' => $phone,
                'cardId' => $cardId,
                'openId' => $openId
            ],
            $key
        );
    }

    /**
     * 通过手机号查询积分
     * @param int $phone
     * @return array
     * @throws ApiException
     */
    public function queryPointByPhone(int $phone): array
    {
        return $this->queryPoint($phone);
    }

    /**
     * 通过openid查询积分
     * @param string $openId
     * @return array
     * @throws ApiException
     */
    public function queryPointByOpenId(string $openId): array
    {
        return $this->queryPoint('', $openId);
    }

    /**
     *  积分查询接口  3
     * @param mixed $phone 手机号
     * @param string $openId 用户 openId，手机号和 openId 不能同时为空，当手机号为空时请传空串
     * @return array
     * @throws ApiException
     */
    private function queryPoint($phone = '', string $openId = ''): array
    {
        //phone +"|"+ mchntCd +"|"+salt 做 MD5 加密。
        $key = $this->sign2($phone);
        return $this->request(
            '/api/queryPoint.action',
            [
                'phone' => $phone,
                'openId' => $openId,
            ],
            $key
        );
    }

    /**
     * 通过phone修改积分
     * @param int $phone
     * @param int $point 要修改的积分数
     * @param int $oldPoint 原积分数
     * @param string $operator 操作人
     * @return array|mixed
     * @throws ApiException
     */
    public function editPointByPhone(
        int $phone,
        int $point,
        int $oldPoint,
        string $operator
    ): array {
        return $this->editPoint($point, $oldPoint, $operator, $phone);
    }

    /**
     * 通过openid修改积分
     * @param string $openId
     * @param int $point 要修改的积分数
     * @param int $oldPoint 原积分数
     * @param string $operator 操作人
     * @return array|mixed
     * @throws ApiException
     */
    public function editPointByOpenId(
        string $openId,
        int $point,
        int $oldPoint,
        string $operator
    ): array {
        return $this->editPoint($point, $oldPoint, $operator, '', $openId);
    }

    /**
     * 修改积分接口   4
     * @param int $point 要修改的积分数
     * @param int $oldPoint 原积分数
     * @param string $operator 操作人
     * @param mixed $phone 手机号
     * @param string $openId 用户 openId，手机号和 openId 不能同时为空，当手机号为空时请传空串
     * @return mixed
     * @throws ApiException
     */
    private function editPoint(
        int $point,
        int $oldPoint,
        string $operator,
        $phone = '',
        string $openId = ''
    ): array {
        //phone +"|"+ mchntCd +"|" + oldPoint + "|" + point + "|" + salt 做 MD5 加密。
        $key = $this->sign([$phone, $this->config['mchnt_cd'], $oldPoint, $point, $this->config['salt']]);
        return $this->request(
            '/api/editPoint.action',
            [
                'phone' => $phone,
                'point' => $point,
                'oldPoint' => $oldPoint,
                'operator' => $operator,
                'openId' => $openId,
            ],
            $key
        );
    }

    /**
     * @param int $phone
     * @return User
     * @throws ApiException|InvalidArgumentException
     */
    public function queryUserInfoByPhone(int $phone): User
    {
        return $this->queryUserInfo($phone);
    }

    /**
     * @param string $openId
     * @return User
     * @throws ApiException
     * @throws InvalidArgumentException
     */
    public function queryUserInfoByOpenId(string $openId): User
    {
        return $this->queryUserInfo('', $openId);
    }

    /**
     * 查询会员信息接口   5
     * @param mixed $phone 手机号
     * @param string $openId openId，手机号和openId 不能同时为空，手机号为空时请传空串
     * @return User
     * @throws ApiException|InvalidArgumentException
     */
    public function queryUserInfo($phone = '', $openId = ''): User
    {
        if (empty($phone) && empty($openId)) {
            throw new InvalidArgumentException('phone和openId 不能同时为空');
        }
        //phone +"|"+ mchntCd +"|" + salt 做 MD5 加密。
        $sign = $this->sign2($phone);

        return new User(
            $this->app,
            $this->request(
                '/api/queryUserInfo.action',
                [
                    'phone' => $phone,
                    'openId' => $openId,
                ],
                $sign
            )['data']
        );
    }

    /**
     * 查询商户所有卡 6
     * @return mixed
     * @throws ApiException
     */
    public function queryAllCards(): array
    {
        return $this->request('/api/queryAllCards.action');
    }

    /**
     * 通过手机号查询用户优惠券列表
     * @param $phone
     * @param string $couponState
     * @param string $useState
     * @param string $sortType
     * @return array
     * @throws ApiException
     * @throws InvalidArgumentException
     */
    public function queryUserCouponsByPhone(
        $phone,
        string $couponState = '',
        string $useState = '',
        string $sortType = ''
    ): array {
        return $this->queryUserCoupons($phone, $couponState, $useState, $sortType);
    }

    /**
     * 通过openid查询用户优惠券列表
     * @param string $openId
     * @param string $couponState
     * @param string $useState
     * @param string $sortType
     * @return array
     * @throws ApiException
     * @throws InvalidArgumentException
     */
    public function queryUserCouponsByOpenId(
        string $openId,
        string $couponState = '',
        string $useState = '',
        string $sortType = ''
    ): array {
        return $this->queryUserCoupons($openId, $couponState, $useState, $sortType);
    }

    /**
     * 查询用户优惠券列表  7
     * @param $phone 手机号
     * @param string $openId 用户 openId openId 和手机号不能同时为空，手机号为空时请传空串，
     * @param string $couponState 优惠券状态, 00：正常,01：过期,02：作废,03：未生效, 04:已转赠
     * @param string $useState 使用状态, 00：未使用,01：已使用,02：冻结中
     * @param string $sortType 排序方式 00：根据过期时间倒序 01：根据新增时间倒序 默认 00
     * @return mixed
     * @throws ApiException|InvalidArgumentException
     */
    private function queryUserCoupons(
        $phone = '',
        string $openId = '',
        string $couponState = '',
        string $useState = '',
        string $sortType = ''
    ): array {
        if (empty($phone) && empty($openId)) {
            throw new InvalidArgumentException('openId和手机号不能同时为空');
        }
        //phone +"|"+ mchntCd +"|" + salt 做 MD5 加密。
        return $this->request(
            '/api/queryUserCoupons.action',
            [
                'phone' => $phone,
                'openId' => $openId,
                'couponState' => $couponState,
                'useState' => $useState,
                'sortType' => $sortType,
            ],
            $this->sign2($phone)
        )['data'];
    }

    /**
     * 通过手机号和用户优惠劵ID查询用户优惠券详情
     * @param int $phone
     * @param $userCouponId
     * @return array
     * @throws ApiException
     */
    public function queryUserCouponDetailByPhone(int $phone, $userCouponId): array
    {
        return $this->queryUserCouponDetail($phone, '', $userCouponId);
    }

    /**
     * 通过openid和用户优惠劵ID查询用户优惠券详情
     * @param string $openId
     * @param $userCouponId
     * @return array
     * @throws ApiException
     */
    public function queryUserCouponDetailByOpenId(string $openId, $userCouponId): array
    {
        return $this->queryUserCouponDetail('', $openId, $userCouponId);
    }

    /**
     * 查询用户优惠券详情 8
     * @param mixed $phone 手机号
     * @param string $openId 用户 openId，openId 16 和手机号不能同时为空，手机号为空时请传空串
     * @param mixed $userCouponId 用户优惠券 ID
     * @return mixed
     * @throws ApiException
     */
    private function queryUserCouponDetail($phone, string $openId, $userCouponId): array
    {
        //phone +"|"+ mchntCd +"|"+userCouponId +"|"+ salt 做 MD5
        $key = $this->sign([$phone, $this->getMchntCd(), $userCouponId, $this->config['salt']]);
        return $this->request(
            '/api/queryUserCouponDetail.action',
            [
                'phone' => $phone,
                'openId' => $openId,
                'userCouponId' => $userCouponId,
            ],
            $key
        )['data'];
    }

    /**
     * 通过手机号核销用户优惠券
     * @param int $phone 手机号
     * @param int $userCouponId 用户优惠券 ID
     * @param int $disAmt 抵扣金额,单位：分
     * @param int $shopId 消费门店编号
     * @param string $termId 富友终端号
     * @throws ApiException
     * @throws InvalidArgumentException
     */
    public function consumeUserCouponByPhone(
        int $phone,
        int $userCouponId,
        int $disAmt,
        int $shopId,
        string $termId
    ) {
        $this->consumeUserCoupon($userCouponId, $disAmt, $shopId, $termId, $phone);
    }

    /**
     * 通过手机号核销用户优惠券
     * @param string $openId 手机号
     * @param int $userCouponId 用户优惠券 ID
     * @param int $disAmt 抵扣金额,单位：分
     * @param int $shopId 消费门店编号
     * @param string $termId 富友终端号
     * @throws ApiException
     * @throws InvalidArgumentException
     */
    public function consumeUserCouponByOpenId(
        string $openId,
        int $userCouponId,
        int $disAmt,
        int $shopId,
        string $termId
    ) {
        $this->consumeUserCoupon($userCouponId, $disAmt, $shopId, $termId, '', $openId);
    }

    /**
     * 核销用户优惠券 9
     * @param int $userCouponId 用户优惠券 ID
     * @param int $disAmt 抵扣金额,单位：分
     * @param int $shopId 消费门店编号
     * @param string $termId 富友终端号
     * @param mixed $phone 手机号
     * @param string $openId 用户 openId，openId和手机号不能同时为空，手机号为空时请传空串
     * @return void
     * @throws ApiException|InvalidArgumentException
     */
    private function consumeUserCoupon(
        int $userCouponId,
        int $disAmt,
        int $shopId,
        string $termId,
        $phone = '',
        string $openId = ''
    ) {
        if (empty($phone) && empty($openId)) {
            throw new InvalidArgumentException('openId和手机号不能同时为空');
        }
        //phone +"|"+ mchntCd +"|" +userCouponId +"|"+ disAmt +"|"+ shopId +"|"+ termId +"|"+ salt 做 MD5 加密。
        $key = $this->sign(
            [$phone, $this->config['mchnt_cd'], $userCouponId, $disAmt, $shopId, $termId, $this->config['salt']]
        );
        $this->request(
            '/api/consumeUserCoupon.action',
            [
                'phone' => $phone,
                'userCouponId' => $userCouponId,
                'disAmt' => $disAmt,
                'shopId' => $shopId,
                'termId' => $termId,
                'openId' => $openId,
            ],
            $key
        );
    }

    /**
     * 通过手机号作废用户优惠券
     * @param int $phone
     * @param string $userCouponId
     * @param string $couponId
     * @return void
     * @throws ApiException|InvalidArgumentException
     */
    public function invalidUserCouponByPhone(int $phone, string $userCouponId, string $couponId)
    {
        $this->invalidUserCoupon($userCouponId, $couponId, $phone);
    }

    /**
     * 通过openId作废用户优惠券
     * @param string $openId
     * @param string $userCouponId
     * @param string $couponId
     * @return void
     * @throws ApiException|InvalidArgumentException
     */
    public function invalidUserCouponByOpenId(string $openId, string $userCouponId, string $couponId)
    {
        $this->invalidUserCoupon($userCouponId, $couponId, '', $openId);
    }

    /**
     * 作废用户优惠券 10
     * @param string $userCouponId 用户优惠券 ID
     * @param string $couponId 优惠券模板 ID
     * @param mixed $phone 手机号
     * @param string $openId 用户 openId，openId和手机号不能同时为空，手机号为空时请传空串
     * @return void
     * @throws ApiException|InvalidArgumentException
     */
    private function invalidUserCoupon(
        string $userCouponId,
        string $couponId,
        $phone = '',
        string $openId = ''
    ) {
        if (empty($phone) && empty($openId)) {
            throw new InvalidArgumentException('openId和手机号不能同时为空');
        }
        //phone +"|"+ mchntCd +"|" +userCouponId +"|"+ couponId+"|"+ salt 做 MD5 加密。
        $sign = $this->sign(
            [$phone, $this->config['mchnt_cd'], $userCouponId, $couponId, $this->config['salt']]
        );
        $this->request(
            '/api/invalidUserCoupon.action',
            [
                'phone' => $phone,
                'userCouponId' => $userCouponId,
                'couponId' => $couponId,
                'openId' => $openId,
            ],
            $sign
        );
    }


    /**
     * 新增会员接口 11
     * @param int $shopId 门店 Id
     * @param int $phone 手机号
     * @param string $pwd 6-16 位纯数字账户密码明文，当不填是请传空串
     * @param string $offlineCardNo 不能为11 位和17 位，不能小于6 大于 50 线下实体卡号（线下实体卡号和手机号二选一，必须至少填写一个）
     * @param string $userName 用户姓名
     * @param int $sex 性别 男：1 女：2 用户未填写：0
     * @param string $userBirth 用户生日示例：2020-05-25
     * @param string $openId 微信 openId
     * @param mixed $aliUserId 支付宝 userId，2088开头的 16 位纯数字
     * @param string $addInf1 商户新增备用字段用户填写值 1
     * @param string $addInf2 商户新增备用字段用户填写值 2
     * @return mixed
     * @throws ApiException
     */
    public function registerUserApi(
        int $shopId,
        int $phone,
        string $openId = '',
        string $pwd = '',
        string $offlineCardNo = '',
        string $userName = '',
        int $sex = 0,
        string $userBirth = '',
        $aliUserId = '',
        string $addInf1 = '',
        string $addInf2 = ''
    ) {
//       mchntCd +"|"+ pwd+"|" +phone+"|"+ offlineCardNo+"|"+ salt做 MD5 加密。
        return $this->request(
            '/api/registerUserApi.action',
            [
                'pwd' => $pwd,
                'phone' => $phone,
                'offlineCardNo' => $offlineCardNo,
                'userName' => $userName,
                'sex' => $sex,
                'userBirth' => $userBirth,
                'shopId' => $shopId,
                'openId' => $openId,
                'aliUserId' => $aliUserId,
                'addInf1' => $addInf1,
                'addInf2' => $addInf2,
            ],
            [$pwd, $phone, $offlineCardNo]
        );
    }


    /**
     * 会员列表分页拉取接口 12
     * @param int $shopId 门店 Id，若不填，请传空字符串
     * @param int $pageNum 当前页码,不填默认 1
     * @param int $pageSize 每页条数,不填默认 20
     * @return mixed
     * @throws ApiException
     */
    public function queryMemPageListApi($shopId = '', int $pageNum = 1, int $pageSize = 20): array
    {
        //当 shopId 不为空时：mchntCd +"|"+ shopId+"|" + salt 做 MD5 加密。当 shopId 为空时：mchntCd +"|"+"" +"|" + salt 做 MD5 加密。
        return $this->request(
            '/memApi/queryMemPageListApi.action',
            [
                'shopId' => $shopId,
                'pageNum' => $pageNum,
                'pageSize' => $pageSize,
            ],
            [$shopId]
        );
    }


    /**
     * 会员等级及经验值设置接口 13
     * mchntCd+"|"+openId+"|"+levelValue+"|"+experience+"|"+salt做 MD5 加密。
     * @param string $openId openId
     * @param string $levelValue 等级值
     * @param string $experience 经验值
     * @return void
     * @throws ApiException
     */
    public function setMemLevelAndExperienceApi(string $openId, string $levelValue, string $experience)
    {
        $this->request(
            '/memApi/setMemLevelAndExperienceApi.action',
            [
                'openId' => $openId,
                'levelValue' => $levelValue,
                'experience' => $experience,
            ],
            [$openId, $levelValue, $experience]
        );
    }

    /**
     * 通过手机号批量发券
     * @param int $couponId
     * @param array $phones
     * @return array
     * @throws ApiException
     */
    public function sendCouponToPhone(int $couponId, array $phones): array
    {
        return $this->sendCoupon($couponId, '00', $phones);
    }

    /**
     * 通过OpenId批量发券
     * @param int $couponId
     * @param array $openIds
     * @return array
     * @throws ApiException
     */
    public function sendCouponToOpenId(int $couponId, array $openIds): array
    {
        return $this->sendCoupon($couponId, '01', $openIds);
    }

    /**
     * 通过实体卡号批量发券
     * @param int $couponId
     * @param array $cards
     * @return array
     * @throws ApiException
     */
    public function sendCouponToCard(int $couponId, array $cards): array
    {
        return $this->sendCoupon($couponId, '02', $cards);
    }

    /**
     * 批量发券接口  14
     * @param int $couponId 优惠券模板 ID
     * @param string $sendObjType 发放对象类型：00:手机号; 01:openId; 02:实体卡号
     * @param array $sendObjListJson 发放对象列表：传入多个手机号 &openid&实体卡号，三选一 上限 500 条
     * @return mixed
     * @throws ApiException
     */
    protected function sendCoupon(int $couponId, string $sendObjType, array $sendObjListJson): array
    {
        //mchntCd +"|" +couponId +"|" +sendObjType+"|"+ salt 做 MD5加密。
        $response = $this->request(
            '/api/sendCoupon.action',
            [
                'couponId' => $couponId,
                'sendObjType' => $sendObjType,
                'sendObjListJson' => json_encode($sendObjListJson),
            ],
            [$couponId, $sendObjType]
        );
        return $response['data'];
    }

    /**
     * 分页查询商户可用优惠券列表接口 15
     * @param int $pageNum 当前页码，不填默认 1
     * @param int $pageSize 每页条数，不填默认 20
     * @return array
     * @throws ApiException
     */
    public function queryMchntCouponListPage(int $pageNum = 1, int $pageSize = 20): array
    {
        return $this->request(
            '/api/queryMchntCouponListPage.action',
            [
                'pageNum' => $pageNum,
                'pageSize' => $pageSize,
            ]
        );
    }

    /**
     * 充值 16
     * @param string $openId 用户微信openId
     * @param string $shopId 门店 id
     * @param string $chargeAmt 充值金额（元）
     * @param string $freeAmt 赠送金额元），没有则传空串
     * @return array
     * @throws ApiException
     */
    public function recharge(string $openId, string $shopId, string $chargeAmt, string $freeAmt): array
    {
        //mchntCd+"|"+openId+"|"+shopId+"|"+chargeAmt+"|"+freeAmt+ "|"+salt 做 MD5 加密。
        return $this->request(
            '/api/recharge.action',
            [
                'openId' => $openId,
                'shopId' => $shopId,
                'chargeAmt' => $chargeAmt,
                'freeAmt' => $freeAmt,
            ],
            [$openId, $shopId, $chargeAmt, $freeAmt]
        );
    }


    /**
     * 余额消费 17
     * @param string $openId 用户微信openId
     * @param string $termId 消费终端号
     * @param string $chargeAmt 消费金额（元
     * @return array
     * @throws ApiException
     */
    public function consume(string $openId, string $termId, string $chargeAmt): array
    {
        //mchntCd+"|"+openId+"|"+termId+"|"+consumeAmt+"|"+salt 做 MD5加密。
        return $this->request(
            '/api/consume.action',
            [
                'openId' => $openId,
                'termId' => $termId,
                'consumeAmt' => $chargeAmt
            ],
            [$openId, $termId, $chargeAmt]
        );
    }

    /**
     * @param string $action
     * @param array $params
     * @param $signParams
     * @return array
     * @throws ApiException
     */
    protected function request(string $action, array $params = [], $signParams = []): array
    {
        $params['mchntCd'] = $this->getMchntCd();
        if (is_array($signParams)) {
            $params['key'] = $this->sign1($signParams);
        } else {
            $params['key'] = $signParams;
        }

        $response = $this->curl($this->getApiHost() . $action, $params);
        if (empty($response)) {
            throw new ApiException('无数据返回');
        }

        $responseCode = $response['resultCode'] ?? $response['respCode'];
        if (!$responseCode) {
            throw new ApiException('无数据返回');
        } elseif ($responseCode != '000000') {
            throw new ApiException($response['resultMsg'] ?? $response['respDesc'], (int)$responseCode);
        }

        return $response;
    }

    /**
     * 签名方式1
     * @param array $array
     * @return string
     */
    protected function sign1(array $array = []): string
    {
        array_unshift($array, $this->config['mchnt_cd']);
        array_push($array, $this->config['salt']);

        return $this->sign($array);
    }

    /**
     * 签名方式2
     * @param $phone
     * @return string
     */
    protected function sign2($phone = ''): string
    {
        $array = [
            $phone,
            $this->getMchntCd(),
            $this->config['salt']
        ];

        return $this->sign($array);
    }

    /**
     * 签名
     * @param array $signArray
     * @return string
     */
    private function sign(array $signArray): string
    {
        $signString = implode('|', $signArray);
        return md5($signString);
    }

    private function getApiHost(): string
    {
        return $this->test === false ? 'https://sp-ht.fuioupay.com' : 'https://spht-test.fuioupay.com';
    }
}