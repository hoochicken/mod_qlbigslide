<?php
/**
 * @package     Hoochicken\Module\Qlbigslide
 *
 * @copyright   Copyright (C) 2026 Mareike Riegel. All rights reserved.
 * @license     GNU General Public License version 2 or later;
 */

namespace Hoochicken\Module\Qlbigslide\Site\Dispatcher;

defined('_JEXEC') or die;

use Exception;
use Hoochicken\Module\Qlbigslide\Site\models\DisplayCustom;
use Hoochicken\Module\Qlbigslide\Site\models\SlideCollection;
use Hoochicken\Module\Qlbigslide\Site\models\SlideItem;
use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;
use Hoochicken\Module\Qlbigslide\Site\Helper\QlbigslideHelper;
use Joomla\Registry\Registry;

class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
    use HelperFactoryAwareTrait;

    const SLIDER_NUMBER_TOTAL = 10;

    private ?Registry $params = null;

    protected function getLayoutData()
    {
        try {
            $data = parent::getLayoutData();
            $this->params = new Registry($data['params']);

            /** @var QlbigslideHelper $helper */
            $helper = $this->getHelperFactory()->getHelper(QlbigslideHelper::class);

            $displayModel = new DisplayCustom($this->module?->parameter ?? null, $this->module);
            // $displayModel->setMessage($helper->getMessage($this->params, $this->getApplication()));

            $displayModel->setSlides($this->getSlideCollection($this->params));
            return $displayModel->toArray();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    private function getSlideCollection(Registry $params): SlideCollection
    {
        $slideCollection = new SlideCollection();
        foreach (range(1, self::SLIDER_NUMBER_TOTAL) as $slideNumber) {
            $slideItem = $this->getSlideItem($slideNumber, $params);
            $slideCollection->add($slideItem);
        }
        return $slideCollection;
    }

    private function getSlideItem(int $slideNumber, Registry $params): SlideItem
    {
        $slideItem = new SlideItem();
        $slideItem->setDisplay($params->get('slide' . $slideNumber . '_display', 0));
        $slideItem->setImage($params->get('slide' . $slideNumber . '_image', ''));
        $slideItem->setTitle($params->get('slide' . $slideNumber . '_title', ''));
        $slideItem->setText($params->get('slide' . $slideNumber . '_text', ''));
        return $slideItem;
    }
}
