<?php declare(strict_types = 1);

namespace WebOfTalent\ContactPage;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;

/**
 * Class ContactPageMultipleAddressExtension
 *
 * @package WebOfTalent\ContactPage
 *
 * @phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
 */
class ContactPageMultipleAddressExtension extends Extension
{
    /** @param \SilverStripe\Forms\FieldList<\SilverStripe\Forms\FormField> $fields */
    public function updateContactPageForm(FieldList &$fields): void
    {
        $fields->removeByName('ContactAddress');
        $fields->removeByName('ContactTelephoneNumber');
        $fields->removeByName('ContactFaxNumber');
        $fields->removeByName('Location');
    }


    public function HideAddressAndPhoneDetails(): bool
    {
        return true;
    }
}
