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
 * @method string getStatus()
 * @method string getXNonce()
 *
 * @method $this setAmount(string $amount)
 * @method $this setCurrency(string $currency)
 * @method $this setErrorCode(string $error_code)
 * @method $this setErrorMessage(string $error_message)
 * @method $this setInvoiceRef(string $invoice_ref)
 * @method $this setLanguage(string $language)
 * @method $this setOrderEntity(OrderEntity $order)
 * @method $this setOrderId(int $order_id)
 * @method $this setTemplateOrderId(int $template_order_id)
 * @method $this setStatus(string $status)
 * @method $this setTsAdded(int $ts)
 * @method $this setXNonce(string $x_nonce)
 * @method $this setPhpSessId(string $php_sess_id)
 * @method $this setXRequestSignature(string $x_request_signature)
 * @method $this setXShopName(string $x_shop_name)
 */
class PaymentEntity extends Entity
{
    protected $db_table = PaymentEntityRepository::DB_TABLE_NAME;

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
