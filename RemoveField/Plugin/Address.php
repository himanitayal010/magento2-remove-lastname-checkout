<?php
namespace Magneto\RemoveField\Plugin;

class Address
{
    public function afterGetLastname(
        \Magento\Quote\Model\Quote\Address $subject,
        $result
    ) {
        if (empty(trim($result))) {
            return "N/A";
        }

        return $result;
    }
}