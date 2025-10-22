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
 * Define all the backup steps that will be used by the
 * backup_pdfjsfolder_activity_task.
 *
 * @package    mod_pdfjsfolder
 * @copyright  2013 Jonas Nockert <jonasnockert@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Define the complete pdfjsfolder structure for backup, with file
 * and id annotations.
 */
class backup_pdfjsfolder_activity_structure_step extends backup_activity_structure_step {
    /**
     * Define structure function.
     */
    protected function define_structure() {
        // Define each element separated.
        $pdfjsfolder = new backup_nested_element(
            'pdfjsfolder',
            ['id'],
            ['name', 'intro', 'introformat', 'timecreated', 'timemodified']
        );

        // Define sources.
        $pdfjsfolder->set_source_table(
            'pdfjsfolder',
            ['id' => backup::VAR_ACTIVITYID]
        );

        // Define file annotations.
        $pdfjsfolder->annotate_files('mod_pdfjsfolder', 'intro', null);
        $pdfjsfolder->annotate_files('mod_pdfjsfolder', 'pdfs', null);

        // Return the root element (pdfjsfolder), wrapped into standard
        // activity structure.
        return $this->prepare_activity_structure($pdfjsfolder);
    }
}
