<?php
/**
 * Quafzi_CustomerOrderInfo_Model_Observer
 *
 * @package   Quafzi_CustomerOrderInfo
 * @copyright 2014
 * @author    Thomas Birke <tbirke@netextreme.de>
 * @license   MIT
 */
class Quafzi_CustomerOrderInfo_Model_Observer
{
    public function addAdminhtmlCustomerOrderInfo($observer)
    {
        $block = $observer->getBlock();
        if ($block instanceof Mage_Adminhtml_Block_Customer_Edit_Tab_View_Sales) {
            $parentHtml = $observer->getTransport()->getHtml();
            $infoHtml = $block->getLayout()->createBlock(
                'quafzi_customerorderinfo/info',
                'customer_order_info'
            )->setCustomer(Mage::registry('current_customer'))->toHtml();
            $observer->getTransport()->setHtml($infoHtml . $parentHtml);
        }
    }
}
