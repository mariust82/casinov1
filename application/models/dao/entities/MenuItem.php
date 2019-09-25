<?php
class MenuItem extends Entity
{
    public $title;
    public $url;
    public $is_active;
    public $submenuItems = [];
    public $have_submenu = false;
}
