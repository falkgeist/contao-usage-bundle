<?php

namespace Falkgeist\ContaoUsageBundle\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\CoreBundle\ContaoCoreBundle;
use Falkgeist\ContaoUsageBundle\ContaoUsageBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoUsageBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}