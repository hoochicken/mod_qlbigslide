<?php
/**
 * @package     Hoochicken\Module\Qlbigslide
 *
 * @copyright   Copyright (C) 2026 Mareike Riegel. All rights reserved.
 * @license     GNU General Public License version 2 or later;
 */

namespace Hoochicken\Module\Qlbigslide\Site\Helper;

defined('_JEXEC') or die;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\Registry\Registry;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\Database\DatabaseInterface;

class QlbigslideHelper
{
    public static function transFormSpecialChars(string $string, bool $specialChars = true): string
{
    if ($specialChars) {
        return $string;
    }
    return htmlspecialchars($string);
}

    public function getMessage(Registry $params, $app): string
    {
        try {
            // Get the Joomla database object
            $db = Factory::getContainer()->get(DatabaseInterface::class);

            // Example database query
            /*
            $query = $db->getQuery(true)
                ->select($db->quoteName(['id', 'title', 'alias']))
                ->from($db->quoteName('#__content'))
                ->where($db->quoteName('state') . ' = 1')
                ->order($db->quoteName('ordering') . ' ASC');
            
            $db->setQuery($query);
            $items = $db->loadObjectList();
            */

            // Example: Get parameters
            $message = $params->get('message', '');
            $showTitle = $params->get('show_title', 1);

            // Example: Load component parameters
            /*
            $componentParams = ComponentHelper::getParams('com_content');
            $defaultLimit = $componentParams->get('default_limit', 10);
            */

            // Example: Process data
            /*
            foreach ($items as &$item) {
                $item->link = Route::_('index.php?option=com_content&view=article&id=' . $item->id);
                $item->introtext = HTMLHelper::_('content.prepare', $item->introtext);
            }
            */
            return 'This is the message';

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}