<?php
/**
 * @package     Hoochicken\Module\Qlbigslide
 *
 * @copyright   Copyright (C) 2026 Mareike Riegel. All rights reserved.
 * @license     GNU General Public License version 2 or later;
 */

defined('_JEXEC') or die;

use Hoochicken\Module\Qlbigslide\Site\models\DisplayModel;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;

/** @var DisplayModel $data  */

// Get the WebAsset Manager
$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$moduleclass_sfx = htmlspecialchars($data->params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8');
?>

<div class="<?php echo 'mod_qlbigslide ' . $moduleclass_sfx; ?>">
    <?php if ($data->hasErrors()) : ?>
        <div class="alert alert-error">
            <?php print_r( $data->getErrors()); ?>
        </div>
    <?php else : ?>
        <?php if ($data->showTitle()) : ?>
            <h3><?php echo Text::_('MOD_QLBIGSLIDE_TITLE'); ?></h3>
        <?php endif; ?>

        <div class="module-content">
            <?php echo $data->getMessage(); ?>
        </div>
    <?php endif; ?>
</div>