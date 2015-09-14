<?php

namespace SweetTooth\Webhook\Model\Resource;

/**
 * Custom webhook resource model
 */
class Webhook extends \Magento\Framework\Model\Resource\Db\AbstractDb
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('webhook', 'webhook_id');
    }

    /**
     * Load webhook by code
     *
     * @param \SweetTooth\Webhook\Model\Webhook $object
     * @param string $code
     * @return $this
     */
    public function loadByCode(\SweetTooth\Webhook\Model\Webhook $object, $code)
    {
        if ($result = $this->getWebhookByCode($code, true, $object->getStoreId())) {
            $object->setData($result);
        }
        return $this;
    }

    /**
     * Retrieve webhook data by code
     *
     * @param string $code
     * @param bool $withValue
     * @param integer $storeId
     * @return array
     */
    public function getWebhookByCode($code, $withValue = false, $storeId = 0)
    {
        $select = $this->_getReadAdapter()->select()->from(
            $this->getMainTable()
        )->where(
            $this->getMainTable() . '.code = ?',
            $code
        );
        return $this->_getReadAdapter()->fetchRow($select);
    }

    /**
     * Perform actions after object save
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        parent::_afterSave($object);
        return $this;
    }

    /**
     * Retrieve select object for load object data
     *
     * @param string $field
     * @param mixed $value
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    protected function _getLoadSelect($field, $value, $object)
    {
        $select = parent::_getLoadSelect($field, $value, $object);
        return $select;
    }
}
