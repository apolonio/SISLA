<?php

class ComitivaForm extends TStandardForm
{
    protected $form; // form

    function __construct()
    {
        parent::__construct();
        // creates the form
        $this->form = new TForm('form_Comitiva');
        $this->form = new TQuickForm('form_Comitiva');
        $this->form->class = 'tform'; // CSS class
        $this->form->style = 'width: 650px;';
        
        // defines the form title
        $this->form->setFormTitle('Comitiva');
        
        // define the database and the Active Record
        parent::setDatabase('fiscalizacao'); //banco
        parent::setActiveRecord('Comitiva'); //tabela
        
        // create the form fields
        $idChefeVtr    = new TCombo('idChefeVtr');
        $idViatura = new TCombo('idViatura');
        $nome = new TEntry('nome');
        $comitiva = new TEntry('tipoComitiva');
        
        $dataChegada = new TDate('dataChegada');
        $horaChegada = new TEntry('horaChegada');
        $vooChegada = new TEntry('vooChegada');
       
        $dataRegresso = new TDate('dataRegresso');
        $horaRegresso = new TEntry('horaRegresso');
        $vooRegresso = new TEntry('vooRegresso');
        
        $efetivo = new TEntry('efetivo');
        $obs = new TText('obs');
  
      
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
        
  
        // add the form fields
        
        $this->form->addQuickField('Chefe Vtr', $idChefeVtr,  300);
        $this->form->addQuickField('Viatura', $idViatura,  200);
        $this->form->addQuickField('Nome', $nome,  200);
        $this->form->addQuickFields('Comitiva',array($comitiva, new TLabel('Efetivo'), $efetivo));
        $this->form->addQuickFields('Data Chegada',array($dataChegada, new TLabel('H.Chegada'), $horaChegada));
        $this->form->addQuickFields('Data Regresso',array($dataRegresso, new TLabel('H.Regresso'), $horaRegresso));
        $this->form->addQuickFields('Voo Chegada',array($vooChegada, new TLabel('Voo Regresso'), $vooRegresso));
        $this->form->addQuickField('OBS', $obs,  300);

        // add the actions
        $this->form->addQuickAction(_t('Save'), new TAction(array($this, 'onSave')), 'ico_save.png');
        $this->form->addQuickAction(_t('New'), new TAction(array($this, 'onEdit')), 'ico_new.png');
        $this->form->addQuickAction(_t('Find'), new TAction(array('PesquisaComitiva', 'onReload')), 'ico_back.png');
        
        // wrap the page content
        $vbox = new TVBox;
        $vbox->add(new TXMLBreadCrumb('menu.xml', 'PesquisaComitiva'));
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
