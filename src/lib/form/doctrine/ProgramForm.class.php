<?php

/**
 * Program form.
 *
 * @package    form
 * @subpackage Program
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ProgramForm extends BaseProgramForm
{
  public function configure()
  {
    unset($this['created_at'],$this['updated_at']);

  }
}