<?php
/**
 * Description of CadastroLeaveOficiais
 *
 * @author junio
 */
class CadastroComitiva extends Adianti\Control\TPage
{
    private $form;      // registration form
    private $datagrid;  // listing
    private $loaded;

    public function __construct()
    {
        parent::__construct();
        
        parent::add(new TLabel('GESTÃO COMITIVAS DO G1'));
       
        $this->form = new TQuickForm;
        $notebook = new TNotebook(300, 300);
        $notebook->appendPage('BRABAT - Comitivas!', $this->form);
        
        //criando os campos
        $idChefeVtr    = new TCombo('idChefeVtr');
        $idViatura = new TCombo('idViatura');
        $tipoComitiva = new TEntry('tipoComitiva');
        
        $nome = new TEntry('nome');
        
        $dataChegada = new TDate('dataChegada');
        $horaChegada = new TEntry('horaChegada');
        $vooChegada = new TEntry('vooChegada');
        
        $dataRegresso = new TDate('dataRegresso');
        $horaRegresso = new TEntry('horaRegresso');
        $vooRegresso = new TEntry('vooRegresso');
         
        $efetivo = new TEntry('efetivo');
        $horaSaidaBase = new TEntry('horaSaidaBase');
        
        $hodoIda = new TEntry('hodoIda');
        $hodoChegada = new TEntry('hodoChegada');
        $obs = new Adianti\Widget\Form\TText('obs');
        
        
        $vtr = array();
        $vtr['VAN-UN25269'] = 'VAN-UN25269';
        $vtr['VAN-UN25265'] = 'VAN-UN25265';
        $vtr['MARRUA-UN24772'] = 'MARRUÁ-UN24772';
        $idViatura->addItems($vtr);
       
        $mil = array();
        $mil['TEN INOUE'] = 'TEN INOUE';
        $mil['SGT VERISSIMO'] = 'SGT VERISSIMO';
        $mil['SGT SANTIAGO'] = 'SGT SANTIAGO';
        $idChefeVtr->addItems($mil);
        
      //  $data->addValidation('data', new TDateValidator(),array('dd/mm/yyyy'));
        
        //campos aos formularios
        $this->form->addQuickFields('Chefe Vtr', array($idChefeVtr, new TLabel('Viatura'), $idViatura));
        $this->form->addQuickField('Comitiva',$tipoComitiva,200);
        $this->form->addQuickField('Nome',$nome,300);
        $this->form->addQuickFields('Data Chegada', array($dataChegada, new TLabel('Hora Chegada'), $horaChegada));
        $this->form->addQuickFields('Data Regresso', array($dataRegresso, new TLabel('Hora Regresso'), $horaRegresso));
        $this->form->addQuickFields('Voo Chegada', array($vooChegada, new TLabel('Voo Regresso'), $vooRegresso));
        $this->form->addQuickField('Efetivo Transportado',$efetivo,50);
        $this->form->addQuickField('Hora Saída Base',$horaSaidaBase,100);
        $this->form->addQuickFields('Hodômetro Ida', array($hodoIda, new TLabel('Hodômetro Chegada'), $hodoChegada));
        $this->form->addQuickField('OBS',$obs,300);
        
        //definindo acao do formulario
        $this->form->addQuickAction('Save', new TAction(array($this,'onSave')),'ico_save.png');
        
        //colocando no formulario
        parent::add($notebook);
        
    }
    
    public function onSave()
    {
        try
        {
            // open a transaction with database 'samples'
            TTransaction::open('fiscalizacao');
            
            // get the form data into an active record Category
            $category = $this->form->getData('Comitiva');
            
            // stores the object
            $category->store();
            
            // close the transaction
            TTransaction::close();
            
            // shows the success message
            new TMessage('info', 'Saída cadastrada com Sucesso!');
            
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
    
    function onReload($param = NULL)
    {
        try
        {
            // open a transaction with database 'samples'
            TTransaction::open('fiscalizacao');
            
            // creates a repository for Category
            $repository = new TRepository('Comitiva');
            
            // creates a criteria, ordered by id
            $criteria = new TCriteria;
            $order    = isset($param['order']) ? $param['order'] : 'dataChegada';
            $criteria->setProperty('order', $order);
            
            // load the objects according to criteria
            $categories = $repository->load($criteria);
         //   $this->datagrid->onClear();
//            if ($categories)
//            {
//                // iterate the collection of active records
//                foreach ($categories as $category)
//                {
//                    // add the object inside the datagrid
//                    $this->datagrid->addItem($category);
//                }
//            }
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
     * Clear form
     */
    public function onClear()
    {
        $this->form->clear();
    }
    
    function show()
    {
        // check if the datagrid is already loaded
        if (!$this->loaded)
        {
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }

}//fim da classe


?>
