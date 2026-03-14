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

/** @var DisplayCustom $data */

if (!$data->existsMessage()) return;
// Get the WebAsset Manager
?>

<<?= $data->getModuleTag() ?>> class="<?php echo 'mod_qlbigslide ' . $data->getModuleClassSuffix(); ?>">
    <?php if ($data->showTitle()) : ?>
        <h3><?= Text::_('MOD_QLBIGSLIDE_TITLE') ?></h3>
    <?php endif; ?>

    <div class="alert alert-error">
        <?= $data->getMessage() ?>
    </div>
</<?= $data->getModuleTag() ?>>
