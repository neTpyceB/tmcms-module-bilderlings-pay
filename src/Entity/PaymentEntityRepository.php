<?php
declare(strict_types=1);

namespace TMCms\Modules\BilderlingsPay\Entity;

use TMCms\Orm\EntityRepository;
use TMCms\Orm\TableStructure;

/**
 * Class PaymentEntity
 * @package TMCms\Modules\BilderlingsPay\Entity
 */
class PaymentEntityRepository extends EntityRepository
{
    const DB_TABLE_NAME = 'm_bilderlings_payments';

    const FIELD_TS_ADDED = 'ts_added';
    const FIELD_STATUS = 'status';
    const FIELD_INVOICE_REF = 'invoice_ref';
    const FIELD_AMOUNT = 'amount';
    const FIELD_CURRENCY = 'currency';
    const FIELD_ORDER_ID = 'order_id';
    const FIELD_ERROR_CODE = 'error_code';
    const FIELD_ERROR_MESSAGE = 'error_message';
    const FIELD_TEMPLATE_ORDER_ID = 'template_order_id';
    const FIELD_X_SHOP_NAME = 'x_shop_name';
    const FIELD_X_NONCE = 'x_nonce';
    const FIELD_X_REQUEST_SIGNATURE = 'x_request_signature';
    const FIELD_PHP_SESS_ID = 'php_sess_id';
    const FIELD_LANGUAGE = 'language';

    protected $db_table = self::DB_TABLE_NAME;

    protected $table_structure = [
        'fields' => [
            self::FIELD_TS_ADDED => [
                'type' => TableStructure::FIELD_TYPE_UNSIGNED_INTEGER,
            ],
            self::FIELD_STATUS => [
                'type' => TableStructure::FIELD_TYPE_VARCHAR_255,
            ],
            self::FIELD_INVOICE_REF => [
                'type' => TableStructure::FIELD_TYPE_VARCHAR_255,
            ],
            self::FIELD_AMOUNT => [
                'type' => TableStructure::FIELD_TYPE_FLOAT_DECIMAL,
            ],
            self::FIELD_CURRENCY => [
                'type' => TableStructure::FIELD_TYPE_VARCHAR_255,
            ],
            self::FIELD_ORDER_ID => [
                'type' => TableStructure::FIELD_TYPE_INDEX,
            ],
            self::FIELD_ERROR_CODE => [
                'type' => TableStructure::FIELD_TYPE_VARCHAR_255,
            ],
            self::FIELD_ERROR_MESSAGE => [
                'type' => TableStructure::FIELD_TYPE_VARCHAR_255,
            ],
            self::FIELD_TEMPLATE_ORDER_ID => [
                'type' => TableStructure::FIELD_TYPE_UNSIGNED_INTEGER,
            ],
            self::FIELD_X_SHOP_NAME => [
                'type' => TableStructure::FIELD_TYPE_VARCHAR_255,
            ],
            self::FIELD_X_NONCE => [
                'type' => TableStructure::FIELD_TYPE_VARCHAR_255,
            ],
            self::FIELD_X_REQUEST_SIGNATURE => [
                'type' => TableStructure::FIELD_TYPE_VARCHAR_255,
            ],
            self::FIELD_PHP_SESS_ID => [
                'type' => TableStructure::FIELD_TYPE_VARCHAR_255,
            ],
            self::FIELD_LANGUAGE => [
                'type' => TableStructure::FIELD_TYPE_VARCHAR_255,
            ],
        ],
    ];
}
