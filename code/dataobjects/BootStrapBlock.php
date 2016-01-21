<?php

/**
 * BootStrapBlocks are very similar to Blocks, but they live inside BootStrapRows
 */
class BootStrapBlock extends Block{

	private static $singular_name = 'Block';
	private static $plural_name = 'Blocks';

	private static $db = array(
		'ShowTitle' => 'Boolean',
		'BootStrapColumnClass' => 'Varchar(20)',
		'Content' => 'HTMLText'
	);

	private static $has_one = array(
		'BootStrapRow' => 'BootStrapRow'
	);

	private static $summary_fields = array(
		'singular_name' => 'Block Type',
		'Title' => 'Title',
		'BootStrapColumnClass' => 'Column Spec'
	);

	public function getCSSClass() {
		$filter = URLSegmentFilter::create();
		return $filter->filter($this->Title);
	}

	/**
	 * Traverses up the class ancestry looking for templates
	 * If you inherit from BootStrap block you can choose to create a template for the class name
	 *
	 * @return String the formatted block
	 */
	public function getFormattedBlock() {
		$matches = array();

		foreach(array_reverse(ClassInfo::ancestry($this)) as $className) {
			$matches[] = $className;

			if($className == "BootStrapBlock") break;
		}
		return $this->renderWith($matches);
	}
}