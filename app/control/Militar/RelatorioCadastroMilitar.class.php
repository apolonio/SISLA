<?php
class RelatorioCadastroMilitar extends TPage
{
    private $form;      // registration form
    private $datagrid;  // listing
    private $loaded;

    public function __construct()
    {
        parent::__construct();
        
        // create the form
        $this->form = new TQuickForm('form_relatorio_cadastro_militar');
        $this->form->class = 'tform'; // CSS class
        $this->form->setFormTitle('Relatório Cadastro Militar');
       
    //Criacao Campos
        $id     = new TEntry('id');
        $postograd = new TCombo('postograd');
        $nome = new TEntry('nome');
        $guerra = new TEntry('guerra');
        $sex = new TCombo('sexo');
        $forca = new TCombo('forca');
        $su = new TCombo('su');
        $subunidade = new TCombo('subunidade');
        $identidade = new TEntry('identidade');
        $cpf = new TEntry('cpf');
        $preccp = new TEntry('preccp');
        $dataNascimento = new TEntry('dataNascimento');
        $passaporteOficial = new TEntry('passaporteOficial');
        $dataExpedicao = new TEntry('dataExpedicao');
        $dataExpiracao = new TEntry('dataExpiracao');
        $tipoPassaporte = new TCombo('tipoPassaporteOficial');
       // $passaporteCivil = new TEntry('passaporteCivil');
       // $dataExpiracaoCivil = new TDate('dataExpiracaoCivil');
       // $numeroVisto = new TEntry('numeroVisto');
        
        $first = new TEntry('first');
        $middle = new TEntry('middle');
        $last = new TEntry('last');
        
        $f = array();
        $f['Exército'] = 'Exército';
        $f['Marinha'] = 'Marinha';
        $f['Aeronáutica'] = 'Aeronáutica';
        $forca->addItems($f);
        
        
        $tipoP = array();
        $tipoP['PD'] = 'Pass.Diplomatico';
        $tipoP['PO'] = 'Pass.Oficial';
        $tipoPassaporte->addItems($tipoP);
        
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
        
        $sexo = array();
        $sexo['Masculino'] = 'Masculino';
        $sexo['Feminino'] = 'Feminino';
        $sex->addItems($sexo);
        
        //campos aos formularios
        $this->form->addQuickField('ID',$id, 80);
        $this->form->addQuickFields('Posto/Grad', array($postograd, new TLabel('Sexo'), $sex));
        $this->form->addQuickField('Nome',$nome,450);
        $this->form->addQuickFields('Guerra', array($guerra, new TLabel('Força'), $forca));
        $this->form->addQuickFields('SU', array($su, new TLabel('Pel/Célula'), $subunidade));
        $this->form->addQuickFields('Identidade', array($identidade, new TLabel('CPF       '), $cpf));
        $this->form->addQuickFields('Prec-CP', array($preccp, new TLabel('Data Nascimento      '), $dataNascimento));
        $this->form->addQuickFields('Tipo Passaporte', array($tipoPassaporte, new TLabel('Nº Passaporte Oficial'), $passaporteOficial));
        $this->form->addQuickFields('Data Expedição', array($dataExpedicao, new TLabel('Data Expiração'), $dataExpiracao));
      //  $this->form->addQuickFields('First', array($first, new TLabel('Middle'),$middle));
      //  $this->form->addQuickField('Last',$last,150);
        
        // create the form actions
        $this->form->addQuickAction('Salvar', new TAction(array($this, 'onSave')), 'ico_save.png');
        $this->form->addQuickAction('Novo',  new TAction(array($this, 'onClear')), 'ico_new.png');
     
        // id not editable
        $id->setEditable(FALSE);
        
        // create the datagrid
        $this->datagrid = new TQuickGrid;
        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(800);
        
        // add the datagrid columns
        $this->datagrid->addQuickColumn('ID',   'id',  'center', 50, new TAction(array($this, 'onReload')), array('order', 'id'));
        $this->datagrid->addQuickColumn('P/G', 'postograd','left',  80, new TAction(array($this, 'onReload')), array('order', 'postograd'));
        $this->datagrid->addQuickColumn('Nome', 'nome','left',  250, new TAction(array($this, 'onReload')), array('order', 'nome'));
        $this->datagrid->addQuickColumn('Guerra', 'guerra','left',  150, new TAction(array($this, 'onReload')), array('order', 'guerra'));
       // $this->datagrid->addQuickColumn('Sexo', 'sexo','left',  390, new TAction(array($this, 'onReload')), array('order', 'sexo'));
       // $this->datagrid->addQuickColumn('Força', 'forca','left',  390, new TAction(array($this, 'onReload')), array('order', 'forca'));
        $this->datagrid->addQuickColumn('SU', 'su','left',  100, new TAction(array($this, 'onReload')), array('order', 'su'));
        $this->datagrid->addQuickColumn('Pelotão', 'subunidade','left',  100, new TAction(array($this, 'onReload')), array('order', 'subunidade'));
        $this->datagrid->addQuickColumn('Nascimento', 'dataNascimento','left',  100, new TAction(array($this, 'onReload')), array('order', 'dataNascimento'));
        $this->datagrid->addQuickColumn('Prec-CP', 'preccp','left',  100, new TAction(array($this, 'onReload')), array('order', 'preccp'));
        $this->datagrid->addQuickColumn('Identidade', 'identidade','left',  100, new TAction(array($this, 'onReload')), array('order', 'identidade'));
        $this->datagrid->addQuickColumn('CPF', 'cpf','left',  100, new TAction(array($this, 'onReload')), array('order', 'cpf'));
  //      $this->datagrid->addQuickColumn('Tipo Pass.', 'tipoPassaporteOficial','left',  100, new TAction(array($this, 'onReload')), array('order', 'tipoPassaporteOficial'));
        $this->datagrid->addQuickColumn('NºPass.Oficial', 'passaporteOficial','left',  100, new TAction(array($this, 'onReload')), array('order', 'passaporteOficial'));
      //  $this->datagrid->addQuickColumn('Expedição', 'dataExpedicao','left',  390, new TAction(array($this, 'onReload')), array('order', 'dataExpedicao'));
       // $this->datagrid->addQuickColumn('Expiração', 'dataExpiracao','left',  390, new TAction(array($this, 'onReload')), array('order', 'dataExpiracao'));
       // $this->datagrid->addQuickColumn('Nº Visto', 'numeroVisto','left',  390, new TAction(array($this, 'onReload')), array('order', 'numeroVisto'));
        //$this->datagrid->addQuickColumn('NºPass.Civil', 'passaporteCivil','left',  390, new TAction(array($this, 'onReload')), array('order', 'passaporteCivil'));
       // $this->datagrid->addQuickColumn('ExpiracaoCivil', 'dataExpiracaoCivil','left',  390, new TAction(array($this, 'onReload')), array('order', 'dataExpiracaoCivil'));
       // $this->datagrid->addQuickColumn('FIRST', 'first','left',  120, new TAction(array($this, 'onReload')), array('order', 'first'));
        //$this->datagrid->addQuickColumn('MIDDLE', 'middle','left',  90, new TAction(array($this, 'onReload')), array('order', 'middle'));
        //$this->datagrid->addQuickColumn('LAST', 'last','left',  120, new TAction(array($this, 'onReload')), array('order', 'last'));

         //execucao
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
            $repository = new TRepository('Militar');
            
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
            $category = $this->form->getData('Militar');
            
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
                $category = new Militar($key);
                
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
            $category = new Militar($key);
            
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



