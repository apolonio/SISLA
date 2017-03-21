<?php

class MeuLeaveForm extends TStandardForm
{
    protected $form; // form

    function __construct()
    {
        parent::__construct();
        // creates the form
        $this->form = new TForm('form_Leave');
        $this->form = new TQuickForm('form_Leave');
        $this->form->class = 'tform'; // CSS class
        $this->form->style = 'width: 650px;';
        
        // defines the form title
        $this->form->setFormTitle('Viajem');
        
        // define the database and the Active Record
        parent::setDatabase('fiscalizacao'); //banco
        parent::setActiveRecord('Viajem'); //tabela
        
        // create the form fields
        $id = new TEntry('id');
        $postograd = new TCombo('postograd');
        $nome    = new TDBSeekButton('nome', 'fiscalizacao', $this->form->getName(), 'Militar', 'nome', 'nome', 'nome');
        $guerra = new TEntry('guerra');

        $ida = new TDate('ida');
        $horaIda = new TEntry('horaIda');
        $vooIda = new TEntry('vooIda');

        $saidaBase = new TEntry('saidaBase');

        $chegada = new TDate('chegada');
        $horaChegada = new \Adianti\Widget\Form\TEntry('horaChegada');
        $vooChegada = new \Adianti\Widget\Form\TEntry('vooChegada');
        $periodo = new Adianti\Widget\Form\TCombo('periodo');
        $empresa = new Adianti\Widget\Form\TEntry('empresa');
        $destino = new Adianti\Widget\Form\TCombo('destino');
        $situacao = new Adianti\Widget\Form\TCombo('situacao');
      
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

	$dst = array();
	$dst['Base']='Base';
	$dst['Brasil']='Brasil';
	$dst['Europa']='Europa';
	$dst['EUA']='EUA';
	$dst['Republica Dominicana']='Republica Dominicana';
	$dst['Punta Cana']='Punta Cana';
	$dst['Juan Dolio']='Juan Dolio';
	$dst['Boca Chica']='Boca Chica';
	$dst['Santo Domingo']='Santo Domingo';
	$dst['Outro']='Outro';
	$destino->addItems($dst);

        // Define as situacoes 
        $sit = array();
	$sit['Não Vai Viajar']='Não Vai Viajar';
	$sit['Vai Viajar']='Vai Viajar';
	$sit['Viajando']='Viajando';
	$sit['Finalizado']='Finalizado';
	$situacao->addItems($sit);
	
        $pr =  array();
        $pr['1 Leave'] = '1 Leave';
        $pr['2 Leave'] = '2 Leave';
        $pr['3 Leave'] = '3 Leave';
        $pr['4 Leave'] = '4 Leave';
        $pr['5 Leave'] = '5 Leave';
        $periodo->addItems($pr);

        // define some properties for the form fields
        $id->setEditable(FALSE);
        $nome->setEditable(FALSE);
        $ida->setEditable(FALSE);
        $chegada->setEditable(FALSE);
  
        // add the form fields
        $this->form->addQuickField('ID', $id,  50);
        $this->form->addQuickField('P/G', $postograd,  150);
        $this->form->addQuickField('Nome', $nome,  350);
        $this->form->addQuickField('Guerra', $guerra,  150);
        $this->form->addQuickField('Ida', $ida,  100);
        $this->form->addQuickField('Nr Voo Ida', $vooIda,  100);
        $this->form->addQuickField('Hora Ida', $horaIda,  100);
        $this->form->addQuickField('Chegada', $chegada,  100);
        $this->form->addQuickField('Nr Voo Chegada', $vooChegada,  100);
        $this->form->addQuickField('H.Chegada', $horaChegada,  100);
        $this->form->addQuickField('Leave', $periodo,  250);
        $this->form->addQuickField('Empresa', $empresa,  250);
        $this->form->addQuickField('Destino', $destino,  250);
        $this->form->addQuickField('Situação', $situacao,  250);

        
        $this->form->addQuickAction(_t('Save'), new TAction(array($this, 'onSave')), 'ico_save.png');
      
        $this->form->addQuickAction(_t('New'), new TAction(array($this, 'onEdit')), 'ico_new.png');
        
        
        $this->form->addQuickAction(_t('Find'), new TAction(array('Leaves', 'onReload')), 'ico_back.png');
        
        // wrap the page content
        $vbox = new TVBox;
        $vbox->add(new TXMLBreadCrumb('menu.xml', 'Leaves'));
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
