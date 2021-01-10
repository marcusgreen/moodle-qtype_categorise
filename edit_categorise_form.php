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
 * Defines the editing form for the categorise question type.
 *
 * @package    qtype
 * @subpackage categorise
 * @copyright  2020 Marcus Green

 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * categorise question editing form definition.
 *
 * @copyright  2020 Marcus Green

 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_categorise_edit_form extends question_edit_form {

    protected function definition_inner($mform) {
        global $PAGE, $OUTPUT;
        $PAGE->requires->js_call_amd('qtype_categorise/questionedit', 'init');

        $mform->removeelement('questiontext');

        $qt = $mform->createElement('editor', 'questiontext',
            get_string('questiontext', 'question'), array('rows' => 5),
        $this->editoroptions);

        $this->insert_element_before($mform, $qt,'defaultmark');

        $mform->removeelement('generalfeedback');

        $mform->addElement('header', 'categories', 'Categories');
        $mform->setExpanded('categories', true);

        $table = '<div id="example-table"></div>';
        $mform->addElement('html', $table);

        $html = $OUTPUT->render_from_template('qtype_categorise/fields', ['firstname' => 'marcus']);
        $musform[] = $mform->createElement('html', $html);
        $mform->addGroup($musform, '', '', false);

        $mform->addElement('header', 'feedback', 'General Feedback');

        $mform->addElement('editor', 'generalfeedback',
        'General feedback', array('rows' => 5),
            $this->editoroptions);
        $this->add_combined_feedback_fields(true);
        // Adds hinting features.
        $this->add_interactive_settings(true, true);
    }
    /**
     * Insert element after another element
     * @param $element
     * @param $namebefore
     * @return html_quickform_element|object
     */
    public function insert_element_before($mform, $element, $namebefore) {
        if (!$mform->elementExists($namebefore)) {
            $error = $mform::raiseError(null, QUICKFORM_NONEXIST_ELEMENT, null, E_USER_WARNING, "Element '$namebefore' does not exist in HTML_QuickForm::insertElementAfter()", 'HTML_QuickForm_Error', true);
            return $error;
        }
        $namebeforeelementindex = $mform->_elementIndex[$namebefore];
        $nextelement = \array_keys($mform->_elementIndex, $namebeforeelementindex + 1);
        if (isset($nextelement[0])) {
            return $mform->insertElementBefore($element, $nextelement[0]);
        } else {
            // There is no next element, just add it to the end of the form.
            return $mform->addElement($element);
        }
    }
    protected function data_preprocessing($question) {
        $question = parent::data_preprocessing($question);
        $question = $this->data_preprocessing_hints($question);

        return $question;
    }

    public function qtype() {
        return 'categorise';
    }
}
