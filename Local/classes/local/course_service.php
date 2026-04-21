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

namespace local_mycoursegroups\local;

defined('MOODLE_INTERNAL') || die();

use context_course;
use core_course_list_element;
use core_text;
use moodle_url;
use stdClass;

class course_service {
    /**
     * Build the page context for the mustache template.
     *
     * @param stdClass $user
     * @param string $view
     * @return array
     */
    public function build_page_context(stdClass $user, string $view): array {
        global $DB, $CFG;

        $showcategoryheading = (bool)get_config('local_mycoursegroups', 'showcategorydescription');
        $showsummary = (bool)get_config('local_mycoursegroups', 'showcoursesummary');
        $summarylength = (int)(get_config('local_mycoursegroups', 'summarylength') ?: 120);

        $mycourses = enrol_get_my_courses(
            'id, fullname, shortname, category, summary, summaryformat, visible',
            'fullname ASC'
        );

        $grouped = [];

        foreach ($mycourses as $course) {
            $categoryname = get_string('uncategorised', 'core');
            if (!empty($course->category)) {
                $categoryrecord = $DB->get_record('course_categories', ['id' => $course->category], 'id, name', IGNORE_MISSING);
                if ($categoryrecord) {
                    $categoryname = format_string($categoryrecord->name);
                }
            }

            if (!isset($grouped[$categoryname])) {
                $grouped[$categoryname] = [];
            }

            $coursecontext = context_course::instance($course->id);
            $courseelement = new core_course_list_element($course);

            $imageurl = '';
            if ($courseelement->has_course_overviewfiles()) {
                foreach ($courseelement->get_course_overviewfiles() as $file) {
                    if ($file->is_valid_image()) {
                        $imageurl = file_encode_url(
                            $CFG->wwwroot . '/pluginfile.php',
                            '/' . $file->get_contextid() . '/' . $file->get_component() . '/' .
                            $file->get_filearea() . $file->get_filepath() . $file->get_filename(),
                            false
                        );
                        break;
                    }
                }
            }

            $summary = '';
            if ($showsummary && !empty($course->summary)) {
                $summary = format_text(
                    $course->summary,
                    $course->summaryformat,
                    ['context' => $coursecontext, 'para' => false, 'filter' => true]
                );
                $summary = trim(strip_tags($summary));
                if ($summarylength > 0 && core_text::strlen($summary) > $summarylength) {
                    $summary = core_text::substr($summary, 0, $summarylength) . '…';
                }
            }

            $grouped[$categoryname][] = [
                'id' => $course->id,
                'fullname' => format_string($course->fullname),
                'shortname' => format_string($course->shortname),
                'summary' => $summary,
                'url' => (new moodle_url('/course/view.php', ['id' => $course->id]))->out(false),
                'imageurl' => $imageurl,
                'hasimage' => !empty($imageurl),
                'noimagealt' => get_string('hasnooverviewimage', 'local_mycoursegroups'),
            ];
        }

        $categories = [];
        foreach ($grouped as $categoryname => $courses) {
            $categories[] = [
                'categoryname' => $categoryname,
                'showcategoryheading' => $showcategoryheading,
                'courses' => array_values($courses),
            ];
        }

        return [
            'title' => get_string('groupedcourses', 'local_mycoursegroups'),
            'viewiscard' => $view === 'card',
            'viewislist' => $view === 'list',
            'cardviewurl' => (new moodle_url('/local/mycoursegroups/index.php', ['view' => 'card']))->out(false),
            'listviewurl' => (new moodle_url('/local/mycoursegroups/index.php', ['view' => 'list']))->out(false),
            'viewlabel' => get_string('view', 'local_mycoursegroups'),
            'cardlabel' => get_string('viewcard', 'local_mycoursegroups'),
            'listlabel' => get_string('viewlist', 'local_mycoursegroups'),
            'categories' => $categories,
        ];
    }
}
