<?php
namespace Magento\Payment\Model\PaymentMethodList;

/**
 * Interceptor class for @see \Magento\Payment\Model\PaymentMethodList
 */
class Interceptor extends \Magento\Payment\Model\PaymentMethodList implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Payment\Api\Data\PaymentMethodInterfaceFactory $methodFactory, \Magento\Payment\Helper\Data $helper)
    {
        $this->___init();
        parent::__construct($methodFactory, $helper);
    }
}
