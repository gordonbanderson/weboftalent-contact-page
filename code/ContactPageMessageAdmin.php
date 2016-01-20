<?php

class ContactPageMessageAdmin extends ModelAdmin
{
    // Can manage multiple models
    public static $managed_models = array('ContactPageMessage');

    // Linked as /admin/products/
    public static $url_segment = 'contactpagemessages';

    public static $menu_title = 'ContactPageMessages';

    public static $menu_icon = '/contact-page/icons/menuicon.png';
}
