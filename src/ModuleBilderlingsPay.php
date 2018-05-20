<?php
declare(strict_types=1);

namespace TMCms\Modules\BilderlingsPay;

use TMCms\Modules\BilderlingsPay\Entity\PaymentEntity;
use TMCms\Modules\IModule;
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

    /**
     * @param PaymentEntity $payment
     *
     * @return string
     */
    public static function renderDirectPostPaymentRequestForm(PaymentEntity $payment): string
    {
        date_default_timezone_set('Europe/Riga');

        $shop_name = $payment->getShopName(); // TODO from configs, set on load
        $locale = 'lv_LV'; // TODO lng
        $ShopPassword = '<secret_shop_code>'; // TODO set from config
        $order_id = date('Y_m_d_H_i_s'); // TODO $order
        $amount = '1.23'; // TODO set from order
        $currency = 'EUR'; // TODO set from order
        $payment_method = 'FD_SMS';
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
        $html_post = '<html><body onLoad="document.frm1.submit();">' . "\n";
        $html_post .= '<form method="POST" action="'. self::DIRECT_POST_URL .'" name="frm1">' . "\n";
        foreach ($params as $key => $value) {
            $html_post .= '<input type=hidden name="' . $key . '" value="' . $value . '">' . "\n";
        }
        $html_post .= '</form></body></html>';

        return $html_post;
    }

    public static function handleDirectPostNotificationUrl() {
//        $notify_logs = 'callback_' . date('Y_m_d_H_i_s');
//
//// You can use this response to analyze status of payment
//        if ($_POST['status'] == 'SUCCEEDED') {
//            file_put_contents('./callback_logs/' . 'succ_' . $notify_logs, print_r($_POST, 1), FILE_APPEND | LOCK_EX);
//        } else {
//            file_put_contents('./callback_logs/' . 'failed_' . $notify_logs, print_r($_POST, 1), FILE_APPEND | LOCK_EX);
//        }
//        echo 'Persisted to ' . $notify_logs;
//        die;
    }

    public static function handleDirectPostReturnUrl() {
//        date_default_timezone_set('Europe/Riga');
//        $notify_logs = 'callback_' . date('Y_m_d_H_i_s');
//
//// You can use this response to analyze status of payment
//        if ($_POST['status'] == 'SUCCEEDED') {
//            file_put_contents('./callback_logs/' . 'succ_ret_' . $notify_logs, print_r($_POST, 1), FILE_APPEND | LOCK_EX);
//        } else {
//            file_put_contents('./callback_logs/' . 'failed_ret_' . $notify_logs, print_r($_POST, 1), FILE_APPEND | LOCK_EX);
//        }
//        die('<PRE>'.print_r($_POST,1));
    }
}
