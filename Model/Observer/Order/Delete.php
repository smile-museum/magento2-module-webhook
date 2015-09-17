<?php

namespace SweetTooth\Webhook\Model\Observer\Order;

use Magento\Framework\Event\Observer;

/**
 * Class Customer
 */
class Delete extends \SweetTooth\Webhook\Model\Observer\WebhookAbstract
{
    protected function _getWebhookEvent()
    {
        return 'order/deleted';
    }

    protected function _getWebhookData(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();

        /**
         * TODO: Add some type of serialization which filters the
         * actual fields that get returned from the object. Returning
         * this raw data is dangerous and can expose sensitive data.
         *
         * Ideally this representation of the object will match that
         * of the json rest api. Maybe we can tap into that serializer?
         */
        return [
            'order' => $order->getData()
        ];
    }
}
