<?php
declare(strict_types=1);

namespace TMCms\Modules\BilderlingsPay;

use TMCms\HTML\Cms\CmsTableHelper;
use TMCms\Modules\BilderlingsPay\Entity\PaymentEntityRepository;

\defined('INC') or exit;

/**
 * Class CmsBilderlingsPay
 * @package TMCms\Modules\BilderlingsPay
 */
class CmsBilderlingsPay
{
    public function _default()
    {
        $payments = new PaymentEntityRepository();
        $payments->addOrderByField($payments::FIELD_TS_ADDED, true);

        echo CmsTableHelper::outputTable([
            'data' => $payments,
            'columns' => [
                PaymentEntityRepository::FIELD_TS_ADDED => [
                    'type' => 'date',
                    'title' => w('date'),
                ],
                PaymentEntityRepository::FIELD_ORDER_ID => [],
                PaymentEntityRepository::FIELD_STATUS => [],
                PaymentEntityRepository::FIELD_AMOUNT => [],
                PaymentEntityRepository::FIELD_CURRENCY => [],
                PaymentEntityRepository::FIELD_INVOICE_REF => [],
                PaymentEntityRepository::FIELD_ERROR_CODE => [],
            ],
        ]);
    }
}
