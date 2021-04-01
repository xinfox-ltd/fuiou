<?php

/**
 * [XinFox System] Copyright (c) 2011 - 2021 XINFOX.CN
 */
declare(strict_types=1);

namespace XinFox\Fuiou\Api;

use XinFox\Fuiou\Exceptions\ApiException;
use XinFox\Fuiou\Model\Adjust;
use XinFox\Fuiou\Model\Consume;
use XinFox\Fuiou\Model\EditPoint;
use XinFox\Fuiou\Model\QueryAllCards;
use XinFox\Fuiou\Model\QueryBalance;
use XinFox\Fuiou\Model\QueryMchntCouponListPage;
use XinFox\Fuiou\Model\QueryMemPageListApi;
use XinFox\Fuiou\Model\QueryPoint;
use XinFox\Fuiou\Model\QueryUserCouponDetail;
use XinFox\Fuiou\Model\QueryUserCoupons;
use XinFox\Fuiou\Model\QueryUserInfo;
use XinFox\Fuiou\Model\Recharge;
use XinFox\Fuiou\Model\SendCoupon;

/**
 * 上海富有支付--CRM接口
 * Class Crm
 * @package XinFox\Fuiou\Api
 */
class Crm extends Api
{


    /**
     * 调账接口 1
     * @param string $adjustAmt 调账金额（分），最大10 万元
     * @param string $operator 操作人
     * @param string|null $phone 手机号
     * @param string|null $cardNo 实体卡号，纯数字
     * @param string|null $adjustPwd 调账密码明文
     * @param string|null $adjustType 调账类型：01 主账户；02 子账户，默认为01
     * @param string|null $cardId 卡 ID，为空则对默认卡进行调账
     * @param string|null $openId 用户 openId，手机号和 openId 不能同时为空，当手机号为空时请传空串
     * @return mixed
     * @throws ApiException
     */
    public function adjust(
        string $adjustAmt,
        string $operator,
        string $phone = '',
        string $cardNo = '',
        string $adjustPwd = '',
        string $adjustType = '',
        string $cardId = '',
        string $openId = ''
    ): Adjust {

//        mchntCd+"|"+phone+"|"+cardNo+"|"+adjustPwd+"|"+adjustAmt +"|"+salt 做 MD5 加密。
//        salt: 请向富友运营申请秘钥
        $key = md5($this->config['mchnt_cd'] . "|" . $phone . "|" . $cardNo . "|" . $adjustPwd . "|" . $adjustAmt . "|" . $this->config['salt']);
        $options = array(
            'mchntCd' => $this->config['mchnt_cd'],
            'phone' => $phone,
            'cardNo' => $cardNo,
            'adjustAmt' => $adjustAmt,
            'adjustPwd' => $adjustPwd,
            'operator' => $operator,
            'key' => $key,
            'adjustType' => $adjustType,
            'cardId' => $cardId,
            'openId' => $openId
        );
        $response = json_decode($this->getHttpResponseJSON($this->uri . 'adjust.action', $options), true);
        if ($response['resultCode'] != '000000') {
            throw new ApiException($response['resultMsg'], $response['resultCode']);
        }
        return new Adjust($response);
    }

    /** 余额查询接口 2
     * @param string $phone 手机号
     * @param string $cardId 卡 ID，为空则查询默认卡余额
     * @param string $openId 用户 openId，手机号和 openId 不能同时为空，当手机号为空时请传空串
     * @return QueryBalance[]
     * @throws ApiException
     */
    public function queryBalance(string $phone, string $cardId, string $openId): QueryBalance
    {

        //phone +"|"+ mchntCd +"|"+salt 做 MD5 加密。
        //salt= 请向富友运营申请秘钥
        $key = md5($phone . "|" . $this->config['mchnt_cd'] . "|" . $this->config['salt']);
        $options = array(
            'mchntCd' => $this->config['mchnt_cd'],
            'phone' => $phone,
            'key' => $key,
            'cardId' => $cardId,
            'openId' => $openId,
        );
        $response = json_decode($this->getHttpResponseJSON($this->uri . 'queryBalance.action', $options), true);
        if ($response['resultCode'] != '000000') {
            throw new ApiException($response['resultMsg'], $response['resultCode']);
        }
        return new QueryBalance($response);
    }

    /**
     *  积分查询接口  3
     * @param string $phone 手机号
     * @param string $openId 用户 openId，手机号和 openId 不能同时为空，当手机号为空时请传空串
     * @return mixed
     * @throws ApiException
     */
    public function queryPoint(string $phone, string $openId): QueryPoint
    {
        //签名示例：
        //phone +"|"+ mchntCd +"|"+salt 做 MD5 加密。
        //salt: 请向富友运营申请秘钥
        $key = md5($phone . "|" . $this->config['mchnt_cd'] . "|" . $this->config['salt']);
        $options = array(
            'mchntCd' => $this->config['mchnt_cd'],
            'phone' => $phone,
            'openId' => $openId,
            'key' => $key
        );
        $response = json_decode($this->getHttpResponseJSON($this->uri . 'queryPoint.action', $options), true);
        if ($response['resultCode'] != '000000') {
            throw new ApiException($response['resultMsg'], $response['resultCode']);
        }
        return new QueryPoint($response);
    }

    /**
     * 修改积分接口   4
     * @param string $point 要修改的积分数
     * @param string $oldPoint 原积分数
     * @param string $operator 操作人
     * @param string $phone 手机号
     * @param string $openId 用户 openId，手机号和 openId 不能同时为空，当手机号为空时请传空串
     * @return mixed
     * @throws ApiException
     */
    public function editPoint(
        string $point,
        string $oldPoint,
        string $operator,
        string $phone,
        string $openId
    ): EditPoint {

        //phone +"|"+ mchntCd +"|" + oldPoint + "|" + point + "|" + salt 做 MD5 加密。
        $key = md5($phone . "|" . $this->config['mchnt_cd'] . "|" . $oldPoint . "|" . $point . "|" . $this->config['salt']);
        $options = array(
            'mchntCd' => $this->config['mchnt_cd'],
            'phone' => $phone,
            'point' => $point,
            'oldPoint' => $oldPoint,
            'operator' => $operator,
            'openId' => $openId,
            'key' => $key
        );
        $response = json_decode($this->getHttpResponseJSON($this->uri . 'editPoint.action', $options), true);
        if ($response['resultCode'] != '000000') {
            throw new ApiException($response['resultMsg'], $response['resultCode']);
        }
        return new EditPoint($response);
    }

    /**
     * 查询会员信息接口   5
     * @param string $phone 手机号
     * @param string $openId openId，手机号和openId 不能同时为空，手机号为空时请传空串
     * @return mixed
     * @throws ApiException
     */
    public function queryUserInfo(string $phone, string $openId): array
    {
        //phone +"|"+ mchntCd +"|" + salt 做 MD5 加密。
        $key = md5($phone . "|" . $this->config['mchnt_cd'] . "|" . $this->config['salt']);
        $options = array(
            'mchntCd' => $this->config['mchnt_cd'],
            'phone' => $phone,
            'openId' => $openId,
            'key' => $key
        );
        $response = json_decode($this->getHttpResponseJSON($this->uri . 'queryUserInfo.action', $options), true);
        if ($response['resultCode'] != '000000') {
            throw new ApiException($response['resultMsg'], $response['resultCode']);
        } else {
            $data = new QueryUserInfo($response['data']);
            return $data;
        }
    }

    /**
     * 查询商户所有卡 6
     * @return mixed
     * @throws ApiException
     */
    public function queryAllCards(): array
    {
        //mchntCd +"|" + salt 做 MD5 加密。
        $key = md5($this->config['mchnt_cd'] . "|" . $this->config['salt']);
        $options = array(
            'mchntCd' => $this->config['mchnt_cd'],
            'key' => $key
        );
        $response = json_decode($this->getHttpResponseJSON($this->uri . 'queryAllCards.action', $options), true);
        if ($response['resultCode'] != '000000') {
            throw new ApiException($response['resultMsg'], $response['resultCode']);
        } else {
            $data = [];
            foreach ($response['data'] as $row) {
                $data[] = new QueryAllCards($row);
            }
            return $data;
        }
    }

    /**
     * 查询用户优惠券列表  7
     * @param string $phone 手机号
     * @param string $openId 用户 openId openId 和手机号不能同时为空，手机号为空时请传空串，
     * @param string $couponState 优惠券状态, 00：正常,01：过期,02：作废,03：未生效, 04:已转赠
     * @param string $useState 使用状态, 00：未使用,01：已使用,02：冻结中
     * @param string $sortType 排序方式 00：根据过期时间倒序 01：根据新增时间倒序 默认 00
     * @return mixed
     * @throws ApiException
     */
    public function queryUserCoupons(
        string $phone,
        string $openId,
        string $couponState = '',
        string $useState = '',
        string $sortType = ''
    ): array {
        //phone +"|"+ mchntCd +"|" + salt 做 MD5 加密。
        $key = md5($phone . "|" . $this->config['mchnt_cd'] . "|" . $this->config['salt']);
        $options = array(
            'mchntCd' => $this->config['mchnt_cd'],
            'phone' => $phone,
            'openId' => $openId,
            'couponState' => $couponState,
            'useState' => $useState,
            'sortType' => $sortType,
            'key' => $key
        );
        $response = json_decode($this->getHttpResponseJSON($this->uri . 'queryUserCoupons.action', $options), true);
        if ($response['resultCode'] != '000000') {
            throw new ApiException($response['resultMsg'], $response['resultCode']);
        } else {
            $data = [];
            foreach ($response['data'] as $row) {
                $data[] = new QueryUserCoupons($row);
            }
            return $data;
        }
    }

    /**
     * 查询用户优惠券详情 8
     * @param string $phone 手机号
     * @param string $openId 用户 openId，openId 16 和手机号不能同时为空，手机号为空时请传空串
     * @param string $userCouponId 用户优惠券 ID
     * @return mixed
     * @throws ApiException
     */
    public function queryUserCouponDetail(string $phone, string $openId, string $userCouponId): array
    {
        //phone +"|"+ mchntCd +"|"+userCouponId +"|"+ salt 做 MD5
        $key = md5($phone . "|" . $this->config['mchnt_cd'] . "|" . $userCouponId . "|" . $this->config['salt']);
        $options = array(
            'mchntCd' => $this->config['mchnt_cd'],
            'phone' => $phone,
            'openId' => $openId,
            'userCouponId' => $userCouponId,
            'key' => $key
        );
        $response = json_decode($this->getHttpResponseJSON($this->uri . 'queryUserCouponDetail.action', $options),
            true);
        if ($response['resultCode'] != '000000') {
            throw new ApiException($response['resultMsg'], $response['resultCode']);
        } else {
            $data = new QueryUserCouponDetail($response['data']);
            return $data;
        }
    }

    /**
     * 核销用户优惠券 9
     * @param string $userCouponId 用户优惠券 ID
     * @param string $disAmt 抵扣金额,单位：分
     * @param string $shopId 消费门店编号
     * @param string $termId 富友终端号
     * @param string $phone 手机号
     * @param string $openId 用户 openId，openId和手机号不能同时为空，手机号为空时请传空串
     * @return mixed
     * @throws ApiException
     */
    public function consumeUserCoupon(
        string $userCouponId,
        string $disAmt,
        string $shopId,
        string $termId,
        string $phone,
        string $openId
    ) {
        //phone +"|"+ mchntCd +"|" +userCouponId +"|"+ disAmt +"|"+ shopId +"|"+ termId +"|"+ salt 做 MD5 加密。
        $key = md5($phone . "|" . $this->config['mchnt_cd'] . "|" . $userCouponId . "|" . $disAmt . "|" . $shopId . "|" . $termId . "|" . $this->config['salt']);
        $options = array(
            'mchntCd' => $this->config['mchnt_cd'],
            'phone' => $phone,
            'userCouponId' => $userCouponId,
            'disAmt' => $disAmt,
            'shopId' => $shopId,
            'termId' => $termId,
            'openId' => $openId,
            'key' => $key
        );
        $response = json_decode($this->getHttpResponseJSON($this->uri . 'consumeUserCoupon.action', $options), true);
        if ($response['resultCode'] != '000000') {
            throw new ApiException($response['resultMsg'], $response['resultCode']);
        }
        return $response;
    }

    /**
     * 作废用户优惠券 10
     * @param string $userCouponId 用户优惠券 ID
     * @param string $couponId 优惠券模板 ID
     * @param string $phone 手机号
     * @param string $openId 用户 openId，openId和手机号不能同时为空，手机号为空时请传空串
     * @return mixed
     * @throws ApiException
     */
    public function invalidUserCoupon(
        string $userCouponId,
        string $couponId,
        string $phone,
        string $openId
    ) {
        //phone +"|"+ mchntCd +"|" +userCouponId +"|"+ couponId+"|"+ salt 做 MD5 加密。
        $key = md5($phone . "|" . $this->config['mchnt_cd'] . "|" . $userCouponId . "|" . $couponId . "|" . $this->config['salt']);
        $options = array(
            'mchntCd' => $this->config['mchnt_cd'],
            'phone' => $phone,
            'userCouponId' => $userCouponId,
            'couponId' => $couponId,
            'openId' => $openId,
            'key' => $key
        );
        $response = json_decode($this->getHttpResponseJSON($this->uri . 'invalidUserCoupon.action', $options), true);
        if ($response['resultCode'] != '000000') {
            throw new ApiException($response['resultMsg'], $response['resultCode']);
        }
        return $response;
    }


    /**
     * 新增会员接口 11
     * @param string $pwd 6-16 位纯数字账户密码明文，当不填是请传空串
     * @param string $phone 手机号
     * @param string $offlineCardNo 不能为11 位和17 位，不能小于6 大于 50 线下实体卡号（线下实体卡号和手机号二选一，必须至少填写一个）
     * @param string $userName 用户姓名
     * @param string $sex 性别 男：1 女：2 用户未填写：0
     * @param string $userBirth 用户生日示例：2020-05-25
     * @param string $shopId 门店 Id
     * @param string $openId 微信 openId
     * @param string $aliUserId 支付宝 userId，2088开头的 16 位纯数字
     * @param string $addInf1 商户新增备用字段用户填写值 1
     * @param string $addInf2 商户新增备用字段用户填写值 2
     * @return mixed
     * @throws ApiException
     */
    public function registerUserApi(
        string $pwd,
        string $phone,
        string $offlineCardNo,
        string $userName,
        string $sex,
        string $userBirth,
        string $shopId,
        string $openId,
        string $aliUserId,
        string $addInf1,
        string $addInf2
    ) {
//       mchntCd +"|"+ pwd+"|" +phone+"|"+ offlineCardNo+"|"+ salt做 MD5 加密。
        $key = md5($this->config['mchnt_cd'] . "|" . $pwd . "|" . $phone . "|" . $offlineCardNo . "|" . $this->config['salt']);
        $options = array(
            'mchntCd' => $this->config['mchnt_cd'],
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
            'key' => $key
        );
        $response = json_decode($this->getHttpResponseJSON($this->uri . 'registerUserApi.action', $options), true);
        if ($response['resultCode'] != '000000') {
            throw new ApiException($response['resultMsg'], $response['resultCode']);
        }
        return $response;
    }


    /**
     * 会员列表分页拉取接口 12
     * @param string $shopId 门店 Id，若不填，请传空字符串
     * @param int $pageNum 当前页码,不填默认 1
     * @param int $pageSize 每页条数,不填默认 20
     * @return mixed
     * @throws ApiException
     */
    public function queryMemPageListApi(string $shopId = '', int $pageNum = 1, int $pageSize = 20): array
    {
        //当 shopId 不为空时：mchntCd +"|"+ shopId+"|" + salt 做 MD5 加密。当 shopId 为空时：mchntCd +"|"+"" +"|" + salt 做 MD5 加密。
        $key = md5($this->config['mchnt_cd'] . "|" . $shopId . "|" . $this->config['salt']);
        $options = array(
            'mchntCd' => $this->config['mchnt_cd'],
            'shopId' => $shopId,
            'pageNum' => $pageNum,
            'pageSize' => $pageSize,
            'key' => $key
        );
        $response = json_decode($this->getHttpResponseJSON($this->uri . 'queryMemPageListApi.action', $options),
            true);
        if (!isset($response['resultCode'])) {
            return [];
        } elseif ($response['resultCode'] != '000000') {
            throw new ApiException($response['resultMsg'], $response['resultCode']);
        } else {
            $data = [];
            foreach ($response['data'] as $row) {
                $data[] = new QueryMemPageListApi($row);
            }
            return $data;
        }
    }


    /**
     * 会员等级及经验值设置接口 13
     * @param string $openId openId
     * @param string $levelValue 等级值
     * @param string $experience 经验值
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws ApiException
     */
    public function setMemLevelAndExperienceApi(string $openId, string $levelValue, string $experience)
    {
        //mchntCd+"|"+openId+"|"+levelValue+"|"+experience+"|"+salt做 MD5 加密。
        $key = md5($this->config['mchnt_cd'] . "|" . $openId . "|" . $levelValue . "|" . $experience . "|" . $this->config['salt']);
        $options = array(
            'mchntCd' => $this->config['mchnt_cd'],
            'openId' => $openId,
            'levelValue' => $levelValue,
            'experience' => $experience,
            'key' => $key
        );
        $response = json_decode($this->getHttpResponseJSON($this->uri . 'setMemLevelAndExperienceApi.action', $options),
            true);
        if ($response['resultCode'] != '000000') {
            throw new ApiException($response['resultMsg'], $response['resultCode']);
        }
        return $response;
    }

    /**
     * 批量发券接口  14
     * @param string $couponId 优惠券模板 ID
     * @param string $sendObjType 发放对象类型：00:手机号; 01:openId; 02:实体卡号
     * @param string $sendObjListJson 发放对象列表 JSON：传入多个手机号 &openid&实体卡号，三选一 上限 500 条
     * @return mixed
     * @throws ApiException
     */
    public function sendCoupon(string $couponId, string $sendObjType, string $sendObjListJson): array
    {
        //mchntCd +"|" +couponId +"|" +sendObjType+"|"+ salt 做 MD5加密。
        $key = md5($this->config['mchnt_cd'] . "|" . $couponId . "|" . $sendObjType . "|" . $this->config['salt']);
        $options = array(
            'mchntCd' => $this->config['mchnt_cd'],
            'couponId' => $couponId,
            'sendObjType' => $sendObjType,
            'sendObjListJson' => $sendObjListJson,
            'key' => $key
        );
        $response = json_decode($this->getHttpResponseJSON($this->uri . 'sendCoupon.action', $options),
            true);
        if (!isset($response['resultCode'])) {
            return [];
        } elseif ($response['resultCode'] != '000000') {
            throw new ApiException($response['resultMsg'], $response['resultCode']);
        } else {
            $data = new SendCoupon($response['data']);
            return $data;
        }
    }

    /**
     * 分页查询商户可用优惠券列表接口 15
     * @param int $pageNum 当前页码，不填默认 1
     * @param int $pageSize 每页条数，不填默认 20
     * @return mixed
     * @throws ApiException
     */
    public function queryMchntCouponListPage(int $pageNum = 1, int $pageSize = 20): array
    {
        $key = md5($this->config['mchnt_cd'] . "|" . $this->config['salt']);
        $options = array(
            'mchntCd' => $this->config['mchnt_cd'],
            'pageNum' => $pageNum,
            'pageSize' => $pageSize,
            'key' => $key
        );
        $response = json_decode($this->getHttpResponseJSON($this->uri . 'queryMchntCouponListPage.action', $options),
            true);
        $respCode = isset($response['respCode']) ? $response['respCode'] : null;
        $resultMsg = isset($response['resultMsg']) ? $response['resultMsg'] : null;
        $pageNum = isset($response['pageNum']) ? $response['pageNum'] : null;
        $pageSize = isset($response['pageSize']) ? $response['pageSize'] : null;
        $totalCount = isset($response['totalCount']) ? $response['totalCount'] : null;
        $totalPages = isset($response['totalPages']) ? $response['totalPages'] : null;
        if ($respCode != '000000') {
            throw new ApiException($response['resultMsg'], $response['resultCode']);
        } else {
            $data = [];
            foreach ($response['data'] as $row) {
                $data[] = new QueryMchntCouponListPage($row);
            }
            return array(
                'resultCode' => $respCode,
                'resultMsg' => $resultMsg,
                'pageNum' => $pageNum,
                'pageSize' => $pageSize,
                'totalCount' => $totalCount,
                'totalPages' => $totalPages,
                'data' => $data
            );
        }
    }


    /**
     * 充值 16
     * @param string $openId 用户微信openId
     * @param string $shopId 门店 id
     * @param string $chargeAmt 充值金额（元）
     * @param string $freeAmt 赠送金额元），没有则传空串
     * @return mixed
     * @throws ApiException
     */
    public function recharge(string $openId, string $shopId, string $chargeAmt, string $freeAmt): Recharge
    {
        //mchntCd+"|"+openId+"|"+shopId+"|"+chargeAmt+"|"+freeAmt+ "|"+salt 做 MD5 加密。
        $key = md5($this->config['mchnt_cd'] . "|" . $openId . "|" . $shopId . "|" . $chargeAmt . "|" . $freeAmt . "|" . $this->config['salt']);
        $options = array(
            'mchntCd' => $this->config['mchnt_cd'],
            'openId' => $openId,
            'shopId' => $shopId,
            'chargeAmt' => $chargeAmt,
            'freeAmt' => $freeAmt,
            'key' => $key
        );
        $response = json_decode($this->getHttpResponseJSON($this->uri . 'recharge.action', $options), true);
        if ($response['resultCode'] != '000000') {
            throw new ApiException($response['resultMsg'], $response['resultCode']);
        }
        return $response;

    }


    /**
     * 余额消费 17
     * @param string $openId 用户微信openId
     * @param string $termId 消费终端号
     * @param string $chargeAmt 消费金额（元
     * @return mixed
     * @throws ApiException
     */
    public function consume(string $openId, string $termId, string $chargeAmt): Consume
    {
        //mchntCd+"|"+openId+"|"+termId+"|"+consumeAmt+"|"+salt 做 MD5加密。
        $key = md5($this->config['mchnt_cd'] . "|" . $openId . "|" . $termId . "|" . $chargeAmt . "|" . $this->config['salt']);
        $options = array(
            'mchntCd' => $this->config['mchnt_cd'],
            'openId' => $openId,
            'termId' => $termId,
            'consumeAmt' => $chargeAmt,
            'key' => $key
        );
        $response = json_decode($this->getHttpResponseJSON($this->uri . 'consume.action', $options), true);
        if ($response['resultCode'] != '000000') {
            throw new ApiException($response['resultMsg'], $response['resultCode']);
        }
        return new Consume($response);
    }
}