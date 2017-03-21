<?php
/** 
 * Esser Relatorio exibi dados da tabela system_militar e permiti exportar arquivo csv(excel)
 * class CustomerDataGridView extends TPage
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class RelatorioLeave extends TPage
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
            
        $this->datagrid->makeScrollable();
        $this->datagrid->setHeight(600);
   
        // define the CSS class
        $this->datagrid->class='tdatagrid_table customized-table';
        // import the CSS file
       // parent::include_css('app/resources/leave-table.css');

        // add the columns
      //  $this->datagrid->addQuickColumn('ID',    'id',    'right', 70, new TAction(array($this, 'onReload')), array('order', 'id'));
        $this->datagrid->addQuickColumn('P/G',    'postograd',    'left', 80);
        $this->datagrid->addQuickColumn('Guerra', 'guerra', 'left', 140, new TAction(array($this, 'onReload')), array('order', 'guerra'));
        $this->datagrid->addQuickColumn('Fração',   'subunidade',    'left', 140);

        $this->datagrid->addQuickColumn('D. Emb.', 'ida','left',  120, new TAction(array($this, 'onReload')), array('order', 'ida'));
        $this->datagrid->addQuickColumn('H. Emb.',   'horaIda',    'left', 80);
        $this->datagrid->addQuickColumn('Voo Emb.',   'vooIda',    'left', 140);
       
        $this->datagrid->addQuickColumn('D. Chegada',   'chegada',    'left', 120, new TAction(array($this, 'onReload')), array('order', 'chegada'));
        $this->datagrid->addQuickColumn('H. Chegada',   'horaChegada',    'left', 80);
        $this->datagrid->addQuickColumn('Voo Chegada',   'vooChegada',    'left', 100);

        $this->datagrid->addQuickColumn('H. Saída Base',   'saidaBase',    'left', 80);
        $this->datagrid->addQuickColumn('Empresa',   'empresa',    'left', 120, new TAction(array($this, 'onReload')), array('order', 'empresa'));
        $this->datagrid->addQuickColumn('Destino',   'destino',    'left', 120, new TAction(array($this, 'onReload')), array('order', 'destino'));
        $this->datagrid->addQuickColumn('Situação',   'situacao',    'left', 120, new TAction(array($this, 'onReload')), array('order', 'situacao'));
        
      //  $this->datagrid->addQuickAction('View',   new TDataGridAction(array($this, 'onView')),   'passaporteOficial', 'ico_find.png');
                
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
            
            $criteria2 = new TCriteria;
            $criteria2->add(new TFilter('situacao','=','Vai Viajar'));
            $criteria3 = new TCriteria;
            $criteria3->add(new TFilter('situacao','=','Viajando'));
            
            $criteria = new TCriteria;
            $order    = isset($param['order']) ? $param['order'] : 'ida';
            $criteria->setProperty('order', $order);
            
            $criteria->add($criteria2, Adianti\Database\TExpression::OR_OPERATOR);
            $criteria->add($criteria3, Adianti\Database\TExpression::OR_OPERATOR);
            
            
         
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
