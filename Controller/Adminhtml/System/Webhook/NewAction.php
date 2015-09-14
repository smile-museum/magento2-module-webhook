<?php

namespace SweetTooth\Webhook\Controller\Adminhtml\System\Webhook;

class NewAction extends \SweetTooth\Webhook\Controller\Adminhtml\System\Webhook
{
    /**
     * New Action (forward to edit action)
     *
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Forward $resultForward */
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
