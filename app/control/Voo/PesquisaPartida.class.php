<?php

class PesquisaPartida extends TStandardList
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
        parent::setActiveRecord('Partida');            // defines the active record
        parent::setDefaultOrder('id', 'asc');          // defines the default order
        parent::addFilterField('guerra', 'like'); // add a filter field
        parent::addFilterField('su', '='); // add a filter field
        parent::addFilterField('l4levas', '=');          // add a filter field
        parent::addFilterField('l7levas', '=');          // add a filter field
        parent::addFilterField('pelotao', '=');          // add a filter field
        
        // creates the form, with a table inside
        $this->form = new TQuickForm('form_search_voo');
        $this->form->class = 'tform';
        $this->form->style = 'width: 650px';
        $this->form->setFormTitle('Voos');
   

        // Campos do Formulário
        $guerra = new TEntry('guerra');
        $l4levas = new TCombo('l4levas');
        $l7levas = new TCombo('l7levas');
        $su = new TCombo('su');
        $subunidade = new TCombo('subunidade');
        
        
        //Caixa selecao Subunidade
     
          $voos = array('1º' => '1º',
                     '2º' => '2º',
                     '3º' => '3º',
                     '4º' => '4º',
                     '5º' => '5º',
                     '6º' => '6º',
                     '7º' => '7º'
            );
        
        $l7levas->addItems($voos);
        
             //Caixa selecao Subunidade
        $unidade = array();
        $unidade['1ªCia Fuz'] = '1ª Cia Fuz';
        $unidade['2ªCia Fuz'] = '2ª Cia Fuz';
        $unidade['CCAp/Btl F Paz'] = 'CCAp/Btl F Paz';
        $unidade['EM/Btl F Paz'] = 'EM/Btl F Paz';
        $unidade['Esqd C Mec'] = 'Esqd C Mec';
        $su->addItems($unidade);
        
        
        $pel = array();
        $pel['Cmt'] = 'Cmt';
        $pel['EM Esp'] = 'EM Esp';
         $pel['1ªCia Fuz'] = '1ª Cia Fuz';
        $pel['2ªCia Fuz'] = '2ª Cia Fuz';
        $pel['CCAp/Btl F Paz'] = 'CCAp/Btl F Paz';
        $pel['EM/Btl F Paz'] = 'EM/Btl F Paz';
        $pel['Esqd C Mec'] = 'Esqd C Mec';
        $pel['DOPAZ'] = 'DOPAZ';
        $pel['Esqd C Mec'] = 'Esqd C Mec';
        $pel['Sec Cmdo/CCAp'] = 'Sec Cmdo/CCAp';
        $pel['Pel Com/CCAp'] = 'Pel Com/CCAp';
        $pel['Pel Cmdo/CCAp'] = 'Pel Cmdo/CCAp';
        $pel['Pel Mnt/CCAp'] = 'Pel Mnt/CCAp';
        $pel['Pel Sup/CCAp'] = 'Pel Sup/CCAp';
        $pel['Pel Eng/CCAp'] = 'Pel Eng/CCAp';
        $pel['Pel PE/CCAp'] = 'Pel PE/CCAp';
        $pel['Pel Sau/CCAp'] = 'Pel Sau/CCAp';
        $pel['G1'] = 'G1';
        $pel['G2'] = 'G2';
        $pel['G3'] = 'G3';
        $pel['G4'] = 'G4';
        $pel['G6'] = 'G6';
        $pel['G9'] = 'G9';
        $pel['G10'] = 'G10';
        $subunidade->addItems($pel);
     
            //caixas de selecao
        $voo = array('1º' => '1º',
                     '2º' => '2º',
                     '3º' => '3º',
                     '4º' => '4º'
            );
        
        $l4levas->addItems($voo);
        
          $voos = array('1º' => '1º',
                     '2º' => '2º',
                     '3º' => '3º',
                     '4º' => '4º',
                     '5º' => '5º',
                     '6º' => '6º',
                     '7º' => '7º'
            );
        
        $l7levas->addItems($voos);
        
        //  Opcoes de pesquisa 
        $this->form->addQuickField('Nome Guerra', $guerra, 200);
        $this->form->addQuickField('SU', $su, 200);
        $this->form->addQuickField('SubUnidade', $subunidade, 200);
        $this->form->addQuickField('L4Levas', $l4levas, 100);
        $this->form->addQuickField('L7Levas', $l7levas, 100);
   
        
        
        $this->form->setData( TSession::getValue('Product_filter_data') );
        $this->form->addQuickAction( _t('Find'), new TAction(array($this, 'onSearch')), 'ico_find.png');
        $this->form->addQuickAction( _t('New'),  new TAction(array('PartidaForm', 'onEdit')), 'ico_new.png');
        
        // creates a DataGrid
        $this->datagrid = new TQuickGrid;
        $this->datagrid->setHeight(420);

        // creates the datagrid columns
        $id = $this->datagrid->addQuickColumn('ID', 'id', 'center', 50);
        $pg = $this->datagrid->addQuickColumn('Posto/Grad', 'pg', 'center', 50);
        $nome = $this->datagrid->addQuickColumn('Nome', 'nome', 'center', 300);
        $guerra = $this->datagrid->addQuickColumn('Guerra', 'guerra', 'left', 200);
        $su = $this->datagrid->addQuickColumn('SU', 'su', 'left', 120);
        $subunidade = $this->datagrid->addQuickColumn('SubUnidade', 'subunidade', 'left', 120);
        $l4levas = $this->datagrid->addQuickColumn('L4', 'l4levas', 'right', 100);
        $l7levas = $this->datagrid->addQuickColumn('L7', 'l7levas', 'right', 100);
      //  $ida = $this->datagrid->addQuickColumn('Data Ida', 'ida', 'right', 100);
      //  $horaIda = $this->datagrid->addQuickColumn('Hora Ida', 'horaIda', 'right', 70);
        
        // create the datagrid actions
        $edit_action   = new TDataGridAction(array('PartidaForm', 'onEdit'));
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
        $container->add(new TXMLBreadCrumb('menu.xml', 'PesquisaPartida'));
        $container->add($this->form);
        $container->add($this->datagrid);
        $container->add($this->pageNavigation);
        
        parent::add($container);
    }
}
?>



