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
 * Steps definitions related to mod_pdfjsfolder.
 *
 * @package    mod_pdfjsfolder
 * @category   test
 * @copyright  2013 Jonas Nockert <jonasnockert@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../../lib/behat/behat_base.php');

use Behat\Mink\Exception\ExpectationException;
use Behat\Mink\Exception\ElementNotFoundException;
use Behat\Gherkin\Node\TableNode;

/**
 * Steps definitions related to mod_pdfjsfolder.
 *
 * @package    pdfjsfolder
 * @category   test
 * @copyright  2025 Luca Bösch <luca.boesch@bfh.ch>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_mod_pdfjsfolder extends behat_base {
    /**
     * Convert page names to URLs for steps like 'When I am on the "[page name]" page'.
     *
     * Recognised page names are:
     * | None so far!      |                                                              |
     *
     * @param string $page name of the page, with the component name removed e.g. 'Admin notification'.
     * @return moodle_url the corresponding URL.
     * @throws Exception with a meaningful error message if the specified page cannot be found.
     */
    protected function resolve_page_url(string $page): moodle_url {
        switch ($page) {
            default:
                throw new Exception('Unrecognised pdfjsfolder page type "' . $page . '."');
        }
    }

    /**
     * Convert page names to URLs for steps like 'When I am on the "[identifier]" "[page type]" page'.
     *
     * Recognised page names are:
     * | pagetype          | name meaning                                | description                                  |
     * | View              | Student Quiz name                           | The student quiz info page (view.php)        |
     * | Edit              | Student Quiz name                           | The edit quiz page (edit.php)                |
     * | Statistics        | Student Quiz name                           | The Statistics report page                   |
     * | Ranking           | Student Quiz name                           | The Ranking page                             |
     *
     * @param string $type identifies which type of page this is, e.g. 'View'.
     * @param string $identifier identifies the particular page, e.g. 'Test student quiz'.
     * @return moodle_url the corresponding URL.
     * @throws Exception with a meaningful error message if the specified page cannot be found.
     */
    protected function resolve_page_instance_url(string $type, string $identifier): moodle_url {
        switch ($type) {
            case 'View':
                return new moodle_url(
                    '/mod/pdfjsfolder/view.php',
                    ['id' => $this->get_cm_by_pdfjsfolder_name($identifier)->id]
                );

            case 'Edit':
                return new moodle_url(
                    '/course/modedit.php',
                    ['update' => $this->get_cm_by_pdfjsfolder_name($identifier)->id]
                );

            default:
                throw new Exception('Unrecognised pdfjsfolder page type "' . $type . '."');
        }
    }

    /**
     * Get a pdfjsfolder by name.
     *
     * @param string $name pdfjsfolder name.
     * @return stdClass the corresponding DB row.
     */
    protected function get_pdfjsfolder_by_name(string $name): stdClass {
        global $DB;
        return $DB->get_record('pdfjsfolder', ['name' => $name], '*', MUST_EXIST);
    }

    /**
     * Get cmid from the pdfjsfolder name.
     *
     * @param string $name pdfjsfolder name.
     * @return stdClass cm from get_coursemodule_from_instance.
     */
    protected function get_cm_by_pdfjsfolder_name(string $name): stdClass {
        $pdfjsfolder = $this->get_pdfjsfolder_by_name($name);
        return get_coursemodule_from_instance('pdfjsfolder', $pdfjsfolder->id, $pdfjsfolder->course);
    }
}
