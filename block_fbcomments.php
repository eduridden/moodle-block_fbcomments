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
 * The Facebook Comments block is a Moodle block to allow the display and posting of facebook comments.
 * 
 * @package    block
 * @subpackage Facebook Comments
 * @copyright  2013 Julian Ridden - http://www.moodleman.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_fbcomments extends block_base {

    function init() {
        global $PAGE;
        $this->title = get_string('pluginname', 'block_fbcomments');       
    }

    function applicable_formats() {
        return array('all' => true);
    }

    function specialization() {
        $this->title = isset($this->config->title) ? format_string($this->config->title) : ''; 
    }

    function instance_allow_multiple() {
        return false;
    }

    function get_content() {
        global $PAGE,$CFG;
        require_once($CFG->libdir . '/filelib.php');
        
        if(!isset($this->config))$this->config = new stdClass();
        $this->config->url= (isset($this->config->url)) ? $this->config->url : '';
        $this->config->width = (isset($this->config->width)) ? $this->config->width : 200;
        $this->config->numposts = (isset($this->config->numposts)) ? $this->config->numposts : 10;
        $this->config->title = (isset($this->config->title)) ? $this->config->title : '';

        if ($this->content !== NULL) {
            return $this->content;
        }
        
        $this->content = new stdClass;
        $this->content->footer = '';
        $this->content->text = $this->genFBcommentsFrontend();
        return $this->content;
    }
    
    function genFBcommentsFrontend(){
    	global $CFG,$DB,$PAGE,$COURSE,$FULLSCRIPT;
    	$return_url = $FULLSCRIPT;
 	           
        $context = get_context_instance(CONTEXT_BLOCK, $this->instance->id);
        $admin_context = get_context_instance(CONTEXT_COURSE, $COURSE->id);

		$appid = $this->config->appid;
		
                         
            $html = '<div id="fb-root"></div> ' .
					'<script type="text/javascript" src="/blocks/fbcomments/facebook.js"></script> ' .
					'<div class="fb-comments" data-href="' . $this->config->url . '" data-width="' . $this->config->width . '" data-num-posts="' . $this->config->numposts . '"></div>';
                
    	return $html;
    }


    /**
     * Serialize and store config data
     */
    function instance_config_save($data, $nolongerused = false) {
        global $DB;

        $config = clone($data);
        parent::instance_config_save($config, $nolongerused);
    }

    function instance_delete() {
        global $DB;
        $fs = get_file_storage();
        $fs->delete_area_files($this->context->id, 'block_fbcomments');
        return true;
    }

    public function instance_can_be_docked() {
    	return false;
    }
}

?>