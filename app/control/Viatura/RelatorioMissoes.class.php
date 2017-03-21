<?php
/** 
 * Esser Relatorio exibi dados da tabela system_militar e permiti exportar arquivo csv(excel)
 * class CustomerDataGridView extends TPage
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class RelatorioMissoes extends TPage
{
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
       // parent::include_css('app/resources/leave-table.css');

        // add the columns
        $this->datagrid->addQuickColumn('ID',    'id',    'right', 70);
        $this->datagrid->addQuickColumn('Chefe',   'idChefeVtr',    'left', 160);
        $this->datagrid->addQuickColumn('Motorista', 'idMotorista', 'left', 180);
        $this->datagrid->addQuickColumn('Viatura',    'idViatura',    'left', 180);
        $this->datagrid->addQuickColumn('Data',   'ida',    'left', 160);
        $this->datagrid->addQuickColumn('Hora Ida',   'horaIda',    'left', 160);
        $this->datagrid->addQuickColumn('Hora Chegada',   'horaChegada',    'left', 160);
        $this->datagrid->addQuickColumn('Efetivo',   'efetivo',    'left', 100);
        $this->datagrid->addQuickColumn('Hodo. Ida',   'hodoIda',    'left', 160);
        $this->datagrid->addQuickColumn('Hodo. Chegada',   'hodoChegada',    'left', 160);
        $this->datagrid->addQuickColumn('Destino',   'destino',    'left', 160);
        $this->datagrid->addQuickColumn('Missao',   'alteracao',    'left', 160);
       
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
            $repository = new TRepository('Viatura');
            
            // creates a criteria, ordered by id
            $criteria = new TCriteria;
            $order    = isset($param['order']) ? $param['order'] : ' ida DESC';
      
            $criteria->setProperty('order', $order);
         
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
