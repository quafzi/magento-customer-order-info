<?php
/**
 * Quafzi_CustomerOrderInfo_Block_Info
 *
 * @package   Quafzi_CustomerOrderInfo
 * @copyright 2014
 * @author    Thomas Birke <tbirke@netextreme.de>
 * @license   MIT
 */
class Quafzi_CustomerOrderInfo_Block_Info
    extends Mage_Core_Block_Template
{
    protected $_template = 'quafzi_customerorderinfo/info.phtml';

    public function getOrderCollectionGrandTotal(Mage_Sales_Model_Resource_Order_Collection $orders)
    {
        $sum = 0;
        foreach ($orders as $order) {
            $sum += $order->getGrandTotal();
        }
        return $sum;
    }

    public function getOrdersGroupedByState()
    {
        $orders = array();
        $states = (array)Mage::getConfig()->getNode(Mage_Sales_Model_Config::XML_PATH_ORDER_STATES);
        foreach ($states as $state=>$stateData) {
            $orders[$state] = $this->getOrderCollection()->addFieldToFilter('state', $state);
        }
        return $orders;
    }

    public function getOrderCollection()
    {
        return Mage::getModel('sales/order')
            ->getCollection()
            ->addFieldToFilter('customer_id', $this->getCustomer()->getId());
    }
}
