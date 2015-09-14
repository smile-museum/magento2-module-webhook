<?php

namespace SweetTooth\Webhook\Controller\Adminhtml\System\Webhook;

class Validate extends \SweetTooth\Webhook\Controller\Adminhtml\System\Webhook
{
    /**
     * Validate Action
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $response = new \Magento\Framework\Object(['error' => false]);
        $webhook = $this->_initWebhook();
        $webhook->addData($this->getRequest()->getPost('webhook'));
        $result = $webhook->validate();
        if ($result instanceof \Magento\Framework\Phrase) {
            $this->messageManager->addError($result->getText());
            $layout = $this->layoutFactory->create();
            $layout->initMessages();
            $response->setError(true);
            $response->setHtmlMessage($layout->getMessagesBlock()->getGroupedHtml());
        }
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData($response->toArray());
    }
}
