<?php
/** 
 * Esser Relatorio exibi dados da tabela system_militar e permiti exportar arquivo csv(excel)
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class RelatorioCadastroVoo extends TPage
{
    private $form;      // registration form
    private $datagrid;  // listing
    private $loaded;
 
    public function __construct()
    {
        parent::__construct();
        
        // create the form
        $this->form = new TQuickForm('form_relatorio_cadastro_voo');
        $this->form->class = 'tform'; // CSS class
        $this->form->setFormTitle('Relatório Cadastro Voo');
        
        // Criando os campos do formulario
        $id     = new TEntry('id');
        $postograd = new TCombo('postograd');
        $guerra   = new TEntry('guerra');
        $su  = new TCombo('su');
        $pelotao  = new TCombo('pelotao');
        $tipoVoo = new Adianti\Widget\Form\TCombo('tipoVoo');
        $ida   = new \Adianti\Widget\Form\TDate('ida');
        $horaIda   = new TEntry('horaIda');

     //    $ida->ida = TDate::date2br($$ida->ida);        
        /*
         * militar = tabela System_militar
         * nome = nome na tabela system_militar
         * nome_formulario
         * 
         */
        $idMilitar    = new TDBSeekButton('nome', 'fiscalizacao', $this->form->getName(), 'Militar', 'nome', 'nome', 'nome');
  //opcoes do tipo
        $items = array();
        $items['Gen Ex'] = 'General Exército';
        $items['Gen Div'] = 'General Divisão';
        $items['Gen Bda'] = 'Gen Brigada';
        $items['Cel'] = 'Cel';
        $items['CMG'] = 'Cap Mar e Guerra ';
        $items['Ten Cel'] = 'Ten Cel';
        $items['CF'] = 'Capitão Fragata';
        $items['Maj'] = 'Maj';
        $items['CC'] = 'Cap Corveta';
        $items['Cap'] = 'Cap';
        $items['Cap Ten'] = 'Cap Ten';
        $items['1ºTen'] = '1ºTen';
        $items['2ºTen'] = '2ºTen';
        $items['Asp. OF'] = 'Aspirante';
        $items['Sub Ten'] = 'Sub Ten';
        $items['1ºSgt'] = '1ºSgt';
        $items['2º Sgt'] = '2ºSgt';
        $items['3ºSgt'] = '3ºSgt';
        $items['Cb'] = 'Cb';
        $items['Sd'] = 'Sd';
        $postograd->addItems($items);
        
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
       
        
        $pel = array();
        $pel['Cmt'] = 'Cmt';
        $pel['1ªCia Fuz'] = '1ªCia Fuz F Paz';
        $pel['2ªCia Fuz'] = '2ªCia Fuz F Paz';
        $pel['CCAp/Btl F Paz'] = 'CCAp/Btl F Paz';
        $pel['EM/Btl F Paz'] = 'EM/Btl F Paz';
        $pel['Esqd C Mec'] = 'Esqd C Mec';
        $pel['DOPAZ'] = 'DOPAZ';
        $pel['Esqd C Mec'] = 'Esqd C Mec';
        $pel['Comando'] = 'Comando';
        $pel['Pel Com/CCAp'] = 'Pel Com/CCAp';
        $pel['Pel Cmdo/CCAp'] = 'Pel Cmdo/CCAp';
        $pel['Pel Mnt/CCAp'] = 'Pel Mnt/CCAp';
        $pel['Pel Sup/CCAp'] = 'Pel Sup/CCAp';
        $pel['Pel Eng/CCAp'] = 'Pel Eng/CCAp';
        $pel['PelPE'] = 'PelPE';
        $pel['Pel Sau/CCAp'] = 'Pel Sau/CCAp';
        $pel['Sec Cmdo/CCAp'] = 'Sec Cmdo/CCAp';
        $pel['EM Esp'] = 'EM Esp';
        $pel['G1'] = 'G1';
        $pel['G2'] = 'G2';
        $pel['G3'] = 'G3';
        $pel['G4'] = 'G4';
        $pel['G9'] = 'G9';
        $pel['G10'] = 'G10';
        $pelotao->addItems($pel);
          
        $Voo = array();
        $Voo['1º VOO'] = '1º VOO';
        $Voo['2º VOO'] = '2º VOO';
        $Voo['3º VOO'] = '3º VOO';
        $Voo['4º VOO'] = '4º VOO';
        $tipoVoo->addItems($Voo);

        // add the fields in the form
        $this->form->addQuickFields('ID',   array($id, new TLabel('Posto/Grad'), $postograd));  
        $this->form->addQuickFields('SU',      array($su,     new TLabel('Pelotão'), $pelotao));
        $this->form->addQuickField('Nome',  $idMilitar, 450);
        $this->form->addQuickFields('Guerra',      array($guerra,     new TLabel('Tipo VO'), $tipoVoo));
        $this->form->addQuickFields('Ida',      array($ida,     new TLabel('Hora ida'), $horaIda));
        
        // $this->form->addQuickFields('Nome', array($idMilitar, new TLabel('Guerra'), $guerra));
        //Desativei para teste      
        //  $ida->setMask("99/99/9999");
    
        
        $this->form->addQuickAction('Salvar', new TAction(array($this, 'onSave')), 'ico_save.png');
        $this->form->addQuickAction('Novo',  new TAction(array($this, 'onClear')), 'ico_new.png');
     
     
        
        // id not editable
        $id->setEditable(FALSE);
        
        // create the datagrid
        $this->datagrid = new TQuickGrid;
        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(500);
        
        // add the datagrid columns
        $this->datagrid->addQuickColumn('ID',   'id',  'center', 50, new TAction(array($this, 'onReload')), array('order', 'id'));
        $this->datagrid->addQuickColumn('Posto/Grad', 'postograd','left',  80, new TAction(array($this, 'onReload')), array('order', 'postograd'));
        $this->datagrid->addQuickColumn('Nome', 'nome','left',  390, new TAction(array($this, 'onReload')), array('order', 'nome'));
        $this->datagrid->addQuickColumn('Guerra', 'guerra','left',  120, new TAction(array($this, 'onReload')), array('order', 'guerra'));
        $this->datagrid->addQuickColumn('SU', 'su','left',  120, new TAction(array($this, 'onReload')), array('order', 'tipoVoo'));
        $this->datagrid->addQuickColumn('Pelotão', 'pelotao','left',  120, new TAction(array($this, 'onReload')), array('order', 'pelotao'));
       // $this->datagrid->addQuickColumn('Passaporte', 'passaporteOficial','left',  390, new TAction(array($this, 'onReload')), array('order', 'passaporteOficial'));
        $this->datagrid->addQuickColumn('Voo', 'tipoVoo','left',  100, new TAction(array($this, 'onReload')), array('order', 'tipoVoo'));
        
        $this->datagrid->addQuickColumn('Data Ida', 'ida','left',  140, new TAction(array($this, 'onReload')), array('order', 'ida'));
        $this->datagrid->addQuickColumn('Hora Ida', 'horaIda','left',  100, new TAction(array($this, 'onReload')), array('order', 'horaIda'));

        $this->datagrid->addQuickAction('Editar',  new TDataGridAction(array($this, 'onEdit')),   'id', 'ico_edit.png');
        $this->datagrid->addQuickAction('Deletar', new TDataGridAction(array($this, 'onDelete')), 'id', 'ico_delete.png');
        
        // create the datagrid model
        $this->datagrid->createModel();
        
        // wrap objects
        $vbox = new TVBox;
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->form);
        $vbox->add($this->datagrid);
        // add the box in the page
        parent::add($vbox);
    }
    
    /**
     * method onReload()
     * Load the datagrid with the database objects
     */
    function onReload($param = NULL)
    {
        try
        {
            // open a transaction with database 'samples'
            TTransaction::open('fiscalizacao');
            
            // creates a repository for Category
            $repository = new TRepository('Voo');
            
            // creates a criteria, ordered by id
            $criteria = new TCriteria;
            $order    = isset($param['order']) ? $param['order'] : 'id';
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
    
    /**
     * method onSave()
     * Executed whenever the user clicks at the save button
     */
    function onSave()
    {
        try
        {
            // open a transaction with database 'samples'
            TTransaction::open('fiscalizacao');
            
            // get the form data into an active record Category
            $category = $this->form->getData('Voo');
            
            // stores the object
            $category->store();
            
            // close the transaction
            TTransaction::close();
            
            // shows the success message
            new TMessage('info', 'Registro Salvo');
            
            // reload the listing
            $this->onReload();
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            
            // undo all pending operations
            TTransaction::rollback();
        }
    }
    
    /**
     * Clear form
     */
    public function onClear()
    {
        $this->form->clear();
    }
    
    /**
     * method onEdit()
     * Executed whenever the user clicks at the edit button
     */
    function onEdit($param)
    {
        try
        {
            if (isset($param['key']))
            {
                // get the parameter e exibe mensagem
                $key=$param['key'];
                
                // open a transaction with database 'samples'
                TTransaction::open('fiscalizacao');
                
                // instantiates object Category
                $category = new Voo($key);
                
                // lança os data do category no form
                $this->form->setData($category);
                
                // close the transaction
                TTransaction::close();
                $this->onReload();
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            
            // undo all pending operations
            TTransaction::rollback();
        }
    }
    
    /**
     * method onDelete()
     * executed whenever the user clicks at the delete button
     * Ask if the user really wants to delete the record
     */
    function onDelete($param)
    {
        // define the delete action
        $action = new TAction(array($this, 'Delete'));
        $action->setParameters($param); // pass the key parameter ahead
        
        // shows a dialog to the user
        new TQuestion('Deseja realmente Excluir o Registro ?', $action);
    }
    
    /**
     * method Delete()
     * Delete a record
     */
    function Delete($param)
    {
        try
        {
            // get the parameter $key
            $key=$param['key'];
            
            // open a transaction with database 'samples'
            TTransaction::open('fiscalizacao');
            
            // instantiates object Category
            $category = new Voo($key);
            
            // deletes the object from the database
            $category->delete();
            
            // close the transaction
            TTransaction::close();
            
            // reload the listing
            $this->onReload( $param );
            // shows the success message
            new TMessage('info', "Registro Apagado");
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }
    
    /**
     * method show()
     * Shows the page e seu conteúdo
     */
    function show()
    {
        // check if the datagrid is already loaded
        if (!$this->loaded)
        {
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }
}



