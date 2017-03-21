<?php
/** 
 * Esser Relatorio exibi dados da tabela system_militar
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class PesquisaComitiva extends TStandardList
{
    protected $form;     
    protected $datagrid; 
    protected $pageNavigation;
    
    /**
     * Class constructor
     * Creates the page, de pesquisa
     */
    public function __construct()
    {
        parent::__construct();
        
        parent::setDatabase('fiscalizacao'); 
        parent::setActiveRecord('Comitiva');
        parent::setDefaultOrder('id', 'Asc');  
        parent::addFilterField('idChefeVtr', '='); 
        parent::setDefaultOrder('idViatura', '='); 
        parent::addFilterField('comitiva', 'like'); 
        parent::setDefaultOrder('dataChegada', '='); 
        parent::setDefaultOrder('obs', 'like'); 
        
        // creates the form, with a table inside
        $this->form = new TQuickForm('Pesquisa Comitiva');
        $this->form->class = 'tform';
        $this->form->style = 'width: 650px';
        $this->form->setFormTitle('Pesquisa de Comitiva - Escolha uma opção para realizar a pesquisa!');

        // create the form fields
        $id = new TCombo('id');
        $idViatura = new TCombo('idViatura');
        $idChefeVtr = new TCombo('idChefeVtr');
        $comitiva = new TEntry('tipoComitiva');
        $dataChegada = new TDate('dataChegada');
        $obs = new TEntry('obs');

        $vtr = array();
        $vtr['VAN-UN25269'] = 'VAN-UN25269';
        $vtr['VAN-UN25265'] = 'VAN-UN25265';
        $vtr['MARRUA-UN24772'] = 'MARRUÁ-UN24772';
        $idViatura->addItems($vtr);

        $mil = array();
        $mil['TEN INOUE'] = 'TEN INOUE';
        $mil['SGT VERISSIMO'] = 'SGT VERISSIMO';
        $mil['SGT SANTIAGO'] = 'SGT SANTIAGO';
        $idChefeVtr->addItems($mil);
        
        // add a row for the filter field 
        $this->form->addQuickField('Viatura', $idViatura, 250);
        $this->form->addQuickField('Chefe Vtr', $idChefeVtr, 250);
        $this->form->addQuickField('Data', $dataChegada, 250);
        $this->form->addQuickField('Comitiva', $comitiva, 250);
        $this->form->addQuickField('OBS', $obs, 250);
        
        $this->form->setData( TSession::getValue('Product_filter_data') );
        $this->form->addQuickAction( _t('Find'), new TAction(array($this, 'onSearch')), 'ico_find.png');
       $this->form->addQuickAction( _t('New'),  new TAction(array('ComitivaForm', 'onEdit')), 'ico_new.png');
        
        // creates a DataGrid
        $this->datagrid = new TQuickGrid;
        $this->datagrid->setHeight(420);
        // creates a DataGrid
        $id = $this->datagrid->addQuickColumn('ID', 'id', 'center', 50);
        $idChefeVtr = $this->datagrid->addQuickColumn('Chefe', 'idChefeVtr', 'left', 200);
        $idViatura = $this->datagrid->addQuickColumn('Viatura', 'idViatura', 'left', 100);
        $comitiva = $this->datagrid->addQuickColumn('Comitiva', 'tipoComitiva', 'left', 150);
        $comitiva = $this->datagrid->addQuickColumn('Nome', 'nome', 'left', 150);
        
        $dataChegada = $this->datagrid->addQuickColumn('Data Chegada', 'dataChegada', 'left', 100);
        $horaChegada = $this->datagrid->addQuickColumn('Hora Chegada', 'horaChegada', 'left', 100);
        $vooChegada = $this->datagrid->addQuickColumn('Voo Chegada', 'vooChegada', 'left', 100);
        
        $dataRegresso = $this->datagrid->addQuickColumn('Data Regresso', 'dataRegresso', 'left', 100);
        $horaRegresso = $this->datagrid->addQuickColumn('Hora Regresso', 'horaRegresso', 'left', 100);
        $vooRegresso = $this->datagrid->addQuickColumn('Voo Regresso', 'vooRegresso', 'left', 100);
        
       

        // create the datagrid actions
        $edit_action   = new TDataGridAction(array('ComitivaForm', 'onEdit'));
        $delete_action = new TDataGridAction(array($this, 'onDelete'));
        
        // add the actions to the datagrid
        $this->datagrid->addQuickAction(_t('Edit'), $edit_action, 'id', 'ico_edit.png');
        $this->datagrid->addQuickAction(_t('Delete'), $delete_action, 'id', 'ico_delete.png');
        
        // create the datagrid model
        $this->datagrid->createModel();
        // create the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());
        
        // create the page container
        $container = new TVBox;
        $container->add(new TXMLBreadCrumb('menu.xml', 'PesquisaComitiva'));
        $container->add($this->form);
        $container->add($this->datagrid);
        $container->add($this->pageNavigation);
        
        parent::add($container);
    }
    
     /**
     * method onReload()
     * Load the datagrid with the database objects
     */
//    function onReload($param = NULL)
//    {
//        try
//        {
//            // open a transaction with database 'samples'
//            TTransaction::open('fiscalizacao');
//            
//            // creates a repository for Category
//            $repository = new TRepository('Viatura');
//            
//            // creates a criteria, ordered by id
//            $criteria = new TCriteria;
//            $order    = isset($param['order']) ? $param['order'] : 'id';
//            $criteria->setProperty('order', $order);
//            
//            // load the objects according to criteria
//            $categories = $repository->load($criteria);
//            $this->datagrid->clear();
//            if ($categories)
//            {
//                // iterate the collection of active records
//                foreach ($categories as $category)
//                {
//                    // add the object inside the datagrid
//                    $this->datagrid->addItem($category);
//                }
//            }
//            // close the transaction
//            TTransaction::close();
//            $this->loaded = true;
//        }
//        catch (Exception $e) // in case of exception
//        {
//            // shows the exception error message
//            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
//            // undo all pending operations
//            TTransaction::rollback();
//        }
//    }
    
    function show()
    {
        // check if the datagrid is already loaded
        if (!$this->loaded)
        {
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }
//}

}
