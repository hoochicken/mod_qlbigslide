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

/** @var ?DisplayCustom $displayData */

// Get the WebAsset Manager
$document = Factory::getApplication()->getDocument();
$wa = $document->getWebAssetManager();
$wa->getRegistry()->addExtensionRegistryFile('mod_qlbigslide');
$wa->useScript('mod_qlbigslide.script');
$wa->useStyle('mod_qlbigslide.style');

$document->addScriptOptions('mod_qlbigslide.config', [
    'autoplayMs' => $displayData->getAutoplayMs(),
    'boxAlign' => $displayData->getBoxAlign(),
    'displayNavigationPrevNext' => $displayData->displayNavigationPrevNext(),
    'displayNavigationDots' => $displayData->displayNavigationDots(),
]);

$layout = $displayData->getLayout();

if ($displayData->existsErrors()) {
    require sprintf('%s/%s_%s', __DIR__, $layout, 'errors.php');
    return;
}

if ($displayData->existsMessage()) {
    require sprintf('%s/%s_%s', __DIR__, $layout, 'message.php');
}
?>

<<?= $displayData->getModuleTag() ?> class="<?php echo 'mod_qlbigslide ' . $displayData->getModuleClassSuffix(); ?>">
<?php if ($displayData->showTitle()) : ?>
    <<?= $displayData->getHeaderTag() ?>><?php echo Text::_('MOD_QLBIGSLIDE_TITLE'); ?></<?= $displayData->getHeaderTag() ?>>
<?php endif; ?>
<div class="module-content">
    <div class="slider" id="heroSlider" aria-roledescription="carousel">
        <div class="slider__viewport">
            <div class="slider__track">
                <?php if ($displayData->hasSlides()): ?>
                    <?php
                    $slides = $displayData->getSlides()->get();
                    $totalSlides = count($slides);
                    $index = 1;
                    ?>
                    <?php foreach ($slides as $slide): ?>
                        <?php if (!$slide->isDisplay() || !$slide->existsImage()) {
                            continue;
                        } ?>
                        <section class="slide"
                                 aria-label="<?= Text::sprintf('MOD_QLBIGSLIDE_SLIDE_ARIA_LABEL', $index, $totalSlides); ?>">
                            <img src="<?= $slide->getImage() ?>" alt="">
                            <div class="slide__caption">
                                <?php if ($slide->existsTitle()) : ?><h2><?= $slide->getTitle(); ?></h2><?php endif; ?>
                                <?php if ($slide->existsText()) : ?><?= $slide->getText(); ?><?php endif; ?>
                            </div>
                        </section>
                        <?php $index++; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Prev / Next (can be hidden by config) -->
        <button class="slider__btn slider__btn--prev" type="button" aria-label="Previous slide">&lt;</button>
        <button class="slider__btn slider__btn--next" type="button" aria-label="Next slide">&gt</button>

        <!-- Dots (can be hidden by config) -->
        <div class="slider__dots" aria-label="Slide navigation"></div>

        <!-- Start / Pause -->
        <div class="slider__controls">
            <button class="slider__controlBtn" type="button" data-action="start">Start</button>
            <button class="slider__controlBtn" type="button" data-action="pause">Pause</button>
        </div>
    </div>


    <?php echo $displayData->getMessage(); ?>
</div>
</<?= $displayData->getModuleTag() ?>>
