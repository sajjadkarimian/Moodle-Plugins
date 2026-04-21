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

defined('MOODLE_INTERNAL') || die();

/**
 * Extend site admin navigation.
 *
 * @param settings_navigation $settingsnav
 * @param navigation_node $node
 */
function local_mycoursegroups_extend_settings_navigation(settings_navigation $settingsnav, navigation_node $node): void {
    global $PAGE;

    if (!isloggedin() || isguestuser()) {
        return;
    }

    if (has_capability('local/mycoursegroups:view', context_system::instance())) {
        $url = new moodle_url('/local/mycoursegroups/index.php');
        $label = get_string('navigationlabel', 'local_mycoursegroups');
        $node->add($label, $url, navigation_node::TYPE_SETTING, null, 'local_mycoursegroups');
    }
}
