<?php
declare(strict_types=1);

namespace TMCms\Modules\BilderlingsPay;

use TMCms\Modules\BilderlingsPay\Entity\PaymentEntity;
use TMCms\Modules\IModule;
use TMCms\Modules\Orders\Entity\OrderEntity;
use TMCms\Orm\Entity;
use TMCms\Traits\singletonInstanceTrait;

\defined('INC') or exit;

/**
 * Class ModuleBilderlingsPay
 * @package TMCms\Modules\BilderlingsPay
 */
class ModuleBilderlingsPay implements IModule
{
    use singletonInstanceTrait;

    const DIRECT_POST_URL = 'https://bpayprocessing.iamoffice.lv/direct/v1';

    const CURRENCY_EUR = 'EUR';
    const CURRENCY_DEFAULT = self::CURRENCY_EUR;

    const PAYMENT_METHOD_FD_SMS = 'FD_SMS';
    const PAYMENT_METHOD_FD_SMS_3D_OPTIONAL = 'FD_SMS_3D_OPTIONAL';
    const PAYMENT_METHOD_DEFAULT = self::PAYMENT_METHOD_FD_SMS_3D_OPTIONAL;

    /**
     * @param PaymentEntity $payment
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public static function renderDirectPostPaymentRequestForm(PaymentEntity $payment): string
    {
        date_default_timezone_set('Europe/Riga');

        /** @var OrderEntity $order */
        $order = $payment->getOrderEntity();

        $shop_name = $payment->getConfigParam('shop_name');
        $locale = \strtolower(LNG) . '_' . \strtoupper(LNG);
        $ShopPassword = $payment->getConfigParam('shop_password');
        $order_id = $order->getId();
        $amount = $order->getSum();
        $currency = self::CURRENCY_DEFAULT;
        $payment_method = self::PAYMENT_METHOD_DEFAULT;
        $bytes = openssl_random_pseudo_bytes(20);
        $xid = base64_encode($bytes);
        $X_Nonce = str_replace(['+', '/', '='], '1', $xid);
        $input = $order_id . $amount . $currency . $payment_method . $X_Nonce . $ShopPassword;
        $sha512 = hash('sha512', $input, false);
        $X_Request_Signature = $sha512;
        $params = [
            'X-Shop-Name' => $shop_name,
            'X-Nonce' => $X_Nonce,
            'X-Request-Signature' => $X_Request_Signature,
            'order_id' => $order_id,
            'amount' => $amount,
            'currency' => $currency,
            'payment_method' => $payment_method,
            'shop_name' => $shop_name,
            'customer.additional_params[\'locale\']' => $locale,
        ];
        $html_post = '<form method="POST" action="'. self::DIRECT_POST_URL .'" name="frm1">' . "\n";
        foreach ($params as $key => $value) {
            $html_post .= '<input type=hidden name="' . \htmlspecialchars((string)$key, \ENT_QUOTES) . '" value="' . \htmlspecialchars((string)$value, \ENT_QUOTES) . '">' . "\n";
        }
        $html_post .= '</form><script>document.frm1.submit();</script>';

        return $html_post;
    }
}
