<?php
/** 
 * Esser Relatorio exibi dados da tabela system_militar
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class PesquisaLeave extends TStandardList
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
        parent::setActiveRecord('Viajem');  
        parent::setDefaultOrder('ida', 'asc'); 
        //parent::addFilterField('nome', 'like'); 
        parent::addFilterField('guerra', 'like');
        parent::addFilterField('su', '='); 
        parent::addFilterField('funcao', '='); 
        parent::addFilterField('subunidade', '=');
        parent::addFilterField('postograd', '='); 
        parent::addFilterField('periodo', '='); 
        parent::addFilterField('situacao', '=');
        parent::addFilterField('ida', '='); 
        parent::addFilterField('chegada', '=');
        parent::addFilterField('inicioLeave', '=');
        parent::addFilterField('terminoLeave', '=');
        parent::addFilterField('destino', '=');

        // creates the form, with a table inside
        $this->form = new TQuickForm('Pesquisa');
        $this->form->class = 'tform';
        $this->form->style = 'width: 99%';
        $this->form->setFormTitle('Nas pesquisas com DATAS utilize uma opção EMBARQUE OU CHEGADA');

        // create the form fields
        $nome = new TEntry('nome');
        $postograd = new TCombo('postograd');
        $postograd->setsize(130);
        $guerra = new TEntry('guerra');
        $guerra->setsize(150);
        $su = new TCombo('su');
        $su->setsize(130);
        $subunidade = new TCombo('subunidade');
        $subunidade->setsize(130);
        $periodo = new TCombo('periodo');
        $periodo->setsize(130);
        $viajando = new TCombo('situacao');
        $viajando->setsize(150);
        $ida = new TDate('ida');
        $ida->setsize(100);
        $chegada = new TDate('chegada');
        $chegada->setsize(100);
        $inicioLeave = new TDate('inicioLeave');
        $inicioLeave->setsize(100);
        $terminoLeave = new TDate('terminoLeave');
        $terminoLeave->setsize(100);
        $destino = new TCombo('destino');
        $destino->setsize(130);
        $funcao = new TCombo('funcao');
        $funcao->setsize(130);
         
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
        $items['Cf'] = 'Cap Fragata';
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
        
        $pr =  array();
        $pr['1 Leave'] = '1 Leave';
        $pr['2 Leave'] = '2 Leave';
        $pr['3 Leave'] = '3 Leave';
        $pr['4 Leave'] = '4 Leave';
        $pr['5 Leave'] = '5 Leave';
        $periodo->addItems($pr);

        $fn =  array();
        $fn['Comando'] = 'Comando';
        $fn['Tropa'] = 'Tropa';
        $funcao->addItems($fn);

        
        // Selecao de situacao
        $vj = array();
        $vj['Não Vai Viajar'] = 'Não Vai Viajar';
        $vj['Vai Viajar'] = 'Vai Viajar';
        $vj['Viajando'] = 'Viajando';
        $vj['Finalizado'] = 'Finalizado';
        $viajando->addItems($vj);

        $dst = array();
        $dst['Base'] = 'Base';
        $dst['Brasil'] = 'Brasil';
        $dst['Europa'] = 'Europa';
        $dst['EUA'] = 'EUA';
        $dst['Republica Dominicana'] = 'Republica Dominicana';
        $dst['Santo Domingo'] = 'Santo Domingo';
        $dst['Punta Cana'] = 'Punta Cana';
        $dst['Juan Dolio'] = 'Juan Dolio';
        $dst['Boca Chica'] = 'Boca Chica';
        $dst['Outro'] = 'Outro';
        $destino->addItems($dst);

        
         $lbl_postograd =  new TLabel('P/G');
         $lbl_postograd->setSize(70);  
         $lbl_guerra =  new TLabel('Guerra');
         $lbl_guerra->setSize(90);  
         $lbl_subunidade =  new TLabel('Fração');
         $lbl_subunidade->setSize(70);  
         $lbl_su =  new TLabel('SU');
         $lbl_su->setSize(70); 
         $lbl_periodo = new TLabel('Leave');
         $lbl_periodo->setsize(70);
         $lbl_situacao = new TLabel('Situação');
         $lbl_situacao->setsize(90);
         $lbl_destino = new TLabel('Destino');
         $lbl_destino->setsize(70);
         $lbl_funcao = new TLabel('Função');
         $lbl_funcao->setsize(70);
       
         $lbl_inicioLeave = new TLabel('Início Leave');
         $lbl_inicioLeave->setsize(120);
         $lbl_terminoLeave = new TLabel('Término Leave');
         $lbl_terminoLeave->setsize(120);
         $lbl_embarque = new TLabel('Data Embarque');
         $lbl_embarque->setsize(120);
         $lbl_chegada = new TLabel('Data Chegada');
         $lbl_chegada->setsize(120);
 
        
        
        // add a row for the filter field   
         $this->form->addQuickFields($lbl_postograd, array($postograd, $lbl_guerra, $guerra,$lbl_su,$su,$lbl_subunidade,$subunidade));      
         $this->form->addQuickFields($lbl_periodo, array($periodo, $lbl_situacao, $viajando,$lbl_destino,$destino,$lbl_funcao,$funcao));      
         $this->form->addQuickFields($lbl_inicioLeave, array($inicioLeave, $lbl_terminoLeave, $terminoLeave,$lbl_embarque,$ida,$lbl_chegada,$chegada));      
         
        $this->form->setData( TSession::getValue('Product_filter_data') );
        $this->form->addQuickAction( 'Buscar', new TAction(array($this, 'onSearch')), 'ico_find.png');
        $this->form->addQuickAction( 'Novo',  new TAction(array('LeaveForm', 'onEdit')), 'ico_new.png');
        
        // creates a DataGrid
        $this->datagrid = new TQuickGrid;
        $this->datagrid->setHeight(420);
        // creates a DataGrid

       // $id = $this->datagrid->addQuickColumn('ID', 'id', 'center', 50);
        $postograd = $this->datagrid->addQuickColumn('P/G', 'postograd', 'center', 50);
       // $nome = $this->datagrid->addQuickColumn('Nome', 'nome', 'left', 300);
        $guerra = $this->datagrid->addQuickColumn('Guerra', 'guerra', 'left', 200);
       // $su = $this->datagrid->addQuickColumn('SU', 'su', 'left', 150);
        $subunidade = $this->datagrid->addQuickColumn('Fracao', 'subunidade', 'left', 150);
        
        $inicioLeave = $this->datagrid->addQuickColumn('Inicio Leave', 'inicioLeave', 'left', 100);
        $terminoLeave = $this->datagrid->addQuickColumn('Termino Leave', 'terminoLeave', 'left', 100);

        $ida = $this->datagrid->addQuickColumn('Data Embarque', 'ida', 'left', 100);
        $horaIda = $this->datagrid->addQuickColumn('Hora Embarque', 'horaIda', 'left', 100);
        $vooIda = $this->datagrid->addQuickColumn('Voo Embarque', 'vooIda', 'left', 80);
        $empresa = $this->datagrid->addQuickColumn('Empresa Embarque', 'empresa', 'left', 200);
        
        $chegada = $this->datagrid->addQuickColumn('Data Chegada', 'chegada', 'left', 100);
        $horaChegada = $this->datagrid->addQuickColumn('Hora Chegada', 'horaChegada', 'left', 100);
        $vooChegada = $this->datagrid->addQuickColumn('Voo Chegada', 'vooChegada', 'left', 80);

        $this->datagrid->addQuickColumn('Empresa Chegada', 'empresaChegada', 'left', 200);
        $saidaBase = $this->datagrid->addQuickColumn('Saída Base', 'saidaBase', 'left', 100);     
        $periodo = $this->datagrid->addQuickColumn('Leave', 'periodo', 'left', 150);
        $destino = $this->datagrid->addQuickColumn('Destino', 'destino', 'left', 150);
        $viajando = $this->datagrid->addQuickColumn('Viajem', 'situacao', 'left', 150);
       
        // create the datagrid actions
        $edit_action   = new TDataGridAction(array('LeaveForm', 'onEdit'));
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
        $container->add(new TXMLBreadCrumb('menu.xml', 'PesquisaLeave'));
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
