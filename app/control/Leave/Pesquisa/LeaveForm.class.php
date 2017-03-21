<?php

class LeaveForm extends TStandardForm
{
    protected $form; // form

    function __construct()
    {
        parent::__construct();
        // creates the form
        $this->form = new TQuickForm('form_Leave');
        $this->form->class = 'tform'; // CSS class
        $this->form->style = 'width: 850px;';
        
        // defines the form title
        $this->form->setFormTitle('Viajem');
        
        parent::setDatabase('fiscalizacao'); //banco
        parent::setActiveRecord('Viajem'); //tabela
        
        // create the form fields
        $id = new TEntry('id');
        $postograd = new TCombo('postograd');
        $nome    = new TDBSeekButton('nome', 'fiscalizacao', $this->form->getName(), 'Militar', 'nome', 'nome', 'nome');
        $guerra = new TEntry('guerra');
        $funcao = new TCombo('funcao');
        $su = new TCombo('su');
        $subunidade = new TCombo('subunidade');

        $periodo = new TCombo('periodo');
        
        
        $inicioLeave = new TDate('inicioLeave');
        $inicioLeave->setsize(100);
        $terminoLeave = new TDate('terminoLeave');
        $terminoLeave->setsize(100);
       
        $ida = new TDate('ida');
        $ida->setsize(100);
        $horaIda = new TEntry('horaIda');
        $horaIda->setsize(60);
        $vooIda = new TEntry('vooIda');
        $vooIda->setsize(80);
       
        $chegada = new TDate('chegada');
        $chegada->setsize(100);
        $horaChegada = new TEntry('horaChegada');
        $horaChegada->setsize(60);
        $vooChegada = new TEntry('vooChegada');
        $vooChegada->setsize(80);
        
        $empresa = new TEntry('empresa');
        $empresa->setsize(140);
        $empresaChegada = new TEntry('empresaChegada');
        $empresaChegada->setsize(140);
        
        $destino = new TCombo('destino');
        $destino->setsize(150);
        $situacao = new TCombo('situacao');
        $situacao->setsize(120);
        $status = new TCombo('status');
        $status->setsize(200);
        $saidaBase = new TEntry('saidaBase');
        $saidaBase->setsize(60);
  
  
      
         //opcoes do tipo
        $items = array();
        $items['Gen Ex'] = 'General Exército';
        $items['Gen Div'] = 'General Divisão';
        $items['Gen Bda'] = 'Gen Brigada';
        $items['Cel'] = 'Cel';
        $items['CMG'] = 'Cap Mar e Guerra';
        $items['TC'] = 'Ten Cel';
        $items['CF'] = 'Cap Fragata';
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
       // $postograd->setLayout('horizontal');
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
        
        $pr =  array();
        $pr['1 Leave'] = '1 Leave';
        $pr['2 Leave'] = '2 Leave';
        $pr['3 Leave'] = '3 Leave';
        $pr['4 Leave'] = '4 Leave';
        $pr['5 Leave'] = '5 Leave';
        $periodo->addItems($pr);
        
        
        $sit = array();
        $sit['Aguardando Autorização'] = 'AGUARDANDO AUTORIZAÇÃO';
        $sit['Autorizado'] = 'AUTORIZADO';
        $sit['Não Autorizado'] = 'NÃO AUTORIZADO';
        $status->addItems($sit);
        
        $vj = array();
        $vj['Não Vai Viajar'] = 'Não Vai Viajar';
        $vj['Vai Viajar'] = 'Vai Viajar';
	$vj['Viajando'] = 'Viajando';
        $vj['Finalizado'] = 'Finalizado';
        $situacao->addItems($vj);
        
        $fn =  array();
        $fn['Comando'] = 'Comando';
        $fn['Tropa'] = 'Tropa';
        $funcao->addItems($fn);
        
        $dst =  array();
        $dst['Base'] = 'Base';
        $dst['Brasil'] = 'Brasil';
        $dst['Europa'] = 'Europa';
        $dst['EUA'] = 'EUA';
        $dst['Republica Dominicana'] = 'Republica Dominicana';
        $dst['Santo Domingo'] = 'Santo Domingo';
        $dst['Juan Dolio'] = 'Juan Dolio';
        $dst['Punta Cana'] = 'Punta Cana';
        $dst['Boca Chica'] = 'Boca Chica';
        $dst['Outro'] = 'Outro';
        $destino->addItems($dst);
        
        // define some properties for the form fields
        $id->setEditable(FALSE);
        $nome->setEditable(FALSE);
        
         $lbl_inicioLeave = new TLabel('Início Leave');
         $lbl_inicioLeave->setSize(120);
         $lbl_terminoLeave = new TLabel('Término Leave');
         $lbl_terminoLeave->setSize(120);
         $lbl_embarque = new TLabel('Data Embarque');
         $lbl_embarque->setSize(120);
         $lbl_chegada = new TLabel('Data Chegada');
         $lbl_chegada->setSize(120);
         $lbl_vooIda =  new TLabel('Nr Voo Ida');
         $lbl_vooIda->setSize(100);  
         $lbl_horaIda =  new TLabel('Hora Ida');
         $lbl_horaIda->setSize(120);
         $lbl_vooChegada =  new TLabel('Nr Voo Cheg.');
         $lbl_vooChegada->setSize(100);  
         $lbl_horaChegada =  new TLabel('Hora Chegada');
         $lbl_horaChegada->setSize(120);
         $lbl_empresa =  new TLabel('Empresa Ida');
         $lbl_empresa->setSize(100); 
         $lbl_empresaChegada =  new TLabel('Empresa Chegada');
         $lbl_empresaChegada->setSize(150);
         $lbl_situacao = new TLabel('Situação');
         $lbl_situacao->setsize(70);
         $lbl_destino = new TLabel('Destino');
         $lbl_destino->setsize(70);
         $lbl_status = new TLabel('Status');
         $lbl_status->setsize(70);
         $lbl_saidaBase = new TLabel('Hora Saída Base');
         $lbl_saidaBase->setsize(150);
         
        // add the form fields
        $this->form->addQuickField('ID', $id,  50);
        $this->form->addQuickFields('Posto/Grad',      array($postograd,     new TLabel('Guerra'), $guerra));
        $this->form->addQuickField('Nome',$nome,450);
        $this->form->addQuickFields('SU',      array($su,     new TLabel('Fração'), $subunidade));
        $this->form->addQuickFields('Função',      array($funcao,     new TLabel('Período'), $periodo));
       
        $this->form->addQuickFields($lbl_inicioLeave, array($inicioLeave,$lbl_terminoLeave,$terminoLeave));
        $this->form->addQuickFields($lbl_embarque, array($ida,$lbl_horaIda,$horaIda,$lbl_vooIda,$vooIda));
        $this->form->addQuickFields($lbl_chegada, array($chegada,$lbl_horaChegada,$horaChegada,$lbl_vooChegada,$vooChegada));
        $this->form->addQuickFields($lbl_empresa, array($empresa, $lbl_empresaChegada, $empresaChegada,$lbl_destino,$destino));
        $this->form->addQuickFields($lbl_situacao, array($situacao,$lbl_status,$status,$lbl_saidaBase,$saidaBase));

        
        // add the actions
        $this->form->addQuickAction(_t('Save'), new TAction(array($this, 'onSave')), 'ico_save.png');
        $this->form->addQuickAction(_t('New'), new TAction(array($this, 'onEdit')), 'ico_new.png');
        $this->form->addQuickAction(_t('Find'), new TAction(array('PesquisaLeave', 'onReload')), 'ico_back.png');
        
        // wrap the page content
        $vbox = new TVBox;
        $vbox->add(new TXMLBreadCrumb('menu.xml', 'PesquisaLeave'));
        $vbox->add($this->form);

        parent::add($vbox);
    }
    
    /**
     * method onSave
     * Executed whenever the user clicks at the save button
     */
    function onSave()
    {
        $object = parent::onSave();
    } 
}
?>
