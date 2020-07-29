<?php declare(strict_types = 1);

namespace WebOfTalent\ContactPage;

/**
 * Class ContactPageController
 *
 * @package WebOfTalent\ContactPage
 *
 * @phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
 */
class ContactPageController extends \PageController
{
    private static $allowed_actions = [
        'ContactForm',
     'SendContactForm',
     ];

    public function init(): void
    {
        //add a javascript library for easy interaction with the server
        Requirements::javascript('mysite/javascript/jQuery.js');
        $this->isAjax = Director::is_ajax();

        parent::init();
    }


    /** @return array|\SilverStripe\ORM\FieldType\DBHTMLText */
    public function index()
    {
        return $this->isAjax
            ? $this->renderWith('ContactPageModal')
            : array();
    }


    /**
     * Create and return a form for contact purposes
     */
    public function ContactForm(): Form
    {
        $name = \_t('ContactPage.NAME', 'Name');
        $email = \_t('ContactPage.EMAIL', 'Email');
        $comments = \_t('ContactPage.COMMENTS', 'Comments');
        $send = \_t('ContactPage.SEND', 'Send');

        // Create fields
        $tf = new TextField('Name', $name);
        $tf->addExtraClass('span11');

        $ef = new EmailField('Email', $email);
        $ef->addExtraClass('span11');

        $taf = new TextareaField('Comments', $comments);
        $taf->addExtraClass('span11');

        $fields = new FieldList(
            $tf,
            $ef,
            $taf,
        );

        // Create action
        $fa = new FormAction('SendContactForm', $send);

        // for bootstrap
        $fa->useButtonTag = true;
        $fa->addExtraClass('btn btn-primary buttonright');

        $actions = new FieldList(
            $fa,
        );

        // Create action
        $validator = new RequiredFields('Name', 'Email', 'Comments');

        $form = new Form($this, 'ContactForm', $fields, $actions, $validator);
        $form->setTemplate('VerticalForm');
        $form->addExtraClass('well');

        if (\class_exists('SpamProtectorManager')) {
            $form->enableSpamProtection();
        }

        return $form;
    }


    public function SendContactForm($data): void
    {
        // saving data before sending contact form
        $cpm = new ContactPageMessage();
        $cpm->Email = $data['Email'];
        $cpm->Name = $data['Name'];
        $cpm->Comments = $data['Comments'];
        $cpm->write();

        //Set data
        $From = $data['Email'];
        //$From = Email::getAdminEmail();

        $To = $this->Mailto;
        $Subject = $this->SiteConfig()->Title.' - ';
        $Subject .= 'Website Contact message';
        $email = new Email($From, $To, $Subject);
        //set template
        $email->setTemplate('ContactEmail');
        //populate template
        $email->populateTemplate($data);
        //send mail
        $email->send();

        if ($this->isAjax) {
            $result = array();
            $result['message'] = $this->SubmitText;
            $result['success'] = 1;
            echo \json_encode($result);
            die;
        }

        Controller::redirect(Director::baseURL().$this->URLSegment.'/?success=1');
    }


    /** @return bool true if a request flag of 'success' is set to 1 */
    public function Success(): bool
    {
        return isset($_REQUEST['success']) && $_REQUEST['success'] === '1';
    }


    /** @return bool true if either the latitude or longitude is non zero */
    public function HasGeo(): bool
    {
        return ($this->Latitude !== 0) && ($this->Longitude !== 0);
    }


    /** @return bool true if either Twitter or Facebook is set */
    public function HasSocialMedia(): bool
    {
        return $this->Twitter || $this->Facebook;
    }


    /** @return bool true if there is an email, fax or telephone number */
    public function HasTelecomAddress(): bool
    {
        return $this->ContactEmailAddress || $this->ContactFaxNumber || $this->ContactTelephoneNumber;
    }
}
