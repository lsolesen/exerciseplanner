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
        $this->validatorSchema['filename'] = new sfValidatorFile(array('path' => sfConfig::get('sf_upload_dir').'/exercises','mime_types'=>'web_images','required'=>false));

        $this->embedI18n(array('en','da'));

        $this->widgetSchema->setLabel('en','English');
        $this->widgetSchema->setLabel('da','Danish');
    }

    /**
     * Saves the current file for the field.
     *
     * @param  string          $field    The field name
     * @param  string          $filename The file name of the file to save
     * @param  sfValidatedFile $file     The validated file to save
     *
     * @return string The filename used to save the file
     */
    protected function saveFile($field, $filename = null, sfValidatedFile $file = null)
    {
        if (is_null($file))
            $file = $this->getValue($field);

        $fName = parent::saveFile($field,$filename,$file);
        $path  = $file->getPath().'/';

        if(is_file($path.$fName))
        {
            $params  = sfConfig::get('mod_'.strtolower(sfContext::getInstance()->getModuleName()).'_image_dimensions');
            $gdImage = ImageProcessorHelper::ProcessImage($path.$fName,$params,$fName,$path);
            $this->object->width  = $gdImage->getWidth();
            $this->object->height = $gdImage->getHeight();
        }

        return $fName;
    }
}