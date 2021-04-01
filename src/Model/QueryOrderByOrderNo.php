<?php

declare(strict_types=1);

namespace XinFox\Fuiou\Model;

/**
 * Class QueryOrderByOrderNo
 * @package XinFox\Fuiou\Model
 */
class QueryOrderByOrderNo
{

    /**
     * @var int
     */
    private int $orderNo;

    /**
     * @var int
     */
    private int $userId;

    /**
     * @var int
     */
    private int $shopId;

    /**
     * @var string
     */
    private string $mchntCd;

    /**
     * @var string
     */
    private string $tmFuiouId;

    /**
     * @var string
     */
    private string $termName;

    /**
     * @var string
     */
    private string $orderType;

    /**
     * @var int
     */
    private int $orderAmt;

    /**
     * @var int
     */
    private int $orderDisAmt;

    /**
     * @var int
     */
    private int $payAmt;

    /**
     * @var int
     */
    private int $guestsCount;

    /**
     * @var string
     */
    private string $paySsn;

    /**
     * @var string
     */
    private  $userMemo;

    /**
     * @var string
     */
    private string $mealCode;

    /**
     * @var int
     */
    private int $expressAmt;

    /**
     * @var string
     */
    private string $expressState;

    /**
     * @var int
     */
    private int $couponId;

    /**
     * @var int
     */
    private int $couponRealId;

    /**
     * @var int
     */
    private int $couponAmt;

    /**
     * @var int
     */
    private int $integralDeductionAmt;

    /**
     * @var int
     */
    private int $integral;

    /**
     * @var int
     */
    private int $cashierDisAmt;

    /**
     * @var float
     */
    private float $cashierDiscount;

    /**
     * @var float
     */
    private float $cashReceivedAmt;

    /**
     * @var int
     */
    private int $singleGoodsDisAmt;

    /**
     * @var string
     */
    private string $discountType;

    /**
     * @var int
     */
    private int $crtTm;

    /**
     * @var int
     */
    private int $payTm;

    /**
     * @var int
     */
    private int $finshTm;

    /**
     * @var int
     */
    private int $recUpdTm;

    /**
     * @var int
     */
    private int $payDeadlineTm;

    /**
     * @var string
     */
    private string $finshDate;

    /**
     * @var string
     */
    private string $payType;

    /**
     * @var string
     */
    private string $orderState;

    /**
     * @var string
     */
    private string $orderCancelReason;

    /**
     * @var string
     */
    private string $cashierId;

    /**
     * @var int
     */
    private int $cashierConfirmTm;

    /**
     * @var
     */
    private  $shopInfo;

    /**
     * @var string
     */
    private string $channelType;

    /**
     * @var string
     */
    private string $phone;

    /**
     * @var string
     */
    private string $appOpenId;

    /**
     * @var string
     */
    private string $mchntEpressCost;

    /**
     * @var string
     */
    private string $delierTm;

    /**
     * @var string
     */
    private string $mqttSendState;

    /**
     * @var string
     */
    private string $tableTermName;

    /**
     * @var string
     */
    private string $isMembership;

    /**
     * @var string
     */
    private string $thirdOrderNo;

    /**
     * @var int
     */
    private int $platHongBao;

    /**
     * @var int
     */
    private int $thirdMchntIncom;

    /**
     * @var int
     */
    private int $memberPriceDisAmt;

    /**
     * @var int
     */
    private int $packagePriceDisAmt;

    /**
     * @var int
     */
    private int $refundTm;

    /**
     * @var int
     */
    private int $refundAmt;

    /**
     * @var int
     */
    private int $mealTm;

    /**
     * @var string
     */
    private string $orderPayState;

    /**
     * @var string
     */
    private string $crtTmString;

    /**
     * @var string
     */
    private string $payTmString;

    /**
     * @var string
     */
    private string $finshTmString;

    /**
     * @var string
     */
    private string $recUpdTmString;

    /**
     * @var string
     */
    private string $cashierConfirmTmString;


    /**
     * @var string
     */
    private string $deliverStartTmString;

    /**
     * @var string
     */
    private string $payDeadlineTmString;

    /**
     * @var bool
     */
    private bool $expressOrder;

    /**
     * @var bool
     */
    private bool $eatInOrder;

    /**
     * @var bool
     */
    private bool $couponDiscount;

    /**
     * @var bool
     */
    private bool $integralDiscount;

    /**
     * @var array
     */
    private array $orderAddressInfo;

    /**
     * @var array
     */
    private array $detailList;

    public function __construct(array $data)
    {
        foreach ($data as $key => $val) {
            if (property_exists($this, $key)) {
                echo $key . PHP_EOL;
                $this->$key = $val;
            }
        }
    }


    /**
     * @return string
     */
    public function getOrderNo()
    {
        return $this->orderNo;
    }


    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }


    /**
     * @return string
     */
    public function getShopId()
    {
        return $this->shopId;
    }


    /**
     * @return string
     */
    public function getMchntCd()
    {
        return $this->mchntCd;
    }


    /**
     * @return string
     */
    public function getTmFuiouId()
    {
        return $this->tmFuiouId;
    }


    /**
     * @return string
     */
    public function getTermName()
    {
        return $this->termName;
    }


    /**
     * @return string
     */
    public function getOrderType()
    {
        return $this->orderType;
    }


    /**
     * @return string
     */
    public function getOrderAmt()
    {
        return $this->orderAmt;
    }


    /**
     * @return string
     */
    public function getOrderDisAmt()
    {
        return $this->orderDisAmt;
    }


    /**
     * @return string
     */
    public function getPayAmt()
    {
        return $this->payAmt;
    }


    /**
     * @return string
     */
    public function getGuestsCount()
    {
        return $this->guestsCount;
    }


    /**
     * @return string
     */
    public function getPaySsn()
    {
        return $this->paySsn;
    }


    /**
     * @return string
     */
    public function getUserMemo()
    {
        return $this->userMemo;
    }


    /**
     * @return string
     */
    public function getMealCode()
    {
        return $this->mealCode;
    }


    /**
     * @return string
     */
    public function getExpressAmt()
    {
        return $this->expressAmt;
    }


    /**
     * @return string
     */
    public function getExpressState()
    {
        return $this->expressState;
    }


    /**
     * @return string
     */
    public function getCouponId()
    {
        return $this->couponId;
    }


    /**
     * @return string
     */
    public function getCouponRealId()
    {
        return $this->couponRealId;
    }


    /**
     * @return string
     */
    public function getCouponAmt()
    {
        return $this->couponAmt;
    }


    /**
     * @return string
     */
    public function getIntegralDeductionAmt()
    {
        return $this->integralDeductionAmt;
    }


    /**
     * @return string
     */
    public function getIntegral()
    {
        return $this->integral;
    }


    /**
     * @return int
     */
    public function getCashierDisAmt()
    {
        return $this->cashierDisAmt;
    }


    /**
     * @return string
     */
    public function getCashierDiscount()
    {
        return $this->cashierDiscount;
    }


    /**
     * @return string
     */
    public function getCashReceivedAmt()
    {
        return $this->cashReceivedAmt;
    }


    /**
     * @return string
     */
    public function getSingleGoodsDisAmt()
    {
        return $this->singleGoodsDisAmt;
    }


    /**
     * @return string
     */
    public function getDiscountType()
    {
        return $this->discountType;
    }


    /**
     * @return string
     */
    public function getCrtTm()
    {
        return $this->crtTm;
    }


    /**
     * @return string
     */
    public function getPayTm()
    {
        return $this->payTm;
    }


    /**
     * @return string
     */
    public function getFinshTm()
    {
        return $this->finshTm;
    }


    /**
     * @return string
     */
    public function getRecUpdTm()
    {
        return $this->recUpdTm;
    }


    /**
     * @return string
     */
    public function getPayDeadlineTm()
    {
        return $this->payDeadlineTm;
    }


    /**
     * @return string
     */
    public function getFinshDate()
    {
        return $this->finshDate;
    }


    /**
     * @return string
     */
    public function getPayType()
    {
        return $this->payType;
    }


    /**
     * @return string
     */
    public function getOrderState()
    {
        return $this->orderState;
    }


    /**
     * @return string
     */
    public function getOrderCancelReason()
    {
        return $this->orderCancelReason;
    }


    /**
     * @return string
     */
    public function getCashierId()
    {
        return $this->cashierId;
    }


    /**
     * @return string
     */
    public function getCashierConfirmTm()
    {
        return $this->cashierConfirmTm;
    }


    /**
     * @return string
     */
    public function getShopInfo()
    {
        return $this->shopInfo;
    }


    /**
     * @return string
     */
    public function getChannelType()
    {
        return $this->channelType;
    }


    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }


    /**
     * @return string
     */
    public function getAppOpenId()
    {
        return $this->appOpenId;
    }


    /**
     * @return string
     */
    public function getMchntEpressCost()
    {
        return $this->mchntEpressCost;
    }


    /**
     * @return string
     */
    public function getDelierTm()
    {
        return $this->delierTm;
    }


    /**
     * @return string
     */
    public function getMqttSendState()
    {
        return $this->mqttSendState;
    }


    /**
     * @return string
     */
    public function getTableTermName()
    {
        return $this->tableTermName;
    }


    /**
     * @return string
     */
    public function getIsMembership()
    {
        return $this->isMembership;
    }


    /**
     * @return string
     */
    public function getThirdOrderNo()
    {
        return $this->thirdOrderNo;
    }


    /**
     * @return string
     */
    public function getPlatHongBao()
    {
        return $this->platHongBao;
    }


    /**
     * @return string
     */
    public function getThirdMchntIncom()
    {
        return $this->thirdMchntIncom;
    }


    /**
     * @return string
     */
    public function getMemberPriceDisAmt()
    {
        return $this->memberPriceDisAmt;
    }


    /**
     * @return string
     */
    public function getPackagePriceDisAmt()
    {
        return $this->packagePriceDisAmt;
    }


    /**
     * @return string
     */
    public function getRefundTm()
    {
        return $this->refundTm;
    }


    /**
     * @return string
     */
    public function getRefundAmt()
    {
        return $this->refundAmt;
    }


    /**
     * @return string
     */
    public function getMealTm()
    {
        return $this->mealTm;
    }


    /**
     * @return string
     */
    public function getOrderPayState()
    {
        return $this->orderPayState;
    }


    /**
     * @return string
     */
    public function getCrtTmString()
    {
        return $this->crtTmString;
    }


    /**
     * @return string
     */
    public function getPayTmString()
    {
        return $this->payTmString;
    }


    /**
     * @return string
     */
    public function getFinshTmString()
    {
        return $this->finshTmString;
    }


    /**
     * @return string
     */
    public function getRecUpdTmString()
    {
        return $this->recUpdTmString;
    }


    /**
     * @return string
     */
    public function getCashierConfirmTmString()
    {
        return $this->cashierConfirmTmString;
    }


    /**
     * @return string
     */
    public function getDeliverStartTmString()
    {
        return $this->deliverStartTmString;
    }


    /**
     * @return string
     */
    public function getPayDeadlineTmString()
    {
        return $this->payDeadlineTmString;
    }


    /**
     * @return string
     */
    public function getExpressOrder()
    {
        return $this->expressOrder;
    }


    /**
     * @return string
     */
    public function getEatInOrder()
    {
        return $this->eatInOrder;
    }


    /**
     * @return string
     */
    public function getCouponDiscount()
    {
        return $this->couponDiscount;
    }


    /**
     * @return string
     */
    public function getIntegralDiscount()
    {
        return $this->integralDiscount;
    }


    /**
     * @return array
     */
    public function getOrderAddressInfo()
    {
        return $this->orderAddressInfo;
    }


    /**
     * @return array
     */
    public function getDetailList()
    {
        return $this->detailList;
    }


}