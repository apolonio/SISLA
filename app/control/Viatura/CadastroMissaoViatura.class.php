<?php
/**
 * Description of CadastroLeaveOficiais
 *
 * @author junio
 */
class CadastroMissaoViatura extends Adianti\Control\TPage
{
    private $form;      
    private $datagrid;  
    private $loaded;

    public function __construct()
    {
        parent::__construct();
        
        parent::add(new TLabel('GESTÃO VIATURAS DO G1'));

 
       
        $this->form = new TQuickForm;
        $notebook = new TNotebook(300, 300);
        $notebook->appendPage('Brabatur - Viaturas!', $this->form);
        
        //criando os campos
        
        $idMotorista    = new TEntry('idMotorista');
        $idChefeVtr    = new TCombo('idChefeVtr');
        $idViatura = new TCombo('idViatura');
        $ida = new TDate('ida');
        $horaIda = new TEntry('horaIda');
        $horaChegada = new TEntry('horaChegada');
        $hodoIda = new TEntry('hodoIda');
        $hodoChegada = new TEntry('hodoChegada');
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
        $dest['OUTRO'] = 'OUTRO';
        $destino->addItems($dest);
        
        $mil = array();
        $mil['TEN INOUE'] = 'TEN INOUE';
        $mil['SGT VERISSIMO'] = 'SGT VERISSIMO';
        $mil['SGT SANTIAGO'] = 'SGT SANTIAGO';
        $idChefeVtr->addItems($mil);
        
      //  $data->addValidation('data', new TDateValidator(),array('dd/mm/yyyy'));
        
        //campos aos formularios
        $this->form->addQuickField('Chefe Viatura',$idChefeVtr,200);
        $this->form->addQuickField('Viatura',$idViatura,200);
        $this->form->addQuickField('Motorista',$idMotorista,200);
        $this->form->addQuickField('Dia',$ida,100);
        $this->form->addQuickFields('Hora Ida', array($horaIda, new TLabel('Hora Chegada'), $horaChegada));
        $this->form->addQuickFields('Hodômetro Inicial', array($hodoIda, new TLabel('Hodômetro Final'), $hodoChegada));
        $this->form->addQuickFields('Destino', array($destino, new TLabel('Missao'),$alteracao));
        
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
            $category = $this->form->getData('Viatura');
            
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
            $repository = new TRepository('Viatura');
            
            // creates a criteria, ordered by id
            $criteria = new TCriteria;
            $order    = isset($param['order']) ? $param['order'] : 'ida';
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
