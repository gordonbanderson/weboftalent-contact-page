<?php declare(strict_types = 1);

namespace WebOfTalent\ContactPage;

use SilverStripe\Admin\ModelAdmin;

class ContactPageMessageAdmin extends ModelAdmin
{
    // Can manage multiple models
    private static $managed_models = [ContactPageMessage::class];

    // Linked as /admin/products/
    private static $url_segment = 'contactpagemessages';

    private static $menu_title = 'ContactPageMessages';

    private static $menu_icon = '/contact-page/icons/menuicon.png';
}
