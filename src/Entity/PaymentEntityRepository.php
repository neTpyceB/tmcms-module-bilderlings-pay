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
    const FIELD_TS_ADDED = 'ts_added';

    protected $table_structure = [
        'fields' => [
            self::FIELD_TS_ADDED => [
                'type' => TableStructure::FIELD_TYPE_UNSIGNED_INTEGER,
            ],
        ],
    ];
}
