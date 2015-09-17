<?php

namespace SweetTooth\Webhook\Model\Observer\Customer;

use Magento\Framework\Event\Observer;

/**
 * Class Customer
 */
class Create extends \SweetTooth\Webhook\Model\Observer\WebhookAbstract
{
    /**
     * We override the dispatch function to check if the object in the
     * observer is a new object. If it isn't we make this a noop.
     */
    public function dispatch(Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();

        /**
         * Return early if the object isn't new
         */
        if (!$customer->getIsObject()) {
            return $this;
        }

        return parent::dispatch($observer);
    }

    protected function _getWebhookEvent()
    {
        return 'customer_create_after';
    }

    protected function _getWebhookData(Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();

        /**
         * TODO: Add some type of serialization which filters the
         * actual fields that get returned from the object. Returning
         * this raw data is dangerous and can expose sensitive data.
         *
         * Ideally this representation of the object will match that
         * of the json rest api. Maybe we can tap into that serializer?
         */
        return [
            'customer' => $customer->getData()
        ];
    }
}
