<?php declare(strict_types = 1);

namespace WebOfTalent\ContactPage\Tests;

use SilverStripe\Dev\SapphireTest;
use WebOfTalent\ContactPage\ContactPageMessage;

class ContactPageMessageTest extends SapphireTest
{
    public function testGetCMSFields(): void
    {
        $cpm = new ContactPageMessage();
        $fields = $cpm->getCMSFields();
        $tab = $fields->findOrMakeTab('Root.Main');
        $fields = $tab->FieldList();
        $names = array();
        foreach ($fields as $field) {
            \array_push($names, $field->getName());
        }
        $expected = array(
            'Name', 'Email', 'Comments', 'RepliedTo'
        );
        $this->assertEquals($expected, $names);
    }
}
