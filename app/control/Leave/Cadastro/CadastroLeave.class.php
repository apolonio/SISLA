<?php

class CadastroLeave extends TPage
{
    private $form;     
    private $datagrid;  
    private $loaded;

    public function __construct()
    {
        parent::__construct();
        
        parent::add(new TLabel('Cadastro de Leave por Militar: Todos campos devem ser preenchidos'));
//        parent::add(new TLabel('NOVAS FUNCIONALIDADES: FUNÃ‡ÃƒO e VOO'));
        
        $this->form = new TQuickForm;
        $notebook = new TNotebook(300, 400);
        $notebook->appendPage('Brabatur - Seja Bem Vindo!', $this->form);
        
        $postograd = new TCombo('postograd');
        $nome    = new TDBSeekButton('nome', 'fiscalizacao', $this->form->getName(), 'Militar', 'nome', 'nome', 'nome');
        $guerra = new TEntry('guerra');
        $su = new TCombo('su');
        $funcao = new TCombo('funcao');
        $subunidade = new TCombo('subunidade');
        $periodo = new TCombo('periodo');
        $inicioLeave = new TDate('inicioLeave');
        $terminoLeave = new TDate('terminoLeave');

        $ida = new TDate('ida');
        $vooIda = new TEntry('vooIda');
        $vooIda->setSize(120);
        $horaIda = new TEntry('horaIda');
        $horaIda->setSize(60); 

        $saidaBase = new TEntry('saidaBase');
        $saidaBase->setSize(90);
        
        $chegada = new TDate('chegada');
        $horaChegada = new TEntry('horaChegada');
        $horaChegada->setSize(60);
        $vooChegada = new TEntry('vooChegada');
        $vooChegada->setSize(120);
        $empresa = new Adianti\Widget\Form\TEntry('empresa');
        $empresaChegada = new Adianti\Widget\Form\TEntry('empresaChegada');
        $destino = new Adianti\Widget\Form\TCombo('destino');
        $status = new TCombo('status');
        $viajem = new TCombo('situacao');
        
       //PERSONALIZANDO OS CAMPOS NO FORMULARIO

        $lbl_vooida =  new TLabel('Nr Voo Ida');
        $lbl_vooida->setSize(90);  // Aqui voce controla o tamanho dos Labels
        $lbl_horaida =  new TLabel('Hora Ida');
        $lbl_horaida->setSize(100);
        $lbl_voochegada =  new TLabel('Nr Voo Cheg.');
        $lbl_voochegada->setSize(90);  // Aqui voce controla o tamanho dos Labels
        $lbl_horachegada =  new TLabel('Hora Chegada');
        $lbl_horachegada->setSize(100);
        $lbl_viajem =  new TLabel('Situação');
        $lbl_viajem->setSize(60);  // Aqui voce controla o tamanho dos Labels
        $lbl_destino =  new TLabel('Destino');
        $lbl_destino->setSize(60);
        $lbl_status =  new TLabel('Status');
        $lbl_status->setSize(60);  
        $lbl_saidabase =  new TLabel('Hora Saída Base');
        $lbl_saidabase->setSize(170); 
        $lbl_empresachegada =  new TLabel('Empresa Chegada');
        $lbl_empresachegada->setSize(60); 
     

        //  $guerra->setUpperCase();        
        $this->form->addQuickFields('Posto/Grad',      array($postograd,     new TLabel('Guerra'), $guerra));
        $this->form->addQuickField('Nome',$nome,450);
        $this->form->addQuickFields('SU',      array($su,     new TLabel('Fracao'), $subunidade));
        $this->form->addQuickFields('Funcao',      array($funcao,     new TLabel('Periodo'), $periodo));
        $this->form->addQuickFields('Inicio Leave',      array($inicioLeave,     new TLabel('Termino Leave'), $terminoLeave));

        $this->form->addQuickFields('Data Embarque', array($ida, $lbl_horaida,  $horaIda,$lbl_vooida,$vooIda ));     
        $this->form->addQuickFields('Data Chegada', array($chegada, $lbl_horachegada,$horaChegada,$lbl_voochegada,$vooChegada )); 

        //$this->form->addQuickFields('Data Embarque', array($ida, new TLabel('H. Embarque'), $horaIda));
        //$this->form->addQuickFields('Data Chegada', array($chegada, new TLabel('H. Chegada'), $horaChegada));
      //  $this->form->addQuickFields('Nr Voo Embarque', array($vooIda, new TLabel('Nr Voo Chegada'), $vooChegada));  
        $this->form->addQuickFields('Empresa Ida', array($empresa, $lbl_empresachegada, $empresaChegada,$lbl_saidabase,$saidaBase));      
        //$this->form->addQuickFields('Empresa Ida', array($empresa,     new TLabel('Empresa Chegada'), $empresaChegada));
       // $this->form->addQuickField('Hora Saída Base',$saidaBase,200);     
        $this->form->addQuickFields('Situação', array($viajem, $lbl_destino, $destino,$lbl_status,$status )); 

        
        
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

        
            
        //Caixa selecao Subunidade
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
        $pel['1ª Cia Fuz'] = '1ê Cia Fuz';
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
        
         $situacao = array();
         $situacao['Aguardando Autorização'] = 'AGUARDANDO AUTORIZAÇÃO';
         $situacao['Autorizado'] = 'AUTORIZADO';
         $situacao['Não Autorizado'] = 'NÃO AUTORIZADO';
         $status->addItems($situacao);

        $vj =  array();
        $vj['Vai Viajar'] = 'Vai Viajar';
        $vj['NÃo Vai Viajar'] = 'NÃo Vai Viajar';
        $vj['Viajando'] = 'Viajando';
        $vj['Finalizado'] = 'Finalizado';
        $viajem->addItems($vj);
        
        $pr =  array();
        $pr['1 Leave'] = '1 Leave';
        $pr['2 Leave'] = '2 Leave';
        $pr['3 Leave'] = '3 Leave';
        $pr['4 Leave'] = '4 Leave';
        $pr['5 Leave'] = '5 Leave';
        $periodo->addItems($pr);
        
        $fn =  array();
        $fn['Comando'] = 'Comando';
        $fn['Tropa'] = 'Tropa';
        $funcao->addItems($fn);
         
        $dst =  array();
        $dst['Brasil'] = 'Brasil';
        $dst['Europa'] = 'Europa';
        $dst['EUA'] = 'EUA';
        $dst['Republica Dominicana'] = 'Republica Dominicana';
        $dst['Santo Domingo'] = 'Santo Domingo';
        $dst['Juan Dolio'] = 'Juan Dolio';
        $dst['Punta Cana'] = 'Punta Cana';
        $dst['Boca Chica'] = 'Boca Chica';
        $dst['Base'] = 'Base';
        $dst['Outro'] = 'Outro';
        $destino->addItems($dst);

        $this->form->addQuickAction('Save', new TAction(array($this,'onSave')),'ico_save.png');
        
        parent::add($notebook);
        
    }
    
    public function onSave()
    {
        try
        {
            TTransaction::open('fiscalizacao');
            
            $category = $this->form->getData('Viajem');
            
            $category->store();
            
            TTransaction::close();
            
            new TMessage('info', 'Leave cadastrado com Sucesso!');

            $this->onReload();
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
            
            TTransaction::rollback();
        }
    }
    
    function onReload($param = NULL)
    {
        try
        {
            TTransaction::open('fiscalizacao');
            
            $repository = new TRepository('Viajem');

            $criteria = new TCriteria;
            $order    = isset($param['order']) ? $param['order'] : 'ida';
            $criteria->setProperty('order', $order);
        //    $criteria->add(new TFilter('situacao','!=','Finalizado');
            // load the objects according to criteria
            $categories = $repository->load($criteria);
            //$this->datagrid->onClear();
            if ($categories)
            {
                // iterate the collection of active records
                foreach ($categories as $category)
                {
                    // add the object inside the datagrid
                    //$this->datagrid->addItem($category);
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
     * Clear form
     */
    public function onClear()
    {
        $this->form->clear();
    }
    
    function show()
    {
        if (!$this->loaded)
        {
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }
   
}//fim da classe

?>
