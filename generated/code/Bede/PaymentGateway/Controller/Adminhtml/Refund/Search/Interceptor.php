<?php
namespace Bede\PaymentGateway\Controller\Adminhtml\Refund\Search;

/**
 * Interceptor class for @see \Bede\PaymentGateway\Controller\Adminhtml\Refund\Search
 */
class Interceptor extends \Bede\PaymentGateway\Controller\Adminhtml\Refund\Search implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Controller\Result\JsonFactory $jsonFactory, \Magento\Framework\App\ResourceConnection $resourceConnection)
    {
        $this->___init();
        parent::__construct($context, $jsonFactory, $resourceConnection);
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
