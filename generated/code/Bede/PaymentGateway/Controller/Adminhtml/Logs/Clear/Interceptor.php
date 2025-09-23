<?php
namespace Bede\PaymentGateway\Controller\Adminhtml\Logs\Clear;

/**
 * Interceptor class for @see \Bede\PaymentGateway\Controller\Adminhtml\Logs\Clear
 */
class Interceptor extends \Bede\PaymentGateway\Controller\Adminhtml\Logs\Clear implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Bede\PaymentGateway\Model\LogFactory $logFactory)
    {
        $this->___init();
        parent::__construct($context, $logFactory);
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
