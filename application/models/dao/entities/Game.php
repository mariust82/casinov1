<?php
class Game extends Entity
{
    public $id;
    public $name;
    public $type;
    public $software;
    public $release_date;
    public $technologies = array();
    public $is_mobile;
    public $is_3d;
    public $overview;
    public $times_played;
    public $play;
    public $logo_big;
    public $logo_small;
}
