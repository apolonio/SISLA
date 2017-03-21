<?php
/** 
 * Classe CadastroMilitar efetua o cadstro dos militares
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class CadastroMilitar extends TWindow
{
    private $form;
    
    function __construct()
    {
        parent::__construct();
        parent::setTitle('Cadastrar Militar');
        parent::setSize(720, 750);
        
        //parent::add(new TLabel('Pelotão Obras'));
        
        $this->form = new TQuickForm;
        
        $notebook = new TNotebook(680, 750);
        $notebook->appendPage('Cadastrar Militar', $this->form);
        
        
        //criando os campos
        
        $postograd = new TCombo('postograd');
        $nome = new TEntry('nome');
        $guerra = new TEntry('guerra');
        $sex = new TCombo('sexo');
        $forca = new TCombo('forca');
        $su = new TCombo('su');
        $pelotao = new TCombo('pelotao');
        $identidade = new TEntry('identidade');
        $cpf = new TEntry('cpf');
        $preccp = new TEntry('preccp');
        $dataNascimento = new TDate('dataNascimento');
        $passaporteOficial = new TEntry('passaporteOficial');
        $dataExpedicao = new TDate('dataExpedicao');
        $dataExpiracao = new TDate('dataExpiracao');
        $tipoPassaporte = new TCombo('tipoPassaporteOficial');
        $passaporteCivil = new TEntry('passaporteCivil');
        $dataExpiracaoCivil = new TDate('dataExpiracaoCivil');
        $numeroVisto = new TEntry('numeroVisto');
        
        $first = new TEntry('first');
        $middle = new TEntry('middle');
        $last = new TEntry('last');
        
        
        
        //campos aos formularios
        
        $this->form->addQuickField('Posto/Grad',$postograd,150);
        $this->form->addQuickField('Nome',$nome,300);
        $this->form->addQuickField('Guerra',$guerra,150);
        $this->form->addQuickField('Sexo',$sex,150);
        
        $this->form->addQuickField('Força',$forca,150);
        $this->form->addQuickField('SU',$su,150);
        $this->form->addQuickField('Pel/Célula',$pelotao,150);
        
        $this->form->addQuickField('Identidade',$identidade,150);
        $this->form->addQuickField('CPF',$cpf,150);
        $this->form->addQuickField('Prec-CP',$preccp,150);
        $this->form->addQuickField('Data Nascimento',$dataNascimento,150);
        
        $this->form->addQuickField('Passaporte Oficial',$passaporteOficial,150);
        $this->form->addQuickField('Data Expedição ',$dataExpedicao,150);
        $this->form->addQuickField('Data Expiração ',$dataExpiracao,150);
        $this->form->addQuickField('Tipo Passaporte ',$tipoPassaporte,150);
        $this->form->addQuickField('Passaporte Civil ',$passaporteCivil,150);
        $this->form->addQuickField('Data Expiração P.Civil ',$dataExpiracaoCivil,150);
        $this->form->addQuickField('Nº Visto ',$numeroVisto,150);
        
        $this->form->addQuickField('First',$first,150);
        $this->form->addQuickField('Middle',$middle,150);
        $this->form->addQuickField('Last',$last,150);
        
        
        $f = array();
        $f['Exército'] = 'Exército';
        $f['Marinha'] = 'Marinha';
        $f['Aeronáutica'] = 'Aeronáutica';
        $forca->addItems($f);
        
         
        $tipoP = array();
        $tipoP['PD'] = 'PD';
        $tipoP['PO'] = 'PO';
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
    

   
}//fim da classe


?>
