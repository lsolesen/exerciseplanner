<?php

/**
 * ExerciseImage form.
 *
 * @package    form
 * @subpackage ExerciseImage
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ExerciseImageForm extends BaseExerciseImageForm
{
    public function configure()
    {
        unset($this['owner_id'],$this['width'],$this['height']);
        $this->setWidget('otype',new sfWidgetFormInputHidden(array('default'=>1)));

        $this->widgetSchema['filename']    = new sfWidgetFormInputFile(array('label' => 'Image'));
        $this->validatorSchema['filename'] = new sfValidatorFile(array('path' => sfConfig::get('sf_upload_dir').'/exercises','mime_types'=>'web_images'));
    }
//
//    public function processValues($values = null)
//    {
//        // see if the user has overridden some column setter
//        $valuesToProcess = $values;
//        foreach ($valuesToProcess as $field => $value)
//        {
//            $method = sprintf('update%sColumn', self::camelize($field));
//
//            if (method_exists($this, $method))
//            {
//                if (false === $ret = $this->$method($value))
//                {
//                    unset($values[$field]);
//                }
//                else
//                {
//                    $values[$field] = $ret;
//                }
//            }
//            else
//            {
//                // save files
//                if ($this->validatorSchema[$field] instanceof sfValidatorFile)
//                {
//                    sfContext::getInstance()->getLogger()->debug(__FUNCTION__.' FIELD IS FILE: '.$field);
//
//                    $values[$field] = $this->processUploadedFile($field, null, $valuesToProcess);
//
//                    sfContext::getInstance()->getLogger()->debug(__FUNCTION__.' FIELD IS CLASS: '.get_class($values[$field]));
//
//                }
//            }
//        }
//
//        return $values;
//    }
//
//    /**
//     * Saves the uploaded file for the given field.
//     *
//     * @param  string $field The field name
//     * @param  string $filename The file name of the file to save
//     * @param  array  $values An array of values
//     *
//     * @return string The filename used to save the file
//     */
//    protected function processUploadedFile($field, $filename = null, $values = null)
//    {
//        if (!$this->validatorSchema[$field] instanceof sfValidatorFile)
//        {
//            throw new LogicException(sprintf('You cannot save the current file for field "%s" as the field is not a file.', $field));
//        }
//
//        if (is_null($values))
//        {
//            $values = $this->values;
//        }
//
//        if (isset($values[$field.'_delete']) && $values[$field.'_delete'])
//        {
//            $this->removeFile($field);
//
//            return '';
//        }
//
//        if (!$values[$field])
//        {
//            sfContext::getInstance()->getLogger()->log('return this->object->field '.$this->object->$field);
//            return $this->object->$field;
//        }
//
//        // we need the base directory
//        if (!$this->validatorSchema[$field]->getOption('path'))
//        {
//            sfContext::getInstance()->getLogger()->log('return $values[$field] ');
//
//            return $values[$field];
//        }
//
//        $this->removeFile($field);
//
//        sfContext::getInstance()->getLogger()->log('return $this->saveFile($field, $filename) ');
//        return $this->saveFile($field, $filename);
//    }
//
//    /**
//     * Saves the current file for the field.
//     *
//     * @param  string          $field    The field name
//     * @param  string          $filename The file name of the file to save
//     * @param  sfValidatedFile $file     The validated file to save
//     *
//     * @return string The filename used to save the file
//     */
//    protected function saveFile($field, $filename = null, sfValidatedFile $file = null)
//    {
//        if (!$this->validatorSchema[$field] instanceof sfValidatorFile)
//        {
//            throw new LogicException(sprintf('You cannot save the current file for field "%s" as the field is not a file.', $field));
//        }
//        if (is_null($file))
//        {
//            $file = $this->getValue($field);
//        }
//
//        sfContext::getInstance()->getLogger()->log(__FUNCTION__.' '.get_class($file).' '.gettype($file));
//
//        $method = sprintf('generate%sFilename', $field);
//
//        if (!is_null($filename))
//        {
//            return $file->save($filename);
//        }
//        else if (method_exists($this->object, $method))
//        {
//            return $file->save($this->object->$method($file));
//        }
//        else
//        {
//            return $file->save();
//        }
//    }
//
    public function getValue($field)
    {
        sfContext::getInstance()->getLogger()->log(__FUNCTION__.' isBound() '.(($this->isBound) ? 'true':'false').' isset: '.((isset($this->values[$field]) ? 'true':'false')));

        return ( isset($this->values[$field])) ? $this->values[$field] : null;
    }
}