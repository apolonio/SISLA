<?php

class PesquisaVoo extends TStandardList
{
    protected $form;     // registration form
    protected $datagrid; // listing
    protected $pageNavigation;
    
    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        
        parent::setDatabase('fiscalizacao');                // defines the database
        parent::setActiveRecord('Voo');            // defines the active record
        parent::setDefaultOrder('id', 'asc');          // defines the default order
        parent::addFilterField('guerra', 'like'); // add a filter field
        parent::addFilterField('su', '='); // add a filter field
        parent::addFilterField('tipoVoo', '=');          // add a filter field
        parent::addFilterField('pelotao', '=');          // add a filter field
        
        // creates the form, with a table inside
        $this->form = new TQuickForm('form_search_voo');
        $this->form->class = 'tform';
        $this->form->style = 'width: 650px';
        $this->form->setFormTitle('Voos');
   

        // Campos do Formulário
        $guerra = new TEntry('guerra');
        $tipoVoo = new TCombo('tipoVoo');
        $su = new TCombo('su');
        $pelotao = new TCombo('pelotao');
        
        
        //Caixa selecao Subunidade
        $unidade = array();
        $unidade['1ªCia Fuz F Paz'] = '1ªCia Fuz F Paz';
        $unidade['2ªCia Fuz F Paz'] = '2ªCia Fuz F Paz';
        $unidade['CCAp'] = 'CCAp';
        $unidade['CCAp/EM'] = 'CCAp/EM';
        $unidade['DOPaz'] = 'DOPaz';
        $unidade['DOAI'] = 'DOAI';
        $unidade['EM Geral'] = 'EM Geral';
        $unidade['EM Especial'] = 'EM Especial';
        $unidade['FT Esqd Fuz F Paz'] = 'FT Esqd Fuz F Paz';
        $su->addItems($unidade);
        
        
        //Caixa selecao do pelotao
        $pel = array();
        $pel['Comando'] = 'Comando';
        $pel['PelCom'] = 'PelCom';
        $pel['PelCmdo'] = 'PelCmdo';
        $pel['PelManutenção'] = 'PelManutenção';
        $pel['PelSuprimento'] = 'PelSuprimento';
        $pel['PelEngenharia'] = 'PelEngenharia';
        $pel['PelPE'] = 'PelPE';
        $pel['SecSaúde'] = 'SecSaúde';
        $pel['SecCmdo'] = 'SecCmdo';
        $pel['G1'] = 'G1';
        $pel['G2'] = 'G2';
        $pel['G3'] = 'G3';
        $pel['G4'] = 'G4';
        $pel['G5'] = 'G5';
        $pel['G6'] = 'G6';
        $pel['G7'] = 'G7';
        $pel['G8'] = 'G8';
        $pel['G9'] = 'G9';
        $pel['G10'] = 'G10';
        $pelotao->addItems($pel);
     
            //caixas de selecao
        $voo = array('1º VOO' => '1º VOO',
                     '2º VOO' => '2º VOO',
                     '3º VOO' => '3º VOO',
                     '4º VOO' => '4º VOO'
            );
        
        $tipoVoo->addItems($voo);
        
        
        //  Opcoes de pesquisa 
        $this->form->addQuickField('Nome Guerra', $guerra, 200);
        $this->form->addQuickField('SU', $su, 200);
        $this->form->addQuickField('Tipo Voo', $tipoVoo, 200);
        $this->form->addQuickField('Pelotão', $pelotao, 200);
        
        
        $this->form->setData( TSession::getValue('Product_filter_data') );
        $this->form->addQuickAction( _t('Find'), new TAction(array($this, 'onSearch')), 'ico_find.png');
        $this->form->addQuickAction( _t('New'),  new TAction(array('VooForm', 'onEdit')), 'ico_new.png');
        
        // creates a DataGrid
        $this->datagrid = new TQuickGrid;
        $this->datagrid->setHeight(420);

        // creates the datagrid columns
        $id = $this->datagrid->addQuickColumn('ID', 'id', 'center', 50);
        $postograd = $this->datagrid->addQuickColumn('Posto/Grad', 'postograd', 'center', 50);
        $nome = $this->datagrid->addQuickColumn('Nome', 'nome', 'center', 300);
        $guerra = $this->datagrid->addQuickColumn('Guerra', 'guerra', 'left', 200);
        $su = $this->datagrid->addQuickColumn('SU', 'su', 'left', 120);
        $su = $this->datagrid->addQuickColumn('Pelotão', 'pelotao', 'left', 120);
        $tipoVoo = $this->datagrid->addQuickColumn('Tipo Voo', 'tipoVoo', 'right', 100);
        $ida = $this->datagrid->addQuickColumn('Data Ida', 'ida', 'right', 100);
        $horaIda = $this->datagrid->addQuickColumn('Hora Ida', 'horaIda', 'right', 70);
        
        // create the datagrid actions
        $edit_action   = new TDataGridAction(array('VooForm', 'onEdit'));
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
        $container->add(new TXMLBreadCrumb('menu.xml', 'PesquisaVoo'));
        $container->add($this->form);
        $container->add($this->datagrid);
        $container->add($this->pageNavigation);
        
        parent::add($container);
    }
}
?>

