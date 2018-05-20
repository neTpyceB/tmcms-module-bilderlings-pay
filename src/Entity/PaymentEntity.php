<?php
declare(strict_types=1);

namespace TMCms\Modules\BilderlingsPay\Entity;

use TMCms\Orm\Entity;

/**
 * Class PaymentEntity
 * @package TMCms\Modules\BilderlingsPay\Entity
 *
 * @method $this setTsAdded(int $ts)
 */
class PaymentEntity extends Entity
{
    /**
     * Auto-call before any Create
     */
    protected function beforeCreate()
    {
        // Created time
        $this->setTsAdded(NOW);

        return $this;
    }
}
