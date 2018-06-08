<?php
class User extends \TMS\VariablesHolder
{
    public function country() {
        return $this->request->getInfo()->getAttribute("country")->name;
    }
}
