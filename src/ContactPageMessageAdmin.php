<?php declare(strict_types = 1);

namespace WebOfTalent\ContactPage;

use SilverStripe\Admin\ModelAdmin;

class ContactPageMessageAdmin extends ModelAdmin
{
    /** @var array<string> */
    private static $managed_models = [ContactPageMessage::class];

    /** @var string */
    private static $url_segment = 'contactpagemessages';

    /** @var string */
    private static $menu_title = 'ContactPageMessages';

    /** @var string */
    private static $menu_icon = '/contact-page/icons/menuicon.png';
}
