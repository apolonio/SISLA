<?php

/** 
 * Esser Relatorio exibi dados da tabela system_militar e permiti exportar arquivo csv(excel)
 * class CustomerDataGridView extends TPage
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */

class LeaveOficial extends TPage {
    
    private $form;
    private $datagrid;
    private $pageNavigation;
    private $loaded;
    
      public function __construct()
    {
        parent::__construct();
        
        // creates one datagrid
        $this->datagrid = new TQuickGrid;
        $this->datagrid->setHeight(320);
        // define the CSS class
        $this->datagrid->class='tdatagrid_table customized-table';
        // import the CSS file
        parent::include_css('app/resources/leave-table.css');
        // add the columns
        $this->datagrid->addQuickColumn('Id',    'id',    'right', 70);
        $this->datagrid->addQuickColumn('Posto/Grad',    'postograd',    'left', 180);
        $this->datagrid->addQuickColumn('Nome',    'nome',    'left', 180);
        $this->datagrid->addQuickColumn('Guerra', 'guerra', 'left', 180);
    //    $this->datagrid->addQuickColumn('SU',   'su',    'left', 160);
        $this->datagrid->addQuickColumn('Fração',   'subunidade',    'left', 160);
        $this->datagrid->addQuickColumn('Dia Ida',   'ida',    'left', 160);
        $this->datagrid->addQuickColumn('Hora Voo',   'horaIda',    'left', 160);
        $this->datagrid->addQuickColumn('Saída Base',   'saidaBase',    'left', 160);
//        $this->datagrid->addQuickColumn('Destino',   'destino',    'left', 160);
        $this->datagrid->addQuickColumn('Chegada',   'chegada',    'left', 160);
        $this->datagrid->addQuickColumn('Hora Chegada',   'horaChegada',    'left', 160);
        $this->datagrid->addQuickColumn('Empresa',   'empresa',    'left', 160);
       // $this->datagrid->addQuickColumn('Obs',   'obs',    'left', 160);
        $this->datagrid->addQuickColumn('Status',   'status',    'left', 160);

        
        $this->datagrid->addQuickAction('View',   new TDataGridAction(array($this, 'onView')),   'nome', 'ico_find.png');
                
        // creates the datagrid model
        $this->datagrid->createModel();
        
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->datagrid);

        parent::add($vbox);
    }
    
    
   function onReload($param = NULL)
    {
        try
        {
            // open a transaction with database 'samples'
            TTransaction::open('fiscalizacao');
            
            // creates a repository for Category
            $repository = new TRepository('Viajem');
            
            // creates a criteria, ordered by id
            $criteria = new TCriteria;
            $where    = isset($param['where']) ? $param['where'] : 'id';
            $criteria->setProperty('where', $where);
            
            // load the objects according to criteria
            $categories = $repository->load($criteria);
            $this->datagrid->clear();
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
    
    public function onClear()
    {
        $this->form->clear();
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

    /**
     * method onView()
     * Executed when the user clicks at the view button
     */
    function onView($param)
    {
        // get the parameter and shows the message
        $key=$param['key'];
   
        new TMessage('info', "Militar : $key");
    }
}
?>
