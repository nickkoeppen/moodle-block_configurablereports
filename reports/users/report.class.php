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

require_once("$CFG->dirroot/blocks/configurable_reports/reports/report_dataset.class.php");

class report_users extends report_dataset_base{

    function component_classes(){
        return array(
            'columns'     => 'component_columns_user',
            'conditions'  => 'component_conditions_user',
            'ordering'    => 'component_ordering_user',
            'filters'     => 'component_filters_user',
            'contexts'    => 'component_contexts_user',
            'permissions' => 'component_permissions',
            'calcs'       => 'component_calcs',
            'plot'        => 'component_plot',
            'template'    => 'component_template',
        );
    }
    
	function get_all_elements(){
		global $DB;
		
		$elements = array();
		$rs = $DB->get_recordset('user', null, '', 'id');
        foreach ($rs as $result) {
			$elements[] = $result->id;
		}
		$rs->close();
		
		return $elements;
	}
	
	function get_rows(array $elements, $sqlorder = ''){
		global $DB;
	
		if (empty($elements)) {
		    return array();
		}
		list($usql, $params) = $DB->get_in_or_equal($elements);	
		
		return $DB->get_records_select('user', "id $usql", $params, $sqlorder);
	}
	
}

?>