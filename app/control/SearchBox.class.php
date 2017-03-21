<?php
/** 
 * Teste
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class SearchBox extends TPage
{
    private $form;
    
    /**
     * Constructor method
     */
    public function __construct()
    {
        parent::__construct('search_box');
        $this->form = new TForm('search_box');
        
        $input = new TMultiSearch('input');
        $input->setSize(240,28);
        $input->addItems( $this->getPrograms() );
        $input->setMinLength(1);
        $input->setMaxSize(1);
        $input->setChangeAction(new TAction(array('SearchBox', 'loadProgram')));
        
        $this->form->add($input);
        $this->form->setFields(array($input));
        parent::add($this->form);
    }
    
    /**
     * Returns an indexed array with all programs
     */
    public function getPrograms()
    {
        try
        {
            TTransaction::open('fiscalizacao');
            $user = SystemUser::newFromLogin( TSession::getValue('login') );
            return $user->getProgramsList();
            TTransaction::close();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }
    
    /**
     * Load an specific program
     */
    public static function loadProgram($param)
    {
        $program = $param['input'][0];
        if ($program)
        {
            TApplication::loadPage($program);
        }
    }
}
