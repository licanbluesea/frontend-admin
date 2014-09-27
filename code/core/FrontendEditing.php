<?php

class FrontendEditing {

    /**
     * Remember the classname and the ID for the given $dbField
     * @param DBField $dbField
     * @param $value
     * @param null $record
     */
    public static function setValue(DBField $dbField, $value, $record = null) {
        if (Controller::curr() instanceof Page_Controller && Permission::check('ADMIN')) {
            if ($record && is_object($record) && $dbField->getName()) {
                $dbField->makeEditable  = true;
                $dbField->editClassName = $record->ClassName;
                $dbField->editID        = $record->ID;
            }
        }
    }

    /**
     * returns if the dbfield is editable
     * @param DBField $dbField
     * @return bool
     */
    public static function isEditable(DBField $dbField) {
        return isset($dbField->makeEditable) && $dbField->makeEditable;
    }

    /**
     * returns the classname for the given DBField
     * @param DBField $dbField
     * @return mixed
     */
    public static function getClassName(DBField $dbField) {
        return $dbField->editClassName;
    }

    /**
     * returns the ID for the given DBField
     * @param DBField $dbField
     * @return mixed
     */
    public static function getID(DBField $dbField) {
        return $dbField->editID;
    }

    public static function editingEnabled() {
        return (Cookie::get('editmode') !== 'false') && !Controller::curr()->getRequest()->offsetExists('stage');
    }

}
