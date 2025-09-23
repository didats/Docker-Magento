<?php
namespace Bede\PaymentGateway\Controller\Payment\Test;

/**
 * Interceptor class for @see \Bede\PaymentGateway\Controller\Payment\Test
 */
class Interceptor extends \Bede\PaymentGateway\Controller\Payment\Test implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Bede\PaymentGateway\Helper\Data $helper, \Bede\PaymentGateway\Model\Payment\Bede $bede)
    {
        $this->___init();
        parent::__construct($context, $helper, $bede);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }
}
