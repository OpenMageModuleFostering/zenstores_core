<?php
/**
 * Zenstores Logo Block
 *
 * @category    Zenstores
 * @package     Zenstores_Core
 * @copyright   Copyright (c) 2015 Mechfeed Ltd (Zenstores) (https://www.zenstores.com/)
 */
class Zenstores_Core_Block_Logo extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml($element)
    {
        $elementData = $element->getData();

        $this->setData('zenstores_img_url', $elementData['original_data']['img_url']);
        $this->setData('zenstores_img_src', $elementData['original_data']['img_src']);
        $this->setData('zenstores_img_alt', $elementData['original_data']['img_alt']);

        $this->setStyle('width: ' . $elementData['original_data']['img_width'] . 'px;');

        return $this->toHtml();
    }

    protected function _toHtml()
    {
        $html = $this->getBeforeHtml().'<a target="_blank" href="' . $this->getData('zenstores_img_url') . '"><img '
            . ($this->getId()?' id="'.$this->getId() . '"':'')
            . ($this->getTitle()?' title="'.Mage::helper('core')->quoteEscape($this->getTitle()) . '"':'')
            . ' class="scalable ' . $this->getClass() . ($this->getDisabled() ? ' disabled' : '') . '"'
            . ' onclick="'.$this->getOnClick().'"'
            . ' style="'.$this->getStyle() .'"'
            . ($this->getDisabled() ? ' disabled="disabled"' : '')
            . ($this->getData('zenstores_img_src') ? ' src="'. $this->getData('zenstores_img_src') . '"':'')
            . ($this->getData('zenstores_img_alt') ? ' alt="'. $this->getData('zenstores_img_alt') . '"':'')
            . ' /></a>'.$this->getAfterHtml();

        return $html;
    }
}
