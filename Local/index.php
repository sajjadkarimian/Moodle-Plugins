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

require_once(__DIR__ . '/../../config.php');

require_login();

$systemcontext = context_system::instance();
require_capability('local/mycoursegroups:view', $systemcontext);

$defaultview = get_config('local_mycoursegroups', 'defaultview') ?: 'card';
$view = optional_param('view', $defaultview, PARAM_ALPHA);
if (!in_array($view, ['card', 'list'])) {
    $view = $defaultview;
}

$PAGE->set_url(new moodle_url('/local/mycoursegroups/index.php', ['view' => $view]));
$PAGE->set_context($systemcontext);
$PAGE->set_pagelayout('standard');
$PAGE->set_title(get_string('groupedcourses', 'local_mycoursegroups'));
$PAGE->set_heading(get_string('groupedcourses', 'local_mycoursegroups'));
$PAGE->set_primary_active_tab('myhome');

$service = new \local_mycoursegroups\local\course_service();
$templatecontext = $service->build_page_context($USER, $view);

echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_mycoursegroups/groupedcourses', $templatecontext);
echo $OUTPUT->footer();
