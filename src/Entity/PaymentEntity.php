<?php
declare(strict_types=1);

namespace TMCms\Modules\BilderlingsPay\Entity;

use InvalidArgumentException;
use TMCms\Config\Configuration;
use TMCms\Modules\Orders\Entity\OrderEntity;
use TMCms\Orm\Entity;

/**
 * Class PaymentEntity
 * @package TMCms\Modules\BilderlingsPay\Entity
 *
 * @method OrderEntity getOrderEntity()
 *
 * @method $this setOrderEntity(OrderEntity $order)
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

    /**
     * @param string $config_key
     *
     * @return string
     * @throws InvalidArgumentException
     */
    public function getConfigParam(string $config_key): string
    {
        $config_value = Configuration::getInstance()->get('bilderlings_pay')[$config_key] ?? '';

        if (!$config_value) {
            throw new InvalidArgumentException('Not set config value for key '. $config_key);
        }

        return $config_value;
    }
}
