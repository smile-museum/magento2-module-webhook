<?php

namespace SweetTooth\Webhook\Controller\Adminhtml\System\Webhook;

class Save extends \SweetTooth\Webhook\Controller\Adminhtml\System\Webhook
{
    /**
     * Save Action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $webhook = $this->_initWebhook();
        $data = $this->getRequest()->getPost('webhook');
        $back = $this->getRequest()->getParam('back', false);
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $data['webhook_id'] = $webhook->getId();
            $webhook->setData($data);
            try {
                $webhook->save();
                $this->messageManager->addSuccess(__('You saved the webhook.'));
                if ($back) {
                    $resultRedirect->setPath(
                        'adminhtml/*/edit',
                        ['_current' => true, 'webhook_id' => $webhook->getId()]
                    );
                } else {
                    $resultRedirect->setPath('adminhtml/*/');
                }
                return $resultRedirect;
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('adminhtml/*/edit', ['_current' => true]);
            }
        }
        return $resultRedirect->setPath('adminhtml/*/');
    }
}
