<?php
//define global path to Components' root folder
use SilverStripe\Admin\LeftAndMain;
use SilverStripe\Core\Config\Config;

Config::inst()->modify()->set(LeftAndMain::class,'extra_requirements_javascript', array("sheadawson/silverstripe-blocks: javascript/blocks-cms.js"));
