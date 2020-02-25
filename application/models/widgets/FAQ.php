<?php
namespace CasinosLists;
require_once 'hlis/widgets/src/widgets/FAQ';

class FAQ extends \CMS\FAQ
{
    public function render($remoteID, $extraBindings=array())
    {
        try {
            $info = $this->get($remoteID);
        } catch (\Exception $e) {}
        if (empty($info)) {
            return "";
        }

        $variables= new Variables($this->variablesFolder, $extraBindings);
        $output = '<div class="widget faq">';
        $output.= '<h2>';
        $output .= $variables->process($info[0]->value);
        $output.= '</h2>';
        $tableReader = new TableReader($info[1]->value);
        $rows = $tableReader->getRows();
        foreach($rows as $row) {
            $output .= '<div><div>'.$variables->process($row[0]).'</div><div>'.$variables->process($row[1]).'</div></div>';
        }
        $output .= '</div>';
        return $output;
    }
}
    