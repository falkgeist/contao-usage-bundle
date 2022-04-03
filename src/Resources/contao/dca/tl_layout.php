<?php

$GLOBALS['TL_DCA']['tl_layout']['list']['operations'] = array_merge(
	[
		'layoutusage_btn'	=> [
			'href'				=> 'key=layoutusage',
			'button_callback'	=> [ 'Falkgeist\\ContaoUsageBundle\\DCA\\LayoutDCA', 'getUsageButton' ],
		],
	],
	$GLOBALS['TL_DCA']['tl_layout']['list']['operations']
);
