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

namespace block_tag_flickr;

/**
 * Block Tag Flickr test class.
 *
 * @package   block_tag_flickr
 * @category  test
 * @copyright 2026 Stefan Topfstedt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
final class block_tag_flickr_test extends \advanced_testcase {
    /**
     * Testing the Flickr tag block's initial state after a new installation.
     *
     * @covers \xmldb_block_tag_flickr_install()
     * @return void
     */
    public function test_after_install(): void {
        global $DB;

        $this->resetAfterTest();

        // Assert that tag_flickr entry exists and that its visible attribute is set to 0 (disabled).
        $this->assertTrue($DB->record_exists('block', ['name' => 'tag_flickr', 'visible' => 0]));
    }
}
