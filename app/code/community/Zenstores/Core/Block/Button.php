<?php
/**
 * Zenstores Button Block
 *
 * @category    Zenstores
 * @package     Zenstores_Core
 * @copyright   Copyright (c) 2015 Mechfeed Ltd (Zenstores) (https://www.zenstores.com/)
 */
class Zenstores_Core_Block_Button extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml($element)
    {
        $elementData = $element->getData();

        $this->setElement($element);

        $url = Mage::helper("adminhtml")->getUrl('adminhtml/zenstores/regenerate');

        $html = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setLabel($elementData['original_data']['button_label'])
            ->setOnClick("setLocation('$url'); return false;")
            ->toHtml();

        return $html;
    }
}
