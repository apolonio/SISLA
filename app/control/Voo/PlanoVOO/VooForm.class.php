<?php
/** 
 * Esse VooForm exibi dados da tabela system_voo
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class VooForm extends TStandardForm
{
    protected $form;
    
    function __construct()
    {
        parent::__construct();
        
        // creates the form
        $this->form = new TQuickForm('form_Product');
        $this->form->class = 'tform'; // CSS class
        $this->form->style = 'width: 650px;';
        
        // defines the form title
        $this->form->setFormTitle('Voo');
        
        // define the database and the Active Record
        parent::setDatabase('fiscalizacao'); //banco
        parent::setActiveRecord('Voo'); //tabela
        
        // units
        $voo = array('1º VOO' => '1º VOO', '2º VOO' => '2º VOO','3º VOO' => '3º VOO', '4º VOO' => '4º VOO');
        
        
         //Caixa selecao Subunidade
        $unidade = array();
        $unidade['1ªCia Fuz F Paz'] = '1ªCia Fuz F Paz';
        $unidade['2ªCia Fuz F Paz'] = '2ªCia Fuz F Paz';
        $unidade['CCAp'] = 'CCAp';
        $unidade['CCAp/EM'] = 'CCAp/EM';
        $unidade['DOPaz'] = 'DOPaz';
        $unidade['DOAI'] = 'DOAI';
        $unidade['EM Geral'] = 'EM Geral';
        $unidade['EM Especial'] = 'EM Especial';
        $unidade['FT Esqd Fuz F Paz'] = 'FT Esqd Fuz F Paz';
     
        
        
        //Caixa selecao do pelotao
        $pel = array();
        $pel['Comando'] = 'Comando';
        $pel['PelCom'] = 'PelCom';
        $pel['PelCmdo'] = 'PelCmdo';
        $pel['PelManutenção'] = 'PelManutenção';
        $pel['PelSuprimento'] = 'PelSuprimento';
        $pel['PelEngenharia'] = 'PelEngenharia';
        $pel['PelPE'] = 'PelPE';
        $pel['SecSaúde'] = 'SecSaúde';
        $pel['SecCmdo'] = 'SecCmdo';
        $pel['G1'] = 'G1';
        $pel['G2'] = 'G2';
        $pel['G3'] = 'G3';
        $pel['G4'] = 'G4';
        $pel['G5'] = 'G5';
        $pel['G6'] = 'G6';
        $pel['G7'] = 'G7';
        $pel['G8'] = 'G8';
        $pel['G9'] = 'G9';
        $pel['G10'] = 'G10';
      
        
        
        // create the form fi  $pelotao->addItems($pel);elds
        $id = new TEntry('id');
        $postograd = new TCombo('postograd');
        $nome = new TEntry('nome');
        $guerra = new TEntry('guerra');
        $su = new TCombo('su');
        $pelotao = new TCombo('pelotao');
        $tipoVoo = new TCombo('tipoVoo');
        $ida = new TDate('ida');
        $horaIda = new TEntry('horaIda');
         
        
        
        $id->setEditable( FALSE );
        //$nome->setEditable( FALSE );
        //$guerra->setEditable( FALSE );
        $su->addItems($unidade);
        $pelotao->addItems($pel);
        $tipoVoo->addItems( $voo );

        // add the form fields
        $this->form->addQuickField('ID', $id,  50);
        $this->form->addQuickField('SU', $su,  150);
        $this->form->addQuickField('Pelotão', $pelotao,  150);
        $this->form->addQuickField('Nome', $nome,  300);
        $this->form->addQuickField('Guerra', $guerra,  150);
        $this->form->addQuickField('Data Ida', $ida,  100);
        $this->form->addQuickField('Hora Ida', $horaIda,  50);
        $this->form->addQuickField('Tipo Voo', $tipoVoo,  100);

        // add the actions
        $this->form->addQuickAction(_t('Save'), new TAction(array($this, 'onSave')), 'ico_save.png');
        $this->form->addQuickAction(_t('New'), new TAction(array($this, 'onEdit')), 'ico_new.png');
        $this->form->addQuickAction(_t('Find'), new TAction(array('PesquisaVoo', 'onReload')), 'ico_back.png');

        $vbox = new TVBox;
        $vbox->add(new TXMLBreadCrumb('menu.xml', 'PesquisaVoo'));
        $vbox->add($this->form);

        parent::add($vbox);
    }
    
    /**
     * Overloaded method onSave()
     * Executed whenever the user clicks at the save button
     */
    public function onSave()
    {
        // first, use the default onSave()
        $object = parent::onSave();
        
    }
  
}
?>

