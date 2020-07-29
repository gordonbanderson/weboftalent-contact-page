<?php declare(strict_types = 1);

namespace WebOfTalent\ContactPage;

use SilverStripe\Core\Extension;

class ContactPageMultipleAddressExtension extends Extension
{
    public function updateContactPageForm(&$fields): void
    {
        $fields->removeByName('ContactAddress');
        $fields->removeByName('ContactTelephoneNumber');
        $fields->removeByName('ContactFaxNumber');
        $fields->removeByName('Location');
    }

    /*
    Helper method for a template
    */
    public function HideAddressAndPhoneDetails()
    {
        return true;
    }
}
