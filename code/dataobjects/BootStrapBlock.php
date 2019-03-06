<?php

namespace Twohill\Legacy\dataobjects;

use SilverStripe\ORM\DataObject;
use SilverStripe\View\Parsers\URLSegmentFilter;
use SilverStripe\Core\ClassInfo;


/**
 * BootStrapBlocks are very similar to Blocks, but they live inside BootStrapRows
 */
class BootStrapBlock extends DataObject
{

    private static $singular_name = 'Block';
    private static $plural_name = 'Blocks';

    private static $table_name = "BootStrapBlock";

    public function getShortClassName()
    {
        try {
            return (new \ReflectionClass($this))->getShortName();
        } catch (\ReflectionException $e) {
        }
    }

    private static $db = array(
        'Title' => 'Varchar(255)',
        'ShowTitle' => 'Boolean',
        'BootStrapColumnClass' => 'Varchar(20)',
        'Content' => 'HTMLText',
        'Sort' => 'Int'
    );

    private static $has_one = array(
        'BootStrapRow' => BootStrapRow::class,
    );


    private static $default_sort = array('Sort' => 'ASC');


    public function getCSSClass()
    {
        $filter = URLSegmentFilter::create();
        return $filter->filter($this->Title);
    }

    /**
     * Traverses up the class ancestry looking for templates
     * If you inherit from BootStrap block you can choose to create a template for the class name
     *
     * @return String the formatted block
     */
    public function getFormattedBlock()
    {
        $matches = array();

        foreach (array_reverse(ClassInfo::ancestry($this)) as $className) {
            $matches[] = $className;

            if ($className == "BootStrapBlock") {
                break;
            }
        }
        return $this->renderWith($matches);
    }
}
