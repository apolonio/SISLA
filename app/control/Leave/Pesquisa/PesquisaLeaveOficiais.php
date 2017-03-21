<?php

class PesquisaLeaveOficiais extends TStandardList {

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
        parent::setActiveRecord('Viajem');  
        parent::setDefaultOrder('ida', 'asc'); 
        parent::addFilterField('nome', 'like'); 
        parent::addFilterField('guerra', 'like');
        parent::addFilterField('su', '='); 
        parent::addFilterField('subunidade', '=');
        parent::addFilterField('postograd', '='); 
      //  parent::addFilterField('status', '='); 
        parent::addFilterField('situacao', '=');
        parent::addFilterField('ida', '='); 
        parent::addFilterField('chegada', '=');
        
        // creates the form, with a table inside
        $this->form = new TQuickForm('form_search_leave');
        $this->form->class = 'tform';
        $this->form->style = 'width: 650px';
        $this->form->setFormTitle('Pesquisa de Leave - Escolha uma opção para realizar a pesquisa!');

        // create the form fields
        $nome = new TEntry('nome');
        $postograd = new TCombo('postograd');
        $guerra = new TEntry('guerra');
        $su = new TCombo('su');
        $subunidade = new TCombo('subunidade');
       // $status = new TCombo('status');
        $viajando = new TCombo('situacao');
        $ida = new TDate('ida');
        $chegada = new TDate('chegada');
        
      //Caixa selecao Subunidade
        $unidade = array();
        $unidade['1ª Cia Fuz'] = '1ª Cia Fuz';
        $unidade['2ª Cia Fuz'] = '2ª Cia Fuz';
        $unidade['CCAp/Btl F Paz'] = 'CCAp/Btl F Paz';
        $unidade['EM/Btl F Paz'] = 'EM/Btl F Paz';
        $unidade['Esqd C Mec'] = 'Esqd C Mec';
        $su->addItems($unidade);
        
        $pel = array();
      $pel['EM Esp'] = 'EM Esp';
        $pel['EM/Btl F Paz'] = 'EM/Btl F Paz';
        $pel['G1'] = 'G1';
        $pel['G2'] = 'G2';
        $pel['G3'] = 'G3';
        $pel['G4'] = 'G4';
        $pel['G6'] = 'G6';
        $pel['G9'] = 'G9';
        $pel['G10'] = 'G10';
        $pel['Fisc Adm'] = 'Fisc Adm';
        $pel['Interprete'] = 'Interprete';
        $pel['1ª Cia Fuz'] = '1ª Cia Fuz';
        $pel['2ª Cia Fuz'] = '2ª Cia Fuz';
        $pel['CCAp/Btl F Paz'] = 'CCAp/Btl F Paz';
        $pel['Esqd C Mec'] = 'Esqd C Mec';
        $pel['DOPAZ'] = 'DOPAZ';
        $pel['DOAI'] = 'DOAI';
        $pel['Sec Cmdo/CCAp'] = 'Sec Cmdo/CCAp';
        $pel['Pel Com/CCAp'] = 'Pel Com/CCAp';
        $pel['Pel Cmdo/CCAp'] = 'Pel Cmdo/CCAp';
        $pel['Pel Mnt/CCAp'] = 'Pel Mnt/CCAp';
        $pel['Pel Sup/CCAp'] = 'Pel Sup/CCAp';
        $pel['Pel Eng/CCAp'] = 'Pel Eng/CCAp';
        $pel['Pel PE/CCAp'] = 'Pel PE/CCAp';
        $pel['Pel Sau/CCAp'] = 'Pel Sau/CCAp';
        $subunidade->addItems($pel);
        
      //opcoes do tipo
        $items = array();
        $items['Gen Ex'] = 'General Exército';
        $items['Gen Div'] = 'General Divisão';
        $items['Gen Bda'] = 'Gen Brigada';
        $items['Cel'] = 'Cel';
        $items['CMG'] = 'Cap Mar e Guerra';
        $items['TC'] = 'Ten Cel';
        $items['CF'] = 'Cap Fragata';
        $items['Maj'] = 'Maj';
        $items['CC'] = 'Cap Corveta';
        $items['Cap'] = 'Cap';
        $items['CT'] = 'Cap Ten';
        $items['1ºTen'] = '1ºTen';
        $items['2ºTen'] = '2ºTen';
        $items['Asp'] = 'Aspirante';
        $items['ST'] = 'Sub Ten';
        $items['1ºSgt'] = '1ºSgt';
        $items['2ºSgt'] = '2ºSgt';
        $items['3ºSgt'] = '3ºSgt';
        $items['Cb'] = 'Cb';
        $items['Sd'] = 'Sd';
        $postograd->addItems($items);
        
        
  //      $situacao = array();
   //     $situacao['Aguardando Autorização'] = 'AGUARDANDO AUTORIZAÇÃO';
    //    $situacao['Autorizado'] = 'AUTORIZADO';
    //    $situacao['Não Autorizado'] = 'NÃO AUTORIZADO';
    //    $status->addItems($situacao);
        
       // Selecao de situacao
        $vj = array();
        $vj['Base'] = 'Base';
        $vj['Vai Viajar'] = 'Vai Viajar';
        $vj['Viajando'] = 'Viajando';
        $vj['Finalizado'] = 'Finalizado';
        $viajando->addItems($vj);
        
        // add a row for the filter field   
        $this->form->addQuickField('Nome', $nome, 300);
        $this->form->addQuickField('Guerra', $guerra, 200);
        $this->form->addQuickField('SU', $su, 200);
        $this->form->addQuickField('Fração', $subunidade, 200);
        $this->form->addQuickField('P/G', $postograd, 150);
      //  $this->form->addQuickField('Status', $status, 250);
        $this->form->addQuickField('Situação', $viajando, 250);
        $this->form->addQuickField('Data Embarque', $ida, 250);
        $this->form->addQuickField('Data Chegada', $chegada, 250);
        
        $this->form->setData( TSession::getValue('Product_filter_data') );
        $this->form->addQuickAction( _t('Find'), new TAction(array($this, 'onSearch')), 'ico_find.png');
     //   $this->form->addQuickAction( _t('New'),  new TAction(array('LeaveForm', 'onEdit')), 'ico_new.png');
        
        // creates a DataGrid
        $this->datagrid = new TQuickGrid;
        $this->datagrid->setHeight(420);
        
        // creates a DataGrid
        $id = $this->datagrid->addQuickColumn('ID', 'id', 'center', 50);
        $postograd = $this->datagrid->addQuickColumn('P/G', 'postograd', 'center', 50);
        //$nome = $this->datagrid->addQuickColumn('Nome', 'nome', 'left', 300);
        $guerra = $this->datagrid->addQuickColumn('Guerra', 'guerra', 'left', 150);
        $su = $this->datagrid->addQuickColumn('SU', 'su', 'left', 200);
        $su = $this->datagrid->addQuickColumn('Fração', 'subunidade', 'left', 200);
        $ida = $this->datagrid->addQuickColumn('Data Embarque', 'ida', 'left', 100);
        $horaIda = $this->datagrid->addQuickColumn('Hora Embarque', 'horaIda', 'left', 100);
        $chegada = $this->datagrid->addQuickColumn('Chegada', 'chegada', 'left', 100);
        $horaChegada = $this->datagrid->addQuickColumn('Hora Chegada', 'horaChegada', 'left', 100);
        $saidaBase = $this->datagrid->addQuickColumn('Saída Base', 'saidaBase', 'left', 100);
        $empresa = $this->datagrid->addQuickColumn('Empresa', 'empresa', 'left', 200);
        // $destino = $this->datagrid->addQuickColumn('Destino', 'destino', 'left', 200);
        //$status = $this->datagrid->addQuickColumn('Status', 'status', 'left', 150);
        $viajando = $this->datagrid->addQuickColumn('Viajando', 'situacao', 'left', 150);
        //$obs = $this->datagrid->addQuickColumn('Obs', 'obs', 'left', 150);
       
        // create the datagrid actions
       // $edit_action   = new TDataGridAction(array('LeaveForm', 'onEdit'));
      //  $delete_action = new TDataGridAction(array($this, 'onDelete'));
        
        // add the actions to the datagrid
    //    $this->datagrid->addQuickAction(_t('Edit'), $edit_action, 'id', 'ico_edit.png');
    //    $this->datagrid->addQuickAction(_t('Delete'), $delete_action, 'id', 'ico_delete.png');
        
        // create the datagrid model
        $this->datagrid->createModel();
        // create the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());
        
        // create the page container
        $container = new TVBox;
        $container->add(new TXMLBreadCrumb('menu.xml', 'PesquisaLeaveOficiais'));
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
//            $repository = new TRepository('Viajem');
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
//    
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
?>
<div>
    <h2>Nas pesquisas com DATAS utilize uma opção DATA EMBARQUE OU  DATA CHEGADA!</h2>

</div>
