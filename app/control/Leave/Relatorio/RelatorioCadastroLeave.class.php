<?php

class RelatorioCadastroLeave extends TPage
{
    private $form;      // registration form
    private $datagrid;  // listing
    private $loaded;
    
 
    public function __construct()
    {
        parent::__construct();
        
        // create the form
        $this->form = new TQuickForm('form_relatorio_cadastro_leave');
        $this->form->class = 'tform'; 
        $this->form->setFormTitle('Relatório Cadastro/Leave');
        
        // create the form fields
   
        $id     = new TEntry('id');
        $postograd     = new TCombo('postograd');
        $nome   = new TEntry('nome');
        $guerra   = new TEntry('guerra');
        $su  = new TCombo('su');
        $subunidade  = new TCombo('subunidade');
        $ida   = new Adianti\Widget\Form\TDate('ida');
        $horaIda   = new \Adianti\Widget\Form\TEntry('horaIda');
        $saidaBase   = new TEntry('saidaBase');
        $chegada   = new Adianti\Widget\Form\TDate('chegada');
        $horaChegada = new \Adianti\Widget\Form\TEntry('horaChegada');
        $destino   = new TEntry('destino');
        $empresa   = new TEntry('empresa');
        $obs   = new TEntry('obs');
        $status  = new TCombo('status');
        $viajando  = new TCombo('situacao');

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
        
        $unidade = array();
        $unidade['1ª Cia Fuz'] = '1ª Cia Fuz';
        $unidade['2ª Cia Fuz'] = '2ª Cia Fuz';
        $unidade['CCAp/Btl F Paz'] = 'CCAp/Btl F Paz';
        $unidade['EM/Btl F Paz'] = 'EM/Btl F Paz';
        $unidade['Esqd C Mec'] = 'Esqd C Mec';
        $su->addItems($unidade);
        
        
        $pel = array();
        $pel['Cmt'] = 'Cmt';
        $pel['EM Esp'] = 'EM Esp';
        $pel['1ª Cia Fuz'] = '1ª Cia Fuz';
        $pel['2ª Cia Fuz'] = '2ª Cia Fuz';
        $pel['CCAp/Btl F Paz'] = 'CCAp/Btl F Paz';
        $pel['EM/Btl F Paz'] = 'EM/Btl F Paz';
        $pel['Esqd C Mec'] = 'Esqd C Mec';
        $pel['DOPAZ'] = 'DOPAZ';
        $pel['DOAI'] = 'DOAI';
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
       
        $situacao = array();
        $situacao['Aguar. Autorização'] = 'AGUARDANDO AUTORIZAÇÃO';
        $situacao['Autorizado'] = 'AUTORIZADO';
        $situacao['Não Autorizado'] = 'NÃO AUTORIZADO';
      //  $situacao['Finalizado'] = 'FINALIZADO';
        $status->addItems($situacao);
        
         $vj = array();
        $vj['Base'] = 'BASE';
        $vj['Viajando'] = 'VIAJANDO';
        $vj['Finalizado'] = 'FINALIZADO';
        $viajando->addItems($vj);


        // add the fields in the form
        $this->form->addQuickFields('ID', array($id, new TLabel('Posto/Grad:'), $postograd));
        $this->form->addQuickField('Nome',  $nome, 430);
        $this->form->addQuickField('Guerra',  $guerra, 300);
        $this->form->addQuickFields('SU', array($su, new TLabel('Subunidade'), $subunidade));
        $this->form->addQuickFields('Data Ida', array($ida, new TLabel('Hora Ida'), $horaIda));
        $this->form->addQuickFields('Data Chegada', array($chegada, new TLabel('Hora Chegada'), $horaChegada));
        $this->form->addQuickFields('Saída Base',array($saidaBase, new TLabel('Destino'), $destino));
        //$this->form->addQuickField('Obs', $obs, 150);
        
        $this->form->addQuickFields('Empresa',array($empresa, new TLabel('Obs'), $obs));
        $this->form->addQuickFields('Status',array($status, new TLabel('Situação'), $viajando));
        
        
        $this->form->addQuickAction('Salvar', new TAction(array($this, 'onSave')), 'ico_save.png');
       // $this->form->addQuickAction('Novo',  new TAction(array($this, 'onClear')), 'ico_new.png');
     
        // id not editable
        $id->setEditable(FALSE);
        
        // create the datagrid
        $this->datagrid = new TQuickGrid;
        $this->datagrid->style = 'width: 80%';
        $this->datagrid->setHeight(400);
        
        // add the datagrid columns
        $this->datagrid->addQuickColumn('ID',   'id',  'center', 50, new TAction(array($this, 'onReload')), array('order', 'id'));
        $this->datagrid->addQuickColumn('Posto/Grad', 'postograd','left',  70, new TAction(array($this, 'onReload')), array('order', 'postograd'));
        $this->datagrid->addQuickColumn('Nome', 'nome','left',  250, new TAction(array($this, 'onReload')), array('order', 'nome'));
        //$this->datagrid->addQuickColumn('Guerra', 'guerra','left',  390, new TAction(array($this, 'onReload')), array('order', 'guerra'));
        $this->datagrid->addQuickColumn('SU', 'su','left',  150, new TAction(array($this, 'onReload')), array('order', 'su'));
        $this->datagrid->addQuickColumn('SubUnidade', 'subunidade','left',  150, new TAction(array($this, 'onReload')), array('order', 'subunidade'));
        
        $this->datagrid->addQuickColumn('Data Ida', 'ida','left',  100, new TAction(array($this, 'onReload')), array('order', 'ida'));
        $this->datagrid->addQuickColumn('Hora Ida', 'horaIda','left',  70, new TAction(array($this, 'onReload')), array('order', 'ida'));
        $this->datagrid->addQuickColumn('Saída Base', 'saidaBase','left',  70, new TAction(array($this, 'onReload')), array('order', 'saidaBase'));
        $this->datagrid->addQuickColumn('Data Chegada', 'chegada','left',  100, new TAction(array($this, 'onReload')), array('order', 'chegada'));
        $this->datagrid->addQuickColumn('Hora Chegada', 'horaChegada','left',  70, new TAction(array($this, 'onReload')), array('order', 'horaChegada'));
        
        $this->datagrid->addQuickColumn('Destino', 'destino','left',  100, new TAction(array($this, 'onReload')), array('order', 'destino'));
       // $this->datagrid->addQuickColumn('Empresa', 'empresa','left',  100, new TAction(array($this, 'onReload')), array('order', 'empresa'));
        $this->datagrid->addQuickColumn('Obs', 'obs','left',  100, new TAction(array($this, 'onReload')), array('order', 'obs'));
        $this->datagrid->addQuickColumn('STATUS', 'status','left',  100, new TAction(array($this, 'onReload')), array('order', 'status'));
        $this->datagrid->addQuickColumn('SITUAÇÃO', 'situacao','left',  100, new TAction(array($this, 'onReload')), array('order', 'situacao'));

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
            $repository = new TRepository('Viajem');
            
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
            $category = $this->form->getData('Viajem');
            
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
                $category = new Viajem($key);
                
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
            $category = new Viajem($key);
            
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


