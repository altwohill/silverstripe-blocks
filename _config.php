<?php
//define global path to Components' root folder
use SilverStripe\Core\Config\Config;

Config::inst()->update('LeftAndMain','extra_requirements_javascript', array("sheadawson/silverstripe-blocks: javascript/blocks-cms.js"));
Config::inst()->update('BlockAdmin','menu_icon', 'sheadawson/silverstripe-blocks: images/blocks.png');
