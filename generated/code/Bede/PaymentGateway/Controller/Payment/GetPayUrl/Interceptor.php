<?php
namespace Bede\PaymentGateway\Controller\Payment\GetPayUrl;

/**
 * Interceptor class for @see \Bede\PaymentGateway\Controller\Payment\GetPayUrl
 */
class Interceptor extends \Bede\PaymentGateway\Controller\Payment\GetPayUrl implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Quote\Model\QuoteFactory $quoteFactory, \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory, \Bede\PaymentGateway\Service\CheckoutDataProcessor $checkoutDataProcessor, \Magento\Quote\Model\QuoteIdMaskFactory $quoteIdMaskFactory)
    {
        $this->___init();
        parent::__construct($context, $quoteFactory, $resultJsonFactory, $checkoutDataProcessor, $quoteIdMaskFactory);
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
