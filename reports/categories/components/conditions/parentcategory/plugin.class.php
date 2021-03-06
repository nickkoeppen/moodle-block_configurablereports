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

/** Configurable Reports
  * A Moodle block for creating customizable reports
  * @package blocks
  * @author: Juan leyva <http://www.twitter.com/jleyvadelgado>
  * @date: 2009
  */ 

require_once($CFG->dirroot.'/blocks/configurable_reports/components/conditions/plugin.class.php');

class plugin_parentcategory extends conditions_plugin{
	
	function summary($instance){
	    if(! ($data = $instance->configdata)){
	        return '';
	    }
		global $DB;
		
		if ($cat = $DB->get_record('course_categories', array('id' => $data->categoryid))) {
			return format_string(get_string('category').' '.$cat->name);
		} else {
			return get_string('category').' '.get_string('top');
		}
	}
	
	function has_form(){
	    return true;
	}
	
	function execute($instance){
	    if(! ($data = $instance->configdata)){
	        return '';
	    }
		global $DB, $CFG;
		require_once($CFG->dirroot.'/course/lib.php');
		
		$catids = array();
		if (isset($data->includesubcats)) {
			if ($category = $DB->get_record('course_categories', array('id' => $data->categoryid))) {				
				make_categories_list($options, $parents, '', 0, $category);
			} else {
				make_categories_list($options, $parents);
			}
			unset($options[$data->categoryid]);			
			$catids = array_keys($options);
		} else {
			$catids = $DB->get_fieldset_select('course_categories', 'id', 'parent = ?', array($data->categoryid));
		}
		
		return $catids;
	}
	
}

?>