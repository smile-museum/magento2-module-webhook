<?php

namespace SweetTooth\Webhook\Controller\Adminhtml\System\Webhook;

class Edit extends \SweetTooth\Webhook\Controller\Adminhtml\System\Webhook
{
    /**
     * Edit Action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $webhook = $this->_initWebhook();

        $resultPage = $this->createPage();
        $resultPage->getConfig()->getTitle()->prepend(__('Webhooks'));
        $resultPage->getConfig()->getTitle()->prepend(
            $webhook->getId() ? $webhook->getCode() : __('New Webhook')
        );
        $resultPage->addContent($resultPage->getLayout()->createBlock('SweetTooth\Webhook\Block\System\Webhook\Edit'))
            ->addJs(
                $resultPage->getLayout()->createBlock(
                    'Magento\Framework\View\Element\Template',
                    '',
                    ['data' => ['template' => 'SweetTooth_Webhook::system/webhook/js.phtml']]
                )
            );
        return $resultPage;
    }
}
