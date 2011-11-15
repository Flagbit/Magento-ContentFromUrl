<?php
class Flagbit_ContentFromUrl_Block_Adminhtml_Form_Field_Contentfromurl extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
/**
     * @var Mage_CatalogInventory_Block_Adminhtml_Form_Field_Customergroup
     */
    protected $_groupRenderer;

    /**
     * Retrieve group column renderer
     *
     * @return Mage_CatalogInventory_Block_Adminhtml_Form_Field_Customergroup
     */
    protected function _getGroupRenderer()
    {
        if (!$this->_groupRenderer) {
            $this->_groupRenderer = $this->getLayout()->createBlock(
                'contentfromurl/adminhtml_form_field_languagegroup', '',
                array('is_render_to_js_template' => true)
            );
            $this->_groupRenderer->setClass('language_group_select');
            $this->_groupRenderer->setExtraParams('style="width:120px"');
        }
        
        return $this->_groupRenderer;
    }

    /**
     * Prepare to render
     */
    protected function _prepareToRender()
    {
        $this->addColumn('language_group_id', array(
            'label' => Mage::helper('customer')->__('Language Group'),
            'renderer' => $this->_getGroupRenderer(),
        ));
        $this->addColumn('url', array(
            'label' => Mage::helper('customer')->__('Url'),
            'style' => 'width:300px',
        ));
        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('cataloginventory')->__('Add Url');
    }

    /**
     * Prepare existing row data object
     *
     * @param Varien_Object
     */
    protected function _prepareArrayRow(Varien_Object $row)
    {
        $row->setData(
            'option_extra_attr_' . $this->_getGroupRenderer()->calcOptionHash($row->getData('language_group_id')),
            'selected="selected"'
        );
    }
}