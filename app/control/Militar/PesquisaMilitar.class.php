<?php
/** 
 * Esser Relatorio exibi dados da tabela system_militar
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class PesquisaMilitar extends TStandardList
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
        parent::setActiveRecord('Militar');            // defines the active record
        parent::setDefaultOrder('id', 'asc');          // defines the default order
        parent::addFilterField('nome', 'like'); // add a filter field
        parent::addFilterField('guerra', 'like'); // add a filter field
        parent::addFilterField('su', '='); // add a filter field
        parent::addFilterField('subunidade', '='); // add a filter field
        
        // creates the form, with a table inside
        $this->form = new TQuickForm('form_search_militar');
        $this->form->class = 'tform';
        $this->form->style = 'width: 650px';
        $this->form->setFormTitle('Dados Militar');
   

        //Criando os campos
        $nome = new TEntry('nome');
        $guerra = new TEntry('guerra');
        $su = new TCombo('su');
        $subunidade = new TCombo('subunidade');
        
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
        
        // add a row for the filter field        $this->form->addQuickField('SU', $su, 200);
        $this->form->addQuickField('Nome', $nome, 200);
        $this->form->addQuickField('Guerra', $guerra, 200);
        $this->form->addQuickField('SU', $su, 200);
        $this->form->addQuickField('Fracao', $subunidade, 200);
        
        
        $this->form->setData( TSession::getValue('Product_filter_data') );
        $this->form->addQuickAction( _t('Find'), new TAction(array($this, 'onSearch')), 'ico_find.png');
        $this->form->addQuickAction( _t('New'),  new TAction(array('PessoalForm', 'onEdit')), 'ico_new.png');
        
        // creates a DataGrid
        $this->datagrid = new TQuickGrid;
        $this->datagrid->setHeight(420);

        // creates the datagrid columns
        $id = $this->datagrid->addQuickColumn('ID', 'id', 'center', 50);
        $postograd = $this->datagrid->addQuickColumn('P/G', 'postograd', 'center', 50);
        $nome = $this->datagrid->addQuickColumn('Nome', 'nome', 'left', 300);
        $guerra = $this->datagrid->addQuickColumn('Guerra', 'guerra', 'left', 150);
        $su = $this->datagrid->addQuickColumn('SU', 'su', 'left', 100);
        $subunidade = $this->datagrid->addQuickColumn('Pel/Cel', 'subunidade', 'left', 100);
        $passaporteOficial = $this->datagrid->addQuickColumn('Pass.Oficial', 'passaporteOficial', 'left', 100);
        $numeroVisto = $this->datagrid->addQuickColumn('NºVisto', 'numeroVisto', 'left', 100);
        $identidade = $this->datagrid->addQuickColumn('Identidade', 'identidade', 'left', 100);
        $preccp = $this->datagrid->addQuickColumn('Prec-CP', 'preccp', 'left', 100);
        $cpf = $this->datagrid->addQuickColumn('CPF', 'cpf', 'left', 100);
  
       
        
        // create the datagrid actions
        $edit_action   = new TDataGridAction(array('PessoalForm', 'onEdit'));
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
        $container->add(new TXMLBreadCrumb('menu.xml', 'PesquisaMilitar'));
        $container->add($this->form);
        $container->add($this->datagrid);
        $container->add($this->pageNavigation);
        
        parent::add($container);
    }
}
?>


