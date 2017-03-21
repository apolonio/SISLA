<?php
/** 
 * Esse VooForm exibi dados da tabela system_voo
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class PartidaForm extends TStandardForm
{
    protected $form;
    
    function __construct()
    {
        parent::__construct();
        
        // creates the form
        $this->form = new TQuickForm('form_Partida');
        $this->form->class = 'tform'; // CSS class
        $this->form->style = 'width: 650px;';
        
        // defines the form title
        $this->form->setFormTitle('Partida');
        
        // define the database and the Active Record
        parent::setDatabase('fiscalizacao'); //banco
        parent::setActiveRecord('Partida'); //tabela
        
        // units
        $voo = array('1º' => '1º',
                     '2º' => '2º',
                     '3º' => '3º',
                     '4º' => '4º'
            );
       
       
        $voos = array('1º' => '1º',
                     '2º' => '2º',
                     '3º' => '3º',
                     '4º' => '4º',
                     '5º' => '5º',
                     '6º' => '6º',
                     '7º' => '7º'
            );

        
        
          //Caixa selecao Subunidade
        $unidade = array();
        $unidade['1ªCia Fuz'] = '1ª Cia Fuz';
        $unidade['2ªCia Fuz'] = '2ª Cia Fuz';
        $unidade['CCAp/Btl F Paz'] = 'CCAp/Btl F Paz';
        $unidade['EM/Btl F Paz'] = 'EM/Btl F Paz';
        $unidade['Esqd C Mec'] = 'Esqd C Mec';
        
        $pel = array();
        $pel['Cmt'] = 'Cmt';
        $pel['EM Esp'] = 'EM Esp';
        $pel['1ªCia Fuz'] = '1ª Cia Fuz';
        $pel['2ªCia Fuz'] = '2ª Cia Fuz';
        $pel['CCAp/Btl F Paz'] = 'CCAp/Btl F Paz';
        $pel['EM/Btl F Paz'] = 'EM/Btl F Paz';
        $pel['Esqd C Mec'] = 'Esqd C Mec';
        $pel['DOPAZ'] = 'DOPAZ';
        $pel['Esqd C Mec'] = 'Esqd C Mec';
        $pel['Sec Cmdo/CCAp'] = 'Sec Cmdo/CCAp';
        $pel['Pel Com/CCAp'] = 'Pel Com/CCAp';
        $pel['Pel Cmdo/CCAp'] = 'Pel Cmdo/CCAp';
        $pel['Pel Mnt/CCAp'] = 'Pel Mnt/CCAp';
        $pel['Pel Sup/CCAp'] = 'Pel Sup/CCAp';
        $pel['Pel Eng/CCAp'] = 'Pel Eng/CCAp';
        $pel['Pel PE/CCAp'] = 'Pel PE/CCAp';
        $pel['Pel Sau/CCAp'] = 'Pel Sau/CCAp';
        $pel['G1'] = 'G1';
        $pel['G2'] = 'G2';
        $pel['G3'] = 'G3';
        $pel['G4'] = 'G4';
        $pel['G6'] = 'G6';
        $pel['G9'] = 'G9';
        $pel['G10'] = 'G10';
        
        //Posto Graduação
        $items = array();
        $items['Gen Ex'] = 'General Exército';
        $items['Gen Div'] = 'General Divisão';
        $items['Gen Bda'] = 'Gen Brigada';
        $items['Cel'] = 'Cel';
        $items['CMG'] = 'Cap Mar e Guerra ';
        $items['Ten Cel'] = 'Ten Cel';
        $items['CF'] = 'Capitão Fragata';
        $items['Maj'] = 'Maj';
        $items['CC'] = 'Cap Corveta';
        $items['Cap'] = 'Cap';
        $items['Cap Ten'] = 'Cap Ten';
        $items['1ºTen'] = '1ºTen';
        $items['2ºTen'] = '2ºTen';
        $items['Asp. OF'] = 'Aspirante';
        $items['Sub Ten'] = 'Sub Ten';
        $items['1ºSgt'] = '1ºSgt';
        $items['2º Sgt'] = '2ºSgt';
        $items['3ºSgt'] = '3ºSgt';
        $items['Cb'] = 'Cb';
        $items['Sd'] = 'Sd';
        
        
        // Campos do Formulario
        $id = new TEntry('id');
        $pg = new TCombo('pg');
        $nome = new TEntry('nome');
        $guerra = new TEntry('guerra');
        $su = new TCombo('su');
        $subunidade = new TCombo('subunidade');
        $l4levas = new TCombo('l4levas');
        $l7levas = new TCombo('l7levas');
        
        $id->setEditable( FALSE );
        $pg->addItems($items);
        $su->addItems($unidade);
        $subunidade->addItems($pel);
        $l4levas->addItems( $voo );
        $l7levas->addItems( $voos );
        
        // Adicionando os Campos
        $this->form->addQuickField('ID', $id,  50);
        $this->form->addQuickField('Posto/Grad', $pg,  50);
        $this->form->addQuickField('SU', $su,  150);
       $this->form->addQuickField('SuUnidade', $subunidade,  150);
        $this->form->addQuickField('Nome', $nome,  300);
        $this->form->addQuickField('Guerra', $guerra,  150);
        $this->form->addQuickField('l4Levas', $l4levas,  100);
        $this->form->addQuickField('l7Levas', $l7levas,  100);
         
        // add the actions
        $this->form->addQuickAction(_t('Save'), new TAction(array($this, 'onSave')), 'ico_save.png');
        $this->form->addQuickAction(_t('New'), new TAction(array($this, 'onEdit')), 'ico_new.png');
        $this->form->addQuickAction(_t('Find'), new TAction(array('PesquisaPartida', 'onReload')), 'ico_back.png');

        $vbox = new TVBox;
        $vbox->add(new TXMLBreadCrumb('menu.xml', 'PesquisaPartida'));
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


