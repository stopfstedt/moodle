<?php
// This file is part of Moodle - https://moodle.org/
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
 * The interface library between the core and the subsystem.
 *
 * @package     block_starredcourses
 * @copyright   2019 Stefan Topfstedt <stefan.topfstedt@ucsf.edu>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Pre-delete course hook to cleanup any records with references to the deleted course.
 *
 * @param stdClass $course The deleted course
 */
function block_starredcourses_pre_course_delete($course) {
    global $DB;

    $DB->delete_records('favourite', [
        'component' => 'core_course',
        'itemtype'  => 'courses',
        'itemid' => $course->id
    ]);
}
