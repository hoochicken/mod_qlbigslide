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

/** @var DisplayModel $data */



// Get the WebAsset Manager
$document = Factory::getApplication()->getDocument();
$wa = $document->getWebAssetManager();
$wa->getRegistry()->addExtensionRegistryFile('mod_qlbigslide');
$wa->useScript('mod_qlbigslide.script');

if ($data->hasErrors()) {
    require __DIR__ . '/error.php';
    return;
} ?>

<div class="<?php echo 'mod_qlbigslide ' . $data->getModuleClassSuffix(); ?>">
    <?php if ($data->showTitle()) : ?>
        <h3><?php echo Text::_('MOD_QLBIGSLIDE_TITLE'); ?></h3>
    <?php endif; ?>
    <div class="module-content">
        <div class="slider" id="heroSlider" aria-roledescription="carousel">
            <div class="slider__viewport">
                <div class="slider__track">
                    <section class="slide" aria-label="Slide 1 of 3">
                        <img src="https://picsum.photos/id/1018/1200/600" alt="Mountain landscape">
                        <div class="slide__caption">
                            <h2>Slide title 1</h2>
                            <p>Short description goes here.</p>
                        </div>
                    </section>

                    <section class="slide" aria-label="Slide 2 of 3">
                        <img src="https://picsum.photos/id/1025/1200/600" alt="Dog portrait">
                        <div class="slide__caption">
                            <h2>Slide title 2</h2>
                            <p>Another description text.</p>
                        </div>
                    </section>

                    <section class="slide" aria-label="Slide 3 of 3">
                        <img src="https://picsum.photos/id/1039/1200/600" alt="Forest view">
                        <div class="slide__caption">
                            <h2>Slide title 3</h2>
                            <p>More info on this slide.</p>
                        </div>
                    </section>
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

</div>