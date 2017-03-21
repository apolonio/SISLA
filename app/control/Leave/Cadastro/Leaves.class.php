<?php
/** 
 * Esser Relatorio exibi dados da tabela system_militar
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */

//require ('Dias.class.php');

class Leaves extends TPage
{
    private $form;
    private $datagrid;
    private $loaded;

    public function __construct()
            
    {
        parent::__construct();
       
        $this->form = new TQuickForm('ConsultaLeave');
        $this->form->class = 'tform';
        
         $this->datagrid = new TQuickGrid;
        $this->datagrid->setHeight(320);
        // define the CSS class
        $this->datagrid->class='tdatagrid_table customized-table';
        
        
        // import the CSS file
        // parent::include_css('app/resources/leave-table.css');
        // add the columns
        $this->datagrid->addQuickColumn('ID',    'id',    'right', 70);
        $this->datagrid->addQuickColumn('P/G',    'postograd',    'left', 180);
        $this->datagrid->addQuickColumn('Guerra', 'guerra', 'left', 180);
        $this->datagrid->addQuickColumn('Fração',   'subunidade',    'left', 160);
        $this->datagrid->addQuickColumn('Inicio L',   'inicioLeave',    'left', 140);
        $this->datagrid->addQuickColumn('Termino L',   'terminoLeave',    'left', 140);
        $this->datagrid->addQuickColumn('Dia Embarque',   'ida',    'left', 160);
        $this->datagrid->addQuickColumn('Hora Embarque',   'horaIda',    'left', 100);
        $this->datagrid->addQuickColumn('Hora Saída Base',   'saidaBase',    'left', 160);
        $this->datagrid->addQuickColumn('Destino',   'destino',    'left', 140);
        $this->datagrid->addQuickColumn('Data Chegada',   'chegada',    'left', 140);
        $this->datagrid->addQuickColumn('Hora Chegada',   'horaChegada',    'left', 100);
        $this->datagrid->addQuickColumn('Empresa',   'empresa',    'left', 160);
//        $this->datagrid->addQuickColumn('Status',   'status',    'left', 160);
        $this->datagrid->addQuickColumn('Situação',   'situacao',    'left', 160);
     

        $edit_action   = new TDataGridAction(array('MeuLeaveForm', 'onEdit'));
        $this->datagrid->addQuickAction(_t('Edit'), $edit_action, 'id', 'ico_edit.png');
           // create the datagrid actions
      
        
        $this->datagrid->createModel();
        
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->datagrid);

        parent::add($vbox);
        
        
        $d = new Dias();

        
        
        
        
        
            
    }

 
    function onReload($param = NULL)
    {
        try
        {
            // open a transaction with database 'samples'
            TTransaction::open('fiscalizacao');
            // creates a repository for Category
            $repository = new TRepository('Viajem');
            // CAPTURANDO USUARIO
            $user= SystemUser::newFromLogin(TSession::getValue('login'));
            // creates a criteria, ordered by id
            $criteria = new TCriteria;
            $order    = isset($param['order']) ? $param['order'] : 'ida';
            $criteria->setProperty('order', $order);
            $criteria->add(new TFilter('nome','=',$user->name));
            
            $categories = $repository->load($criteria);
            $this->datagrid->clear();
           // print_r($categories);
            if ($categories)
            {
                // iterate the collection of active records
                foreach ($categories as $category)
                {
                    // add the object inside the datagrid
                    $this->datagrid->addItem($category);
                }
            }
        
            
            
      
        
            // close the transaction
            TTransaction::close();
            $this->loaded = true;
            
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }
    

    
    function show()
    {
        // check if the datagrid is already loaded
        if (!$this->loaded)
        {
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }

}
?>


 
