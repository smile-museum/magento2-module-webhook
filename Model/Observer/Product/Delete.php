<?php

namespace SweetTooth\Webhook\Model\Observer\Product;

use Magento\Framework\Event\Observer;

/**
 * Class Customer
 */
class Delete extends \SweetTooth\Webhook\Model\Observer\WebhookAbstract
{
    protected function _getWebhookEvent()
    {
        return 'product/deleted';
    }

    protected function _getWebhookData(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();

        /**
         * TODO: Add some type of serialization which filters the
         * actual fields that get returned from the object. Returning
         * this raw data is dangerous and can expose sensitive data.
         *
         * Ideally this representation of the object will match that
         * of the json rest api. Maybe we can tap into that serializer?
         */
        return [
            'product' => $product->getData()
        ];
    }
}
