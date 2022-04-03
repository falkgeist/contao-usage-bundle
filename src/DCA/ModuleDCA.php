<?php

namespace Falkgeist\ContaoUsageBundle\DCA;

use Contao\Backend;
use Contao\Database;

/**
 * @author Falk von Freigeist <info@falkvonfreigeist.com>
 */
class ModuleDCA extends Backend
{

    /**
     * @param array $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     */
    public function getUsageButton($row, $href, $label, $title, $icon, $attributes)
    {
        $sql = 'SELECT COUNT(*) AS cnt FROM tl_content WHERE type = "module" AND module = ?';
        $usage = Database::getInstance()->prepare($sql)->execute($row['id'])->cnt;

        return sprintf(
            '<a href="%s" title="%s"%s>(%s)</a> ',
            $this->addToUrl($href . '&id=' . $row['id']),
            sprintf($GLOBALS['TL_LANG']['tl_layout']['moduleusage'][0], $row['name'], $row['id']),
            $attributes,
            $usage
        );
    }

}
