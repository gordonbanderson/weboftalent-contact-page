<?php declare(strict_types = 1);

namespace WebOfTalent\ContactPage;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormField;

/**
 * Class ContactPageMultipleAddressExtension
 *
 * @package WebOfTalent\ContactPage
 *
 * @phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
 */
class ContactPageMultipleAddressExtension extends Extension
{
    /**
     * @param FieldList<FormField> $fields
     */
    public function updateContactPageForm( &$fields): void
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
