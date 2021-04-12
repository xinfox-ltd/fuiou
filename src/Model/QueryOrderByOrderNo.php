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
    private $userMemo;

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
    private $shopInfo;

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
                $this->$key = $val;
            }
        }
    }


    /**
     * @return int
     */
    public function getOrderNo(): int
    {
        return $this->orderNo;
    }


    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }


    /**
     * @return int
     */
    public function getShopId(): int
    {
        return $this->shopId;
    }


    /**
     * @return string
     */
    public function getMchntCd(): string
    {
        return $this->mchntCd;
    }


    /**
     * @return string
     */
    public function getTmFuiouId(): string
    {
        return $this->tmFuiouId;
    }


    /**
     * @return string
     */
    public function getTermName(): string
    {
        return $this->termName;
    }


    /**
     * @return string
     */
    public function getOrderType(): string
    {
        return $this->orderType;
    }


    /**
     * @return int
     */
    public function getOrderAmt(): int
    {
        return $this->orderAmt;
    }


    /**
     * @return int
     */
    public function getOrderDisAmt(): int
    {
        return $this->orderDisAmt;
    }


    /**
     * @return int
     */
    public function getPayAmt(): int
    {
        return $this->payAmt;
    }


    /**
     * @return int
     */
    public function getGuestsCount(): int
    {
        return $this->guestsCount;
    }


    /**
     * @return string
     */
    public function getPaySsn(): string
    {
        return $this->paySsn;
    }


    /**
     * @return string
     */
    public function getUserMemo(): string
    {
        return $this->userMemo;
    }


    /**
     * @return string
     */
    public function getMealCode(): string
    {
        return $this->mealCode;
    }


    /**
     * @return int
     */
    public function getExpressAmt(): int
    {
        return $this->expressAmt;
    }


    /**
     * @return string
     */
    public function getExpressState(): string
    {
        return $this->expressState;
    }


    /**
     * @return int
     */
    public function getCouponId(): int
    {
        return $this->couponId;
    }


    /**
     * @return int
     */
    public function getCouponRealId(): int
    {
        return $this->couponRealId;
    }


    /**
     * @return int
     */
    public function getCouponAmt(): int
    {
        return $this->couponAmt;
    }


    /**
     * @return int
     */
    public function getIntegralDeductionAmt(): int
    {
        return $this->integralDeductionAmt;
    }


    /**
     * @return int
     */
    public function getIntegral(): int
    {
        return $this->integral;
    }


    /**
     * @return int
     */
    public function getCashierDisAmt(): int
    {
        return $this->cashierDisAmt;
    }


    /**
     * @return float
     */
    public function getCashierDiscount(): float
    {
        return $this->cashierDiscount;
    }


    /**
     * @return float
     */
    public function getCashReceivedAmt(): float
    {
        return $this->cashReceivedAmt;
    }


    /**
     * @return int
     */
    public function getSingleGoodsDisAmt(): int
    {
        return $this->singleGoodsDisAmt;
    }


    /**
     * @return string
     */
    public function getDiscountType(): string
    {
        return $this->discountType;
    }


    /**
     * @return int
     */
    public function getCrtTm(): int
    {
        return $this->crtTm;
    }


    /**
     * @return int
     */
    public function getPayTm(): int
    {
        return $this->payTm;
    }


    /**
     * @return int
     */
    public function getFinshTm(): int
    {
        return $this->finshTm;
    }


    /**
     * @return int
     */
    public function getRecUpdTm(): int
    {
        return $this->recUpdTm;
    }


    /**
     * @return int
     */
    public function getPayDeadlineTm(): int
    {
        return $this->payDeadlineTm;
    }


    /**
     * @return string
     */
    public function getFinshDate(): string
    {
        return $this->finshDate;
    }


    /**
     * @return string
     */
    public function getPayType(): string
    {
        return $this->payType;
    }


    /**
     * @return string
     */
    public function getOrderState(): string
    {
        return $this->orderState;
    }


    /**
     * @return string
     */
    public function getOrderCancelReason(): string
    {
        return $this->orderCancelReason;
    }


    /**
     * @return string
     */
    public function getCashierId(): string
    {
        return $this->cashierId;
    }


    /**
     * @return int
     */
    public function getCashierConfirmTm(): int
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
    public function getChannelType(): string
    {
        return $this->channelType;
    }


    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }


    /**
     * @return string
     */
    public function getAppOpenId(): string
    {
        return $this->appOpenId;
    }


    /**
     * @return string
     */
    public function getMchntEpressCost(): string
    {
        return $this->mchntEpressCost;
    }


    /**
     * @return string
     */
    public function getDelierTm(): string
    {
        return $this->delierTm;
    }


    /**
     * @return string
     */
    public function getMqttSendState(): string
    {
        return $this->mqttSendState;
    }


    /**
     * @return string
     */
    public function getTableTermName(): string
    {
        return $this->tableTermName;
    }


    /**
     * @return string
     */
    public function getIsMembership(): string
    {
        return $this->isMembership;
    }


    /**
     * @return string
     */
    public function getThirdOrderNo(): string
    {
        return $this->thirdOrderNo;
    }


    /**
     * @return int
     */
    public function getPlatHongBao(): int
    {
        return $this->platHongBao;
    }


    /**
     * @return int
     */
    public function getThirdMchntIncom(): int
    {
        return $this->thirdMchntIncom;
    }


    /**
     * @return int
     */
    public function getMemberPriceDisAmt(): int
    {
        return $this->memberPriceDisAmt;
    }


    /**
     * @return int
     */
    public function getPackagePriceDisAmt(): int
    {
        return $this->packagePriceDisAmt;
    }


    /**
     * @return int
     */
    public function getRefundTm(): int
    {
        return $this->refundTm;
    }


    /**
     * @return int
     */
    public function getRefundAmt(): int
    {
        return $this->refundAmt;
    }


    /**
     * @return int
     */
    public function getMealTm(): int
    {
        return $this->mealTm;
    }


    /**
     * @return string
     */
    public function getOrderPayState(): string
    {
        return $this->orderPayState;
    }


    /**
     * @return string
     */
    public function getCrtTmString(): string
    {
        return $this->crtTmString;
    }


    /**
     * @return string
     */
    public function getPayTmString(): string
    {
        return $this->payTmString;
    }


    /**
     * @return string
     */
    public function getFinshTmString(): string
    {
        return $this->finshTmString;
    }


    /**
     * @return string
     */
    public function getRecUpdTmString(): string
    {
        return $this->recUpdTmString;
    }


    /**
     * @return string
     */
    public function getCashierConfirmTmString(): string
    {
        return $this->cashierConfirmTmString;
    }


    /**
     * @return string
     */
    public function getDeliverStartTmString(): string
    {
        return $this->deliverStartTmString;
    }


    /**
     * @return string
     */
    public function getPayDeadlineTmString(): string
    {
        return $this->payDeadlineTmString;
    }


    /**
     * @return bool
     */
    public function getExpressOrder(): bool
    {
        return $this->expressOrder;
    }


    /**
     * @return bool
     */
    public function getEatInOrder(): bool
    {
        return $this->eatInOrder;
    }


    /**
     * @return bool
     */
    public function getCouponDiscount(): bool
    {
        return $this->couponDiscount;
    }


    /**
     * @return bool
     */
    public function getIntegralDiscount(): bool
    {
        return $this->integralDiscount;
    }


    /**
     * @return array
     */
    public function getOrderAddressInfo(): array
    {
        return $this->orderAddressInfo;
    }


    /**
     * @return array
     */
    public function getDetailList(): array
    {
        return $this->detailList;
    }


}