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

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/blocks/configurable_reports/components/plugin_form.class.php');

class coursecategory_form extends plugin_form {
    
    function definition() {
        $mform =& $this->_form;

        $mform->addElement('header', 'plughead', get_string('coursefield','block_configurable_reports'), '');

		$options = array(get_string('top'));
        $parents = array();
		make_categories_list($options, $parents);
		$mform->addElement('select', 'categoryid', get_string('category'), $options);

        $this->add_action_buttons();
    }

}

?>