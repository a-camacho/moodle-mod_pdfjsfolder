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
 * This file keeps track of upgrades to the pdfjsfolder module.
 *
 * Sometimes, changes between versions involve alterations to database
 * structures and other major things that may break installations. The upgrade
 * function in this file will attempt to perform all the necessary actions to
 * upgrade your older installation to the current version. If there's something
 * it cannot do itself, it will tell you what you need to do.  The commands in
 * here will all be database-neutral, using the functions defined in DLL libraries.
 *
 * @package    mod_pdfjsfolder
 * @copyright  2013 Jonas Nockert <jonasnockert@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Execute pdfjsfolder upgrade from the given old version.
 *
 * @param int $oldversion
 * @return bool
 */
function xmldb_pdfjsfolder_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager(); // Loads ddl manager and xmldb classes.

    if ($oldversion < 2025061206) {
        // Define field autoimport to be added to publication.
        $table = new xmldb_table('pdfjsfolder');
        // Conditionally launch add field showfilechangeswarning.
        $field = new xmldb_field('showfilechangeswarning');
        $field->set_attributes(XMLDB_TYPE_INTEGER, '4', null, XMLDB_NOTNULL, null, '0', 'showfilechangeswarning');
        if (!$dbman->field_exists($table, 'showfilechangeswarning')) {
            $dbman->add_field($table, $field);
        }
        // Assign savepoint reached.
        upgrade_mod_savepoint(true, 2025061206, 'pdfjsfolder');
    }

    if ($oldversion < 2025103102) {
        $table = new xmldb_table('pdfjsfolder');
        $field = new xmldb_field('introformat', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, '0', 'intro');
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        upgrade_mod_savepoint(true, 2025103102, 'pdfjsfolder');
    }

    if ($oldversion < 2025111201) {
        $table = new xmldb_table('pdfjsfolder');
        $field = new xmldb_field(
            'uselegacyviewer',
            XMLDB_TYPE_INTEGER,
            '2',
            null,
            XMLDB_NOTNULL,
            null,
            '0',
            'showfilechangeswarning'
        );
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        upgrade_mod_savepoint(true, 2025111201, 'pdfjsfolder');
    }

    if ($oldversion < 2026012201) {
        $DB->delete_records('pdfjsfolder', ['id' => 0]);
        $module = $DB->get_record('modules', ['name' => 'pdfjsfolder']);
        if ($module) {
            $DB->delete_records('course_modules', ['module' => $module->id, 'instance' => 0]);
            rebuild_course_cache(0, true);
        }
        upgrade_mod_savepoint(true, 2026012201, 'pdfjsfolder');
    }

    if ($oldversion < 2026012203) {
        // Delete broken PDF.js folder activities records.
        $DB->delete_records('pdfjsfolder', ['id' => 0]);
        $module = $DB->get_record('modules', ['name' => 'pdfjsfolder']);
        if ($module) {
            $DB->delete_records('course_modules', ['module' => $module->id, 'instance' => 0]);
        }
        // Make sure that the DB schema is correct (primary key).
        $columns = $DB->get_columns('pdfjsfolder');
        if (isset($columns['id']) && empty($columns['id']->auto_increment)) {
            $table = new xmldb_table('pdfjsfolder');
            $field = new xmldb_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
            $key = new xmldb_key('primary', XMLDB_KEY_PRIMARY, ['id']);
            if (!$dbman->find_key_name($table, $key)) {
                $dbman->add_key($table, $key);
            }
            if ($dbman->field_exists($table, $field)) {
                $dbman->change_field_type($table, $field);
            }
        }
        upgrade_mod_savepoint(true, 2026012203, 'pdfjsfolder');
    }

    // Final return of upgrade result (true, all went good) to Moodle.
    return true;
}
