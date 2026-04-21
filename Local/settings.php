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

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_mycoursegroups', get_string('settings', 'local_mycoursegroups'));

    $settings->add(new admin_setting_heading(
        'local_mycoursegroups/info',
        get_string('pluginname', 'local_mycoursegroups'),
        get_string('mycourseslinknote', 'local_mycoursegroups')
    ));

    $settings->add(new admin_setting_configselect(
        'local_mycoursegroups/defaultview',
        get_string('defaultview', 'local_mycoursegroups'),
        get_string('defaultview_desc', 'local_mycoursegroups'),
        'card',
        [
            'card' => get_string('defaultview_card', 'local_mycoursegroups'),
            'list' => get_string('defaultview_list', 'local_mycoursegroups'),
        ]
    ));

    $settings->add(new admin_setting_configcheckbox(
        'local_mycoursegroups/showcoursesummary',
        get_string('showcoursesummary', 'local_mycoursegroups'),
        get_string('showcoursesummary_desc', 'local_mycoursegroups'),
        1
    ));

    $settings->add(new admin_setting_configtext(
        'local_mycoursegroups/summarylength',
        get_string('summarylength', 'local_mycoursegroups'),
        get_string('summarylength_desc', 'local_mycoursegroups'),
        120,
        PARAM_INT
    ));

    $settings->add(new admin_setting_configcheckbox(
        'local_mycoursegroups/showcategorydescription',
        get_string('showcategorydescription', 'local_mycoursegroups'),
        get_string('showcategorydescription_desc', 'local_mycoursegroups'),
        1
    ));

    $ADMIN->add('localplugins', $settings);
}
