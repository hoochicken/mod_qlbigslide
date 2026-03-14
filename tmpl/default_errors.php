<?php
/**
 * @package     Hoochicken\Module\Qlbigslide
 *
 * @copyright   Copyright (C) 2026 Mareike Riegel. All rights reserved.
 * @license     GNU General Public License version 2 or later;
 */

defined('_JEXEC') or die;

use Hoochicken\Module\Qlbigslide\Site\models\DisplayCustom;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;

/** @var DisplayCustom $displayData */

// Get the WebAsset Manager
?>

<<?= $displayData->getModuleTag() ?>> class="<?php echo 'mod_qlbigslide ' . $displayData->getModuleClassSuffix(); ?>">
    <?php if ($displayData->showTitle()) : ?>
        <h3><?php echo Text::_('MOD_QLBIGSLIDE_TITLE'); ?></h3>
    <?php endif; ?>

    <div class="alert alert-error">
        <?php print_r($displayData->getErrors()); ?>
    </div>
</<?= $displayData->getModuleTag() ?>>