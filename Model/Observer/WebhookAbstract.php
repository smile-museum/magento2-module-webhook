<?php

namespace SweetTooth\Webhook\Model\Observer;

use Magento\Framework\Event\Observer;

/**
 * Class Customer
 */
class WebhookAbstract
{
    /**
     * @var Logger
     */
    protected $_logger;

    /**
     * Curl Adapter
     */
    protected $_curlAdapter;

    /**
     * Json Helper
     * @var [type]
     */
    protected $_jsonHelper;

    /**
     * Webhook factory
     * @var [type]
     */
    protected $_webhookFactory;

    /**
     * @param \Psr\Logger\LoggerInterface $logger
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\HTTP\Adapter\Curl $curlAdapter,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \SweetTooth\Webhook\Model\WebhookFactory $webhookFactory
    ) {
        $this->_logger = $logger;
        $this->_curlAdapter = $curlAdapter;
        $this->_jsonHelper = $jsonHelper;
        $this->_webhookFactory = $webhookFactory;
    }

    /**
     * Set new customer group to all his quotes
     *
     * @param Observer $observer
     * @return void
     */
    public function dispatch(Observer $observer)
    {
        $eventCode = $this->_getWebhookEvent();
        $eventData = $this->_getWebhookData($observer);

        $body = [
            'event' => $eventCode,
            'data'  => $eventData
        ];

        $webhooks = $this->_webhookFactory
            ->create()
            ->getCollection()
            ->addFieldToFilter('event', $eventCode);

        foreach($webhooks as $webhook)
        {
            $this->_sendWebhook($webhook->getUrl(), $body);
        }
    }

    protected function _sendWebhook($url, $body)
    {
        $this->_logger->debug("Sending webhook for event " . $this->_getWebhookEvent() . " to " . $url);

        $bodyJson = $this->_jsonHelper->jsonEncode($body);

        $headers = ["Content-Type: application/json"];
        $this->_curlAdapter->write('POST', $url, '1.1', $headers, $bodyJson);
        $this->_curlAdapter->read();
        $this->_curlAdapter->close();
    }

    protected function _getWebhookEvent()
    {
        // TODO: Throw here because this is an abstract function
        return false;
    }

    protected function _getWebhookData(Observer $observer)
    {
        // TODO: Throw here because this is an abstract function
        return false;
    }
}
