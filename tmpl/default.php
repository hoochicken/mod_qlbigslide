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

// Get the WebAsset Manager
$document = Factory::getApplication()->getDocument();
$wa = $document->getWebAssetManager();
$wa->getRegistry()->addExtensionRegistryFile('mod_qlbigslide');
$wa->useScript('mod_qlbigslide.script');
$wa->useStyle('mod_qlbigslide.style');

$document->addScriptOptions('mod_qlbigslide.config', [
    'autoplayMs' => $data->getAutoplayMs(),
    'boxAlign' => $data->getBoxAlign(),
    'displayNavigationPrevNext' => $data->displayNavigationPrevNext(),
    'displayNavigationDots' => $data->displayNavigationDots(),
]);

if ($data->existsErrors()) {
    require __DIR__ . '/errors.php';
    return;
}

if ($data->existsMessage()) {
    require __DIR__ . '/message.php';
}
?>

<<?= $data->getModuleTag() ?> class="<?php echo 'mod_qlbigslide ' . $data->getModuleClassSuffix(); ?>">
<?php if ($data->showTitle()) : ?>
    <<?= $data->getHeaderTag() ?>><?php echo Text::_('MOD_QLBIGSLIDE_TITLE'); ?></<?= $data->getHeaderTag() ?>>
<?php endif; ?>
<div class="module-content">
    <div class="slider" id="heroSlider" aria-roledescription="carousel">
        <div class="slider__viewport">
            <div class="slider__track">
                <?php if ($data->hasSlides()): ?>
                    <?php
                    $slides = $data->getSlides()->get();
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


    <?php echo $data->getMessage(); ?>
</div>
</<?= $data->getModuleTag() ?>>
