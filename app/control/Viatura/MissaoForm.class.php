<?php

class MissaoForm extends TStandardForm
{
    protected $form; // form

    function __construct()
    {
        parent::__construct();
        // creates the form
        $this->form = new TForm('form_Leave');
        $this->form = new TQuickForm('form_Leave');
        $this->form->class = 'tform'; 
        $this->form->style = 'width: 650px;';
        
        // defines the form title
        $this->form->setFormTitle('Viajem');
        
        // define the database and the Active Record
        parent::setDatabase('fiscalizacao'); 
        parent::setActiveRecord('Viatura'); 
        
        // create the form fields
        $id = new TEntry('id');
        $idMotorista    = new TEntry('idMotorista');
        $idChefeVtr    = new TCombo('idChefeVtr');
        
        $idViatura = new TCombo('idViatura');
       // $efetivo = new TEntry('efetivo');
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
        $dest['OUTROS'] = 'OUTROS';
        $destino->addItems($dest);
       
        $mil = array();
        $mil['TEN INOUE'] = 'TEN INOUE';
        $mil['SGT VERISSIMO'] = 'SGT VERISSIMO';
        $mil['SGT SANTIAGO'] = 'SGT SANTIAGO';
        $idChefeVtr->addItems($mil);
        
        
        // define some properties for the form fields
        $id->setEditable(FALSE);
       // $idChefeVtr->setEditable(FALSE);
  
        // add the form fields
        $this->form->addQuickField('ID', $id,  50);
        $this->form->addQuickField('Chefe Vtr', $idChefeVtr,  300);
        $this->form->addQuickField('Motorista', $idMotorista,  300);
        $this->form->addQuickField('Viatura', $idViatura,  200);
        $this->form->addQuickField('Ida', $ida,150);
        $this->form->addQuickFields('H.Ida',array($horaIda, new TLabel('H.Chegada'), $horaChegada));
        $this->form->addQuickFields('Hodo.Ida',array($hodoIda, new TLabel('Hodo.Chegada'), $hodoChegada));
        $this->form->addQuickFields('Destino',array($destino, new TLabel('Missão'), $alteracao));
     

        // add the actions
        $this->form->addQuickAction(_t('Save'), new TAction(array($this, 'onSave')), 'ico_save.png');
        $this->form->addQuickAction(_t('New'), new TAction(array($this, 'onEdit')), 'ico_new.png');
        $this->form->addQuickAction(_t('Find'), new TAction(array('PesquisaMissoesViatura', 'onReload')), 'ico_back.png');
        
        // wrap the page content
        $vbox = new TVBox;
        $vbox->add(new TXMLBreadCrumb('menu.xml', 'PesquisaMissoesViatura'));
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
