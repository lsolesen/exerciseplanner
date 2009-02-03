<?php

/**
 * Muscle form.
 *
 * @package    form
 * @subpackage Muscle
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class MuscleForm extends BaseMuscleForm
{
    public function configure()
    {
        unset($this['image_width'],$this['image_height']);

        $this->widgetSchema['image'] = new sfWidgetFormInputFile();
        $this->validatorSchema['image'] = new sfValidatorFile();

        $this->embedI18n(array('en','da'));

        $this->widgetSchema->setLabel('en','English');
        $this->widgetSchema->setLabel('da','Danish');
    }


    public function save($con = null)
    {
        sfContext::getInstance()->getLogger()->info('OBJECT STATE: '.$this->object->state());
        $this->object->state('TDIRTY');
        sfContext::getInstance()->getLogger()->info('OBJECT STATE: '.$this->object->state());

        //        if (file_exists($this->getObject()->getFile()))
//        {
//            unlink($this->getObject()->getFile());
//        }

        $this->object->image = 'something';
//        $file     = $this->getValue('image');
//        try
//        {
//            $this->object->image = $file->getOriginalName();
//            $file->save(sfConfig::get('sf_upload_dir').'/'.$this->object->image);
//        sfContext::getInstance()->getLogger()->info('FILE TYPE: '.$file->getType());
//        sfContext::getInstance()->getLogger()->info('FILE Generate: '.$file->generateFilename());
//        sfContext::getInstance()->getLogger()->info('FILE getExtension: '.$file->getExtension());
//        sfContext::getInstance()->getLogger()->info('FILE getPath '.$file->getPath());
//        sfContext::getInstance()->getLogger()->info('FILE getOriginalName '.$file->getOriginalName());
//        sfContext::getInstance()->getLogger()->info('OBJECT FILENAME '.$this->object->image);
//        sfContext::getInstance()->getLogger()->info('FILE getTempName '.$file->getTempName());

        //        $filename = sha1($file->getOriginalName()).$file->getExtension($file->getOriginalExtension());
//
//        $file->save(sfConfig::get('sf_upload_dir').'/'.$filename);

            return parent::save($con);
//        }
//        catch ( Exception $e)
//        {
//            unlink(sfConfig::get('sf_upload_dir').'/'.$file->getOriginalName());
//            throw $e;
//        }
    }
}