<?php

declare(strict_types=1);

namespace Lotsofpixels\AutoInvoicer\Block\Adminhtml\Form\Field;

use Magento\Framework\View\Element\Context;
use Magento\Framework\View\Element\Html\Select;

/**
 * @codeCoverageIgnore
 * @SuppressWarnings(PHPMD.CamelCaseMethodName)
 */
class Email extends Select
{
    /**
     * Render block HTML
     *
     * @return string
     */
    protected function _toHtml()
    {
        $options = [[
            'value' => 'true',
            'label' => __('Yes'),
        ], [
            'value' => 'false',
            'label' => __('No'),
        ]];

        $this->setOptions($options);

        return parent::_toHtml();
    }

    /**
     * Sets name for input element
     *
     * @param string $value
     * @return $this
     */
    public function setInputName($value)
    {
        return $this->setName($value);
    }
}