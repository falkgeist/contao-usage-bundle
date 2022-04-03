<?php

$GLOBALS['TL_DCA']['tl_module']['list']['operations'] = array_merge(
    [
        'moduleusage_btn' => [
            'href' => 'key=moduleusage',
            'button_callback' => ['Falkgeist\\ContaoUsageBundle\\DCA\\ModuleDCA', 'getUsageButton'],
        ],
    ],
    $GLOBALS['TL_DCA']['tl_module']['list']['operations']
);
