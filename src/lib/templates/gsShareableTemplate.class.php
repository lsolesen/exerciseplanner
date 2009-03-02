<?php
class gsShareableTemplate extends Doctrine_Template
{
    /**
     * Array of Activable options
     *
     * @var array
     */
    protected $_options = array('owner' => 'owner_id','share'=>'is_shareable');

    /**
     * __construct
     *
     * @param array $options
     * @return void
     */
    public function __construct(array $options = array())
    {
        $this->_options = Doctrine_Lib::arrayDeepMerge($this->_options, $options);
    }

    public function setTableDefinition()
    {

        $this->addListener(new gsShareableListener($this->_options));
    }
}