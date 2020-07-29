<?php declare(strict_types = 1);

namespace WebOfTalent\ContactPage;

use SilverStripe\Forms\FormField;
use SilverStripe\ORM\DataObject;

class ContactPageMessage extends DataObject
{
    /**
     * @var string
     */
    private static $table_name = 'ContactPageMessage';

    /** @var array<string,string> */
    private static $db = [
        'Name' => 'Varchar(255)',
     'Email' => 'Varchar(255)',
     'Comments' => 'Text',
     'RepliedTo' => 'Boolean',
    ];


    /**
     * @return \SilverStripe\Forms\FieldList<FormField>
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->renameField('Name', \_t('ContactPageMessage.NAME', 'Name'));
        $fields->renameField('Email', \_t('ContactPageMessage.EMAIL', 'Email'));
        $fields->renameField('Comments', \_t('ContactPageMessage.COMMENTS', 'Comments'));
        $fields->renameField('RepliedTo', \_t('ContactPageMessage.REPLIED_TO', 'Replied To'));

        return $fields;
    }
}
