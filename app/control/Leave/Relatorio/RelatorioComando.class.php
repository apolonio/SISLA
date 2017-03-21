<?php

/** 
 * Esser Relatorio exibi dados da tabela system_militar e permiti exportar arquivo csv(excel)
 * class CustomerDataGridView extends TPage
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class RelatorioComando  extends TPage
{
  //  private $form;
    private $datagrid;
    private $pageNavigation;
    private $loaded;
    
      public function __construct()
    {
        parent::__construct();
        
        // creates one datagrid
        $this->datagrid = new TQuickGrid;
        $this->datagrid->setHeight(320);
        $this->datagrid->class='tdatagrid_table customized-table';
        
       // $this->datagrid->addQuickColumn('ID',    'id',    'right', 70);
        $this->datagrid->addQuickColumn('P/G',    'postograd',    'left', 100);
        $this->datagrid->addQuickColumn('Guerra', 'guerra', 'left', 150);
        $this->datagrid->addQuickColumn('Fração',   'subunidade',    'left', 160);
        $this->datagrid->addQuickColumn('Dia Ida',   'ida',    'left', 120);
        $this->datagrid->addQuickColumn('Hora Ida',   'horaIda',    'left', 80);
        $this->datagrid->addQuickColumn('Voo Ida',   'vooIda',    'left', 80);
        $this->datagrid->addQuickColumn('Chegada',   'chegada',    'left', 120);
        $this->datagrid->addQuickColumn('Hora Chegada',   'horaChegada',    'left', 80);
        $this->datagrid->addQuickColumn('Voo Chegada',   'vooChegada',    'left', 80);
        $this->datagrid->addQuickColumn('Saída Base',   'saidaBase',    'left', 80);
        $this->datagrid->addQuickColumn('Empresa',   'empresa',    'left', 160);
        $this->datagrid->addQuickColumn('Destino',   'destino',    'left', 160);
        $this->datagrid->addQuickColumn('Situação',   'situacao',    'left', 160);

        $this->datagrid->createModel();

        // create the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());


        $vbox = new TVBox;
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        //$vbox->add($this->form);
        $vbox->add($this->datagrid);
        $vbox->add($this->pageNavigation);

        parent::add($vbox);
    }
    
   function onReload($param = NULL)
    {
        try
        {
            TTransaction::open('fiscalizacao');
            
            $repository = new TRepository('Viajem');
            
            $criteria = new TCriteria;
            $order    = isset($param['order']) ? $param['order'] : 'ida';
            $criteria->add(new TFilter('funcao','=','Comando'));
            $criteria->add(new TFilter('situacao','=','Vai Viajar'));
           // $criteria->add(new TFilter('situacao','=','Viajando'));

            $criteria->setProperty('order', $order);
         
            $categories = $repository->load($criteria);
            $this->datagrid->clear();
            if ($categories)
            {
                foreach ($categories as $category)
                {
                    $this->datagrid->addItem($category);
                }
            }
            TTransaction::close();
            $this->loaded = true;
        }
        catch (Exception $e)
        {
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            TTransaction::rollback();
        }
    }
    
    public function onClear()
    {
        $this->form->clear();
    }
    
    function show()
    {
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
        $key=$param['key'];
   
        new TMessage('info', "Militar : $key");
    }
}
?>

