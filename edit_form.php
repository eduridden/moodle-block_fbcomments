<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Form for editing Facebook Comments block instances.
 *
 * @package    block
 * @subpackage Facebook Comments
 * @copyright  2013 Julian Ridden - http://www.moodleman.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_fbcomments_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        // Fields for editing block title and contents.
              
        $mform->addElement('text', 'config_url', get_string('url', 'block_fbcomments'));
        $mform->setType('config_url', PARAM_TEXT); 
        $mform->setDefault('config_url', 'your adress here');

		$mform->addElement('text', 'config_width', get_string('width', 'block_fbcomments'));
        $mform->setType('config_width', PARAM_INT); 
        $mform->setDefault('config_width', 200);
        
        $mform->addElement('text', 'config_numposts', get_string('numposts', 'block_fbcomments'));
        $mform->setType('config_numposts', PARAM_INT); 
        $mform->setDefault('config_numposts', 10);
        
        $mform->addElement('text', 'config_title', get_string('title', 'block_fbcomments'));
        $mform->setType('config_title', PARAM_TEXT); 
        $mform->setDefault('config_title', get_string('pluginname', 'block_fbcomments'));
        
        
    }
    function set_data($defaults) {
        parent::set_data($defaults);
    }

}
