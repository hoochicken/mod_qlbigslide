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
use Hoochicken\Module\Qlbigslide\Site\models\DisplayModel;
use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;
use Hoochicken\Module\Qlbigslide\Site\Helper\QlbigslideHelper;

class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
    use HelperFactoryAwareTrait;

    protected function getLayoutData()
    {
        try {
            $data = parent::getLayoutData();

            /** @var QlbigslideHelper $helper */
            $helper = $this->getHelperFactory()->getHelper('QlbigslideHelper');

            $displayModel = new DisplayModel($this->module?->parameter ?? null, $this->module);
            $displayModel->message = $helper->getMessage($data['params'], $this->getApplication());

            return $displayModel->toArray();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}