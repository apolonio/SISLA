<?php
/** 
 * Esser Relatorio exibi dados da tabela system_militar
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class PesquisaMissoesViatura extends TStandardList
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
        parent::setActiveRecord('Viatura');
        parent::setDefaultOrder('id', 'desc');  
        parent::addFilterField('idChefeVtr', '=');  
        parent::addFilterField('idViatura', '='); 
        parent::addFilterField('destino', '='); 
        parent::addFilterField('ida', '='); 
        parent::addFilterField('alteracao', 'like'); 
        
        // creates the form, with a table inside
        $this->form = new TQuickForm('Pesquisa Missões');
        $this->form->class = 'tform';
        $this->form->style = 'width: 650px';
        $this->form->setFormTitle('Pesquisa de Missões - Escolha uma opção para realizar a pesquisa!');

        // create the form fields
        
        $idViatura = new TCombo('idViatura');
        $idChefeVtr = new TCombo('idChefeVtr');
        $ida = new TDate('ida');
        $destino = new TCombo('destino');
        $alteracao = new TEntry('alteracao');

        $vtr = array();
        $vtr['VAN-UN25269'] = 'VAN-UN25269';
        $vtr['VAN-UN25264'] = 'VAN-UN25264';
        $vtr['MARRUA-UN24772'] = 'MARRUA-UN24772';
       
        $idViatura->addItems($vtr);

        $dest = array();
        $dest['AEROPORTO'] = 'AEROPORTO';
        $dest['RODOVIARIA'] = 'RODOVIARIA';
        $dest['OUTROS'] = 'OUTROS';
        $destino->addItems($dest);

	$ch = array();
        $ch['TEN INOUE'] = 'TEN INOUE'; 
        $ch['SGT VERISSIMO'] = 'SGT VERISSIMO'; 
        $ch['SGT SANTIAGO'] = 'SGT SANTIAGO'; 
        $idChefeVtr->addItems($ch);

        // add a row for the filter field 
          
        $this->form->addQuickField('Viatura', $idViatura, 200);
        $this->form->addQuickField('Chefe Vtr', $idChefeVtr,250);
        $this->form->addQuickField('Data', $ida, 200);
        $this->form->addQuickField('Destino', $destino, 200);
        $this->form->addQuickField('Missao', $alteracao, 250);
        
        $this->form->setData( TSession::getValue('Product_filter_data') );
        $this->form->addQuickAction( _t('Find'), new TAction(array($this, 'onSearch')), 'ico_find.png');
        $this->form->addQuickAction( _t('New'),  new TAction(array('MissaoForm', 'onEdit')), 'ico_new.png');
        
        // creates a DataGrid
        $this->datagrid = new TQuickGrid;
        $this->datagrid->setHeight(420);

        // creates a DataGrid
      
        $idChefeVtr = $this->datagrid->addQuickColumn('Chefe', 'idChefeVtr', 'left', 300);
        $idMotorista = $this->datagrid->addQuickColumn('Motorista', 'idMotorista', 'left', 300);
        $idViatura = $this->datagrid->addQuickColumn('Vtr', 'idViatura', 'left', 120);
        $ida = $this->datagrid->addQuickColumn('Data', 'ida', 'left', 100);
        $horaIda = $this->datagrid->addQuickColumn('H.Ida', 'horaIda', 'left', 120);
        $horaChegada = $this->datagrid->addQuickColumn('H.Chegada', 'horaChegada', 'left', 100);
        $hodoIda = $this->datagrid->addQuickColumn('Hod. Ida', 'hodoIda', 'left', 100);
        $hodoChegada = $this->datagrid->addQuickColumn('Hod. Chegada', 'hodoChegada', 'left', 100);
        $destino = $this->datagrid->addQuickColumn('Destino', 'destino', 'left', 200);
        $alteracao = $this->datagrid->addQuickColumn('Missão', 'alteracao', 'left', 300);

        // create the datagrid actions
        $edit_action   = new TDataGridAction(array('MissaoForm', 'onEdit'));
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
        $container->add(new TXMLBreadCrumb('menu.xml', 'PesquisaMissoesViatura'));
        $container->add($this->form);
        $container->add($this->datagrid);
        $container->add($this->pageNavigation);
        
        parent::add($container);
    }
    
  
   
    
    function show()
    {
       
        if (!$this->loaded)
        {
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }

}
