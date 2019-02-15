<?php

/**
 * Displays images in a slideshow
 */
class BootStrapSlideshowBlock extends BootStrapBlock {
    private static $singular_name = 'Slideshow';
    private static $plural_name = 'Slideshows';

    private static $has_many = array(
        'Slides' => 'BootStrapSlide',
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->removeByName('Content');
        $slideField = $fields->dataFieldByName('Slides');
        $config = $slideField->getConfig();
        $config->addComponent(new GridFieldSortableRows(('SortID')));
        return $fields;
    }
}

class BootStrapSlide extends DataObject {
    private static $db = array(
        'SortID' => 'Int',
    );
    private static $has_one = array(
        'Link' => 'Link',
        'Image' => 'Image',
        'Slideshow' => 'BootStrapSlideshowBlock',
    );

    private static $summary_fields = array (
        'Link.URL' => 'Link',
        'Image.CMSThumbnail' => 'Image'
    );

    public static $default_sort = 'SortID';

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->removeByName('SortID');
        $fields->replaceField('LinkID', LinkField::create('LinkID', 'Link'));
        return $fields;
    }
}
