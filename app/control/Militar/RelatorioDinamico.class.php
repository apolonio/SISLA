<?php

/** 
 * Esser Relatorio exibi dados da tabela system_militar e permiti exportar arquivo csv(excel)
 * class CustomerDataGridView extends TPage
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class RelatorioDinamico extends TPage
{
    private $form;      // search form
    private $datagrid;  // listing
    private $pageNavigation;
    private $loaded;
    
    /**
     * Class constructor
     * Creates the page, the search form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        new TSession;
        
        // creates the form
        $this->form = new TForm('form_search_militar');
        
        // create the form fields
        $nome   = new TEntry('nome');
        $su = new TCombo('su');
        
   //     $nome->setSize(170);
   //     $su->setSize(126);
        
        $nome->setValue(TSession::getValue('nome'));
        $su->setValue(TSession::getValue('su'));
        
        
        //Caixa selecao Subunidade
        $unidade = array();
        $unidade['1ª Cia Fuz'] = '1ª Cia Fuz';
        $unidade['2ª Cia Fuz'] = '2ª Cia Fuz';
        $unidade['CCAp/Btl F Paz'] = 'CCAp/Btl F Paz';
        $unidade['EM/Btl F Paz'] = 'EM/Btl F Paz';
        $unidade['Esqd C Mec'] = 'Esqd C Mec';
        $su->addItems($unidade);
        
        
        $table = new TTable;
        
        $row = $table->addRow();
        $cell=$row->addCell('');
        $cell->width= 80;
        $row->addCell($nome);
        
        $cell=$row->addCell('');
        $row->addCell($su);
        
        $this->form->add($table);
        
        // creates the action button
        $button1=new TButton('find');
        $button1->setAction(new TAction(array($this, 'onSearch')), 'Buscar');
        $button1->setImage('ico_find.png');

        $button2=new TButton('new');
        $button2->setAction(new TAction(array('MilitarForm', 'onEdit')), 'Novo');
        $button2->setImage('ico_new.png');
        
        $button3=new TButton('csv');
        $button3->setAction(new TAction(array($this, 'onExportCSV')), 'CSV');
        $button3->setImage('ico_print.png');
        $button2->setImage('ico_new.png');
        
      
        
        $row->addCell($button1);
        $row->addCell($button2);
        $row->addCell($button3);
        
        $this->form->setFields(array($nome, $su, $button1, $button2, $button3));
        
        // creates a DataGrid
        $this->datagrid = new TQuickGrid;
        $this->datagrid->setHeight(350);

        // creates the datagrid columns
        $this->datagrid->addQuickColumn('Id', 'id', 'right', 40, new TAction(array($this, 'onReload')), array('order', 'id'));
        $this->datagrid->addQuickColumn('Posto/Grad', 'postograd', 'left', 170, new TAction(array($this, 'onReload')), array('order', 'postograd'));
        $this->datagrid->addQuickColumn('Nome', 'nome', 'left', 170, new TAction(array($this, 'onReload')), array('order', 'nome'));
        $this->datagrid->addQuickColumn('Guerra', 'guerra', 'left', 140, new TAction(array($this, 'onReload')), array('order', 'guerra'));
        $this->datagrid->addQuickColumn('SU', 'su', 'left', 140, new TAction(array($this, 'onReload')), array('order', 'su'));
        $this->datagrid->addQuickColumn('Fração', 'pelotao', 'left', 140, new TAction(array($this, 'onReload')), array('order', 'pelotao'));
       
        //$this->datagrid->addQuickColumn('Identidade', 'identidade', 'left', 140, new TAction(array($this, 'onReload')), array('order', 'identidade'));
        //$this->datagrid->addQuickColumn('CPF', 'cpf', 'left', 140, new TAction(array($this, 'onReload')), array('order', 'cpf'));
        //$this->datagrid->addQuickColumn('Prec-CP', 'preccp', 'left', 140, new TAction(array($this, 'onReload')), array('order', 'preccp'));
    
        $this->datagrid->addQuickColumn('Data Nasc.', 'dataNascimento', 'left', 140, new TAction(array($this, 'onReload')), array('order', 'dataNascimento'));
        $this->datagrid->addQuickColumn('Tipo Pass.', 'tipoPassaporteOficial', 'left', 140, new TAction(array($this, 'onReload')), array('order', 'tipoPassaporteOficial'));
        $this->datagrid->addQuickColumn('Pass. Oficial', 'passaporteOficial', 'left', 140, new TAction(array($this, 'onReload')), array('order', 'passaporteOficial'));
        $this->datagrid->addQuickColumn('Data Expedição', 'dataExpedicao', 'left', 140, new TAction(array($this, 'onReload')), array('order', 'dataExpedicao'));
        $this->datagrid->addQuickColumn('Data Expiração', 'dataExpiracao', 'left', 140, new TAction(array($this, 'onReload')), array('order', 'dataExpiracao'));
     //   $this->datagrid->addQuickColumn('Nº Visto', 'numeroVisto', 'left', 140, new TAction(array($this, 'onReload')), array('order', 'numeroVisto'));
        
     //   $this->datagrid->addQuickColumn('Pass. Civil', 'passaporteCivil', 'left', 140, new TAction(array($this, 'onReload')), array('order', 'passaporteCivil'));

                
        $this->datagrid->addQuickColumn('FIRST', 'first', 'left', 140, new TAction(array($this, 'onReload')), array('order', 'first'));
        $this->datagrid->addQuickColumn('MIDDLE', 'middle', 'left', 140, new TAction(array($this, 'onReload')), array('order', 'middle'));
        $this->datagrid->addQuickColumn('LAST', 'last', 'left', 140, new TAction(array($this, 'onReload')), array('order', 'last'));
        //$this->datagrid->addQuickColumn('Address', 'address', 'left', 190);

        // creates two datagrid actions
        $this->datagrid->addQuickAction('Edit', new TDataGridAction(array('MilitarForm', 'onEdit')), 'id', 'ico_edit.png');
        $this->datagrid->addQuickAction('Delete', new TDataGridAction(array($this, 'onDelete')), 'id', 'ico_delete.png');
        
        // create the datagrid model
        $this->datagrid->createModel();
        
        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());
        
        // creates the page structure using a vertical box
        $vbox = new TVBox;
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->form);
        $vbox->add($this->datagrid);
        $vbox->add($this->pageNavigation);
        
        // add the box inside the page
        parent::add($vbox);
    }
    
    /**
     * method onSearch()
     * Register the filter in the session when the user performs a search
     */
    public function onSearch()
    {
        // get the search form data
        $data = $this->form->getData();
       
        // check if the user has filled the form
        if (isset($data->nome) AND ($data->su))
        {
            // creates a filter using what the user has typed
            $filter = new TFilter('nome', 'like', "{$data->nome}%");
            
            // stores the filter in the session
            TSession::setValue('nome', $filter);
            TSession::setValue('su',   $data->su);
            
        }
        else
        {
            TSession::setValue('nome', NULL);
            TSession::setValue('su', '');
        }
        
        
        // check if the user has filled the form
        if ($data->su)
        {
            // creates a filter using what the user has typed
            $filter = new TFilter('(SELECT su from system_militar)', 'like', "{$data->su}%");
            
            // stores the filter in the session
            TSession::setValue('su', $filter);
            TSession::setValue('su', $data->su);
        }
        else
        {
            TSession::setValue('nome', NULL);
            TSession::setValue('nome', '');
        }
        
        // fill the form with data again
        $this->form->setData($data);
        
        $param=array();
        $param['offset']    =0;
        $param['first_page']=1;
        $this->onReload($param);
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
            
            // creates a repository for Customer
            $repository = new TRepository('Militar');
            $limit = 20;
            
            // creates a criteria
            $criteria = new TCriteria;
            
            $newparam = $param; // define new parameters
            if (isset($newparam['order']) AND $newparam['order'] == 'system_militar->su')
            {
                $newparam['order'] = '(select su from system_militar)';
            }
            
            // default order
            if (empty($newparam['order']))
            {
                $newparam['order'] = 'id';
                $newparam['direction'] = 'asc';
            }
            
            $criteria->setProperties($newparam); // order, offset
            $criteria->setProperty('limit', $limit);
            
            if (TSession::getValue('militar_filter1'))
            {
                // add the filter stored in the session to the criteria
                $criteria->add(TSession::getValue('militar_filter1'));
            }
            
            if (TSession::getValue('militar_filter2'))
            {
                // add the filter stored in the session to the criteria
                $criteria->add(TSession::getValue('militar_filter2'));
            }
            
            // load the objects according to criteria
            $militar = $repository->load($criteria, FALSE);
            $this->datagrid->clear();
            if ($militar)
            {
                foreach ($militar as $militares)
                {
                    // add the object inside the datagrid
                    $this->datagrid->addItem($militares);
                }
            }
            
            // reset the criteria for record count
            $criteria->resetProperties();
            $count= $repository->count($criteria);
            
            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($limit); // limit
            
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
    
    public function onExportCSV()
    {
        $this->onSearch();

        try
        {
            // open a transaction with database 'samples'
            TTransaction::open('fiscalizacao');
            
            // creates a repository for Customer
            $repository = new TRepository('Militar');
            
            // creates a criteria
            $criteria = new TCriteria;
            
            if (TSession::getValue('militar_filter1'))
            {
                // add the filter stored in the session to the criteria
                $criteria->add(TSession::getValue('militar_filter1'));
            }
            
            if (TSession::getValue('militar_filter2'))
            {
                // add the filter stored in the session to the criteria
                $criteria->add(TSession::getValue('militar_filter2'));
            }
            
          //  $csv = '';
            $csv = '';
            // load the objects according to criteria
            $militar = $repository->load($criteria);
            if ($militar)
            {
                
                foreach ($militar as $militares)
                {
                    $csv .= $militares->id.';'.
                            $militares->nome.';'.
                            $militares->postograd.';'.
                            $militares->guerra.';'.
                            $militares->su.';'.
                            $militares->pelotao.';'.
                            $militares->dataNascimento.';'.
                            $militares->tipoPassaporteOficial.';'.
                            $militares->passaporteOficial.';'.
                            $militares->dataExpedicao.';'.
                            $militares->dataExpiracao.';'.
                            $militares->numeroVisto.';'.
                            $militares->first.';'.
                            $militares->middle.';'.
                            $militares->last."\n";
                }
                file_put_contents('app/output/customer.csv', $csv);
                TPage::openFile('app/output/customer.csv');
            }
            // close the transaction
            TTransaction::close();
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }

    }
    
 
    public function onDelete($param)
    {
        // define the next action
        $action1 = new TAction(array($this, 'Delete'));
        $action1->setParameters($param); // pass 'key' parameter ahead
        
        // shows a dialog to the user
        new TQuestion('Tem certeza que deseja apagar o registo ?', $action1);
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
            
            // instantiates object Customer
            $militar = new Militar($key);
            // deletes the object from the database
            $militar->delete();
            
            // close the transaction
            TTransaction::close();
            
            // reload the listing
            $this->onReload($param);
            // shows the success message
            new TMessage('info', "Registro apagado!");
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
     * method show()
     * Shows the page
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
    
}
?>