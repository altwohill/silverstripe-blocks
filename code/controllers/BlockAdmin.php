<?php

namespace Twohill\Legacy\controllers;


use SilverStripe\Admin\ModelAdmin;
use SilverStripe\Versioned\Versioned;
use Twohill\Legacy\BlockManager;
use Twohill\Legacy\dataobjects\Block;
use Twohill\Legacy\dataobjects\BlockSet;
use Twohill\Legacy\forms\GridFieldConfig_BlockManager;


/**
 * BlockAdmin
 * @package silverstipe blocks
 * @author Shea Dawson <shea@silverstripe.com.au>
 */
class BlockAdmin extends ModelAdmin
{

    private static $managed_models = [Block::class, BlockSet::class];

    private static $url_segment = 'block-admin';

    private static $menu_title = "Blocks";
    private static $menu_icon = 'sheadawson/silverstripe-blocks: images/blocks.png';

    public $showImportForm = false;

    private static $dependencies = array(
        'blockManager' => '%$' . BlockManager::class,
    );

    public $blockManager;


    /**
     * @return array
     **/
    public function getManagedModels()
    {
        $models = parent::getManagedModels();

        // remove blocksets if not in use (set in config):
        if (!$this->blockManager->getUseBlockSets()) {
            unset($models['BlockSet']);
        }

        return $models;
    }


//    /**
//     * @return Form
//     **/
//    public function getEditForm($id = null, $fields = null)
//    {
//        Versioned::set_reading_mode('Stage');
//        $form = parent::getEditForm($id, $fields);
//
//        if ($blockGridField = $form->Fields()->fieldByName('Block')) {
//            $blockGridField->setConfig(GridFieldConfig_BlockManager::create(true, true, false));
//            $config = $blockGridField->getConfig();
//            $dcols = $config->getComponentByType('GridFieldDataColumns');
//            $dfields = $dcols->getDisplayFields($blockGridField);
//            unset($dfields['BlockArea']);
//            $dcols->setDisplayFields($dfields);
//        }
//
//        return $form;
//    }
}
