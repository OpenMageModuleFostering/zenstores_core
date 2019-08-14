<?php
/**
 * Zenstores Description Block
 *
 * @category    Zenstores
 * @package     Zenstores_Core
 * @copyright   Copyright (c) 2015 Mechfeed Ltd (Zenstores) (https://www.zenstores.com/)
 */
class Zenstores_Core_Block_Description extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml($element)
    {
        $elementData = $element->getData();

        $this->setData('zenstores_description', $elementData['original_data']['description']);

        return $this->toHtml();
    }

    protected function _toHtml()
    {
        $html = $this->getBeforeHtml().'<span '
            . ($this->getId()?' id="'.$this->getId() . '"':'')
            . ($this->getTitle()?' title="'.Mage::helper('core')->quoteEscape($this->getTitle()) . '"':'')
            . ' class="scalable ' . $this->getClass() . ($this->getDisabled() ? ' disabled' : '') . '"'
            . ' onclick="'.$this->getOnClick().'"'
            . ' style="'.$this->getStyle() .'"'
            . ($this->getDisabled() ? ' disabled="disabled"' : '')
            . ($this->getSrc()?' src="'.$this->getSrc() . '"':'')
            . ($this->getAlt()?' alt="'.$this->getAlt() . '"':'')
            . '>'. $this->getData('zenstores_description') .'</span>'.$this->getAfterHtml();

        return $html;
    }
}
