<?php
/**
 * @package     Hoochicken\Module\Qlbigslide
 *
 * @copyright   Copyright (C) 2026 Mareike Riegel. All rights reserved.
 * @license     GNU General Public License version 2 or later;
 */

defined('_JEXEC') or die;

use Joomla\CMS\Extension\Service\Provider\HelperFactory;
use Joomla\CMS\Extension\Service\Provider\Module;
use Joomla\CMS\Extension\Service\Provider\ModuleDispatcherFactory;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

return new class() implements ServiceProviderInterface
{
    const PHP_VERSION_NAMESPACE = '8.4.0';

    public function register(Container $container)
    {
        static::requireOnceIfPhpDoesNotKnowamespaces();

        $container->registerServiceProvider(new ModuleDispatcherFactory('\\Hoochicken\\Module\\Qlbigslide'));
        $container->registerServiceProvider(new HelperFactory('\\Hoochicken\\Module\\Qlbigslide\\Site\\Helper'));
        $container->registerServiceProvider(new Module());
    }

    private static function requireOnceIfPhpDoesNotKnowamespaces(): void
    {
        if (static::checkPhpVersionKnowsNamesspaces()) {
            return;
        }

        require_once __DIR__ . '/../src/Dispatcher/Dispatcher.php';
        require_once __DIR__ . '/../src/Helper/DisplayBasic.php';
        require_once __DIR__ . '/../src/Helper/DisplayBasicInterface.php';
        require_once __DIR__ . '/../src/Helper/DisplayCustom.php';
        require_once __DIR__ . '/../src/Helper/DisplayCustomInterface.php';
        require_once __DIR__ . '/../src/Helper/ErrorItem.php';
        require_once __DIR__ . '/../src/Helper/ErrorCollection.php';
        require_once __DIR__ . '/../src/Helper/SlideItem.php';
        require_once __DIR__ . '/../src/Helper/SlideCollection.php';
        require_once __DIR__ . '/../src/Helper/StringHelper.php';
    }

    private static function checkPhpVersionKnowsNamesspaces(): bool
    {
        $phpVersion = phpversion();
        return (version_compare($phpVersion, static::PHP_VERSION_NAMESPACE, '>='));
    }
};
