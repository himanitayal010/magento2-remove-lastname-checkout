<?php
namespace Magneto\RemoveField\Plugin;

class LayoutProcessor
{
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        $jsLayout
    ) {
        // Make fields not required

        $nameLayout = [
            'validation' => [
                'required_entry' => false
            ]
        ];

        // Change in shipping address
        $lastnameField = &$jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
                         ['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['lastname'];

        $lastnameField = array_merge($lastnameField, $nameLayout);

        // Change in billing address

        foreach ($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                 ['payment']['children']['payments-list']['children'] as &$child)
        {
            if (isset($child['children']['form-fields'])) {
                $child['children']['form-fields']['children']['lastname'] =
                    array_merge($child['children']['form-fields']['children']['lastname'], $nameLayout);
            }
        }

        return $jsLayout;
    }
}