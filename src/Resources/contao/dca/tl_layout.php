<?php

$GLOBALS['TL_DCA']['tl_layout']['list']['operations'] = array_merge(
	[
		'hofff_layoutusage_btn'	=> [
			'href'				=> 'key=hofff_layoutusage',
			'button_callback'	=> [ 'Falkgeist\\ContaoUsageBundle\\DCA\\LayoutDCA', 'getUsageButton' ],
		],
	],
	$GLOBALS['TL_DCA']['tl_layout']['list']['operations']
);
