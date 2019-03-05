<?php

namespace Twohill\Legacy\forms;

use SilverStripe\CMS\Controllers\CMSPageEditController;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Control\Controller;
use SilverStripe\Forms\ReadonlyField;
use Symbiote\GridFieldExtensions\GridFieldEditableColumns;
use SilverStripe\Forms\DropdownField;
use Twohill\Legacy\BlockManager;
use Twohill\Legacy\dataobjects\BlockSet;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldButtonRow;
use SilverStripe\Forms\GridField\GridFieldToolbarHeader;
use SilverStripe\Forms\GridField\GridFieldDetailForm;
use SilverStripe\Forms\GridField\GridFieldSortableHeader;
use SilverStripe\Forms\GridField\GridFieldFilterHeader;
use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use Symbiote\GridFieldExtensions\GridFieldAddExistingSearchButton;
use Twohill\Legacy\dataobjects\Block;

/**
 * GridFieldConfig_BlockManager
 * Provides a reusable GridFieldConfig for managing Blocks
 * @package silverstipe blocks
 * @author Shea Dawson <shea@livesource.co.nz>
 */
class GridFieldConfig_BlockManager extends GridFieldConfig{

	public $blockManager;

	public function __construct($canAdd = true, $canEdit = true, $canDelete = true, $editableRows = false, $aboveOrBelow = false) {
		parent::__construct();

		$this->blockManager = Injector::inst()->get(BlockManager::class);
		$controllerClass = Controller::curr()->class;
		// Get available Areas (for page) or all in case of ModelAdmin
		if($controllerClass == CMSPageEditController::class){
			$currentPage = Controller::curr()->currentPage();
			$areasFieldSource = $this->blockManager->getAreasForPageType($currentPage->ClassName);
		} else {
			$areasFieldSource = $this->blockManager->getAreasForTheme();
		}

		// EditableColumns only makes sense on Saveable parenst (eg Page), or inline changes won't be saved
		if($editableRows){
			$this->addComponent($editable = new GridFieldEditableColumns());
			$displayfields = array(
				'singular_name' => array('title' => 'Block Type', 'field' => ReadonlyField::class),
				'Title'        	=> array('title' => 'Title', 'field' => ReadonlyField::class),
				'BlockArea'	=> array(
					'title' => 'Block Area
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
						// the &nbsp;s prevent wrapping of dropdowns
					'callback' => function() use ($areasFieldSource){
							return DropdownField::create('BlockArea', 'Block Area', $areasFieldSource)
								->setHasEmptyDefault(true);
						}
				),
				'UsageListAsString' => array('title' => 'Used on', 'field' => ReadonlyField::class),
			);

			if($aboveOrBelow){
				$displayfields['AboveOrBelow'] = array(
					'title' => 'Above or Below',
					'callback' => function() {
						return DropdownField::create('AboveOrBelow', 'Above or Below', BlockSet::config()->get('above_or_below_options'));
					}
				);
			}
			$editable->setDisplayFields($displayfields);
		} else {
			$this->addComponent($dcols = new GridFieldDataColumns());

			$displayfields = array(
				'singular_name' => 'Block Type',
				'Title' => 'Title',
				'BlockArea' => 'Block Area',
				'UsageListAsString' => 'Used on'
			);
			$dcols->setDisplayFields($displayfields);
			$dcols->setFieldCasting(array("UsageListAsString"=>"HTMLText->Raw"));
		}

		$this->addComponent(new GridFieldButtonRow('before'));
		$this->addComponent(new GridFieldToolbarHeader());
		$this->addComponent(new GridFieldDetailForm());
		$this->addComponent($sort = new GridFieldSortableHeader());
		$this->addComponent($filter = new GridFieldFilterHeader());
		$this->addComponent(new GridFieldDetailForm());

		$filter->setThrowExceptionOnBadDataType(false);
		$sort->setThrowExceptionOnBadDataType(false);

		if($canAdd){
			$multiClass = new GridFieldAddNewMultiClass();
			$classes = $this->blockManager->getBlockClasses();
			$multiClass->setClasses($classes);
			$this->addComponent($multiClass);
			//$this->addComponent(new GridFieldAddNewButton());
		}

		if($canEdit){
			$this->addComponent(new GridFieldEditButton());
		}

		if($canDelete){
			$this->addComponent(new GridFieldDeleteAction(true));
		}

		return $this;

	}


	/**
	 * Add the GridFieldAddExistingSearchButton component to this grid config
	 * @return $this
	 **/
	public function addExisting(){
		$this->addComponent($add = new GridFieldAddExistingSearchButton());
		$add->setSearchList(Block::get());
		return $this;
	}


}
