<?php

namespace WebOfTalent\ContactPage;

class ContactPage extends \Page
{
    private static $db = array(
        'ContactAddress' => 'Text',
        'ContactTelephoneNumber' => 'Varchar(255)',
        'ContactFaxNumber' => 'Varchar(255)',
        'ContactEmailAddress' => 'Varchar(255)',
        'Mailto' => 'Varchar(100)', //Email address to send submissions to
        'SubmitText' => 'HTMLText', //Text presented after submitting message,
        'Twitter' => 'Varchar(255)',
        'Facebook' => 'Varchar(255)',
    );

    private static $icon = 'contact-page/icons/phone.png';

    public function SingularMap()
    {
        return !$this::has_extension('ContactPageMultipleAddressExtension');
    }

    public function Map()
    {
        if ($this::has_extension('ContactPageMultipleAddress')) {
            return '';
        } else {
            $map = $this->owner->getRenderableMap();
            $map->setZoom(10);
            $map->setAdditionalCSSClasses('fullWidthMap');
            $map->setShowInlineMapDivStyle(true);
            $map->setClusterer(false);
            return $map;
        }
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $addresstabname = 'Root.'._t('ContactPage.ADDRESS', 'Address');
        $socialmediatabname = 'Root.'._t('ContactPage.SOCIAL_MEDIA', 'Social Media');
        $fields->addFieldToTab('Root.Main', new CheckboxField('ShowOnMap', 'Tick this box to show a map'));
        $fields->addFieldToTab('Root.OnSubmission',
            new TextField('Mailto', _t('ContactPage.EMAIL_SUBMISSIONS_TO', 'Email submissions to')
        ));

        $fields->addFieldToTab('Root.OnSubmission',
            new HTMLEditorField('SubmitText', _t('ContactPage.TEXT_SHOWN_AFTER_SUBMISSION', 'Text on Submission')));

        $fields->addFieldToTab($addresstabname, new TextAreaField('ContactAddress', _t('ContactPage.ADDRESS', 'Address')));
        $fields->addFieldToTab($addresstabname, new TextField('ContactTelephoneNumber',
                _t('ContactPage.CONTACT_TELEPHONE_NUMBER', 'Contact Tel. Number')));
        $fields->addFieldToTab($addresstabname, new TextField('ContactFaxNumber',
                _t('ContactPage.CONTACT_FAX_NUMBER', 'Contact Fax Number')));
        $fields->addFieldToTab($addresstabname, new TextField('ContactEmailAddress',
                _t('ContactPage.CONTACT_EMAIL_ADDRESS_ADMIN', '(TH) Contact Email Address')));

        $fields->addFieldToTab($socialmediatabname, new TextField('Facebook',
                _t('ContactPage.FACEBOOK_URL', 'Facebook URL')));
        $fields->addFieldToTab($socialmediatabname, new TextField('Twitter',
                _t('ContactPage.TWITTER_USERNAME', 'Twitter Username')));

        $this->extend('updateContactPageForm', $fields);

        return $fields;
    }

    public function ShortenedFacebook()
    {
        $result = str_replace('https:', 'http:', $this->Facebook);
        $result = str_replace('http://facebook.com/', '', $result);
        $result = str_replace('http://www.facebook.com/', '', $result);
        $result = str_replace('http://facebook.com/', '', $result);

        return $result;
    }
}
