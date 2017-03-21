<?php

class PessoalForm extends TStandardForm
{
    protected $form;
    
    function __construct()
    {
        parent::__construct();
        // creates the form
        $this->form = new TForm('form_Leave');
        $this->form = new TQuickForm('form_Militar');
        $this->form->class = 'tform'; // CSS class
        $this->form->style = 'width: 700px;';
   
        // defines the form title
        $this->form->setFormTitle('Militar');
        
        // define the database and the Active Record
        parent::setDatabase('fiscalizacao'); //banco
        parent::setActiveRecord('Militar'); //tabela
        
    
        
        // create the form fields
        $id                              = new TEntry('id');
        $postograd                       = new TCombo('postograd');
        $guerra                          = new TEntry('guerra');
        $su                              = new TCombo('su');
        $subunidade                      = new TCombo('subunidade');
        $dataNascimento = new TDate('dataNascimento');
        $identidade = new TEntry('identidade');
        $cpf = new TEntry('cpf');
        $preccp = new TEntry('preccp');
        $passaporteOficial = new TEntry('passaporteOficial');
        $numeroVisto = new TEntry('numeroVisto');

        
       
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

        $id->setEditable( FALSE );

        // add the form fields
        $this->form->addQuickField('ID', $id,  50);
        $this->form->addQuickField('P/G', $postograd,  80);
        $this->form->addQuickField('Guerra', $guerra,  150);
        $this->form->addQuickField('SU', $su,  200);
        $this->form->addQuickField('Subunidade', $subunidade,  200);
        $this->form->addQuickField('Identidade', $identidade,  120);
        $this->form->addQuickField('Prec-CP', $preccp,  120);
        $this->form->addQuickField('CPF', $cpf,  120);
        $this->form->addQuickField('DataNasc.', $dataNascimento,  120);
        $this->form->addQuickField('NºPassaporte.', $passaporteOficial,  120);
        $this->form->addQuickField('NºVisto.', $numeroVisto,  120);
   
        // add the actions
        $this->form->addQuickAction(_t('Save'), new TAction(array($this, 'onSave')), 'ico_save.png');
        $this->form->addQuickAction(_t('New'), new TAction(array($this, 'onEdit')), 'ico_new.png');
        $this->form->addQuickAction(_t('Find'), new TAction(array('PesquisaMilitar', 'onReload')), 'ico_back.png');

        $vbox = new TVBox;
        $vbox->add(new TXMLBreadCrumb('menu.xml', 'PesquisaMilitar'));
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
        
        // if the object has been saved
//        if ($object instanceof Voo)
//        {
//         //   $source_file   = 'tmp/'.$object->photo_path;
//         //   $target_file   = 'images/' . $object->photo_path;
//         //   $finfo = new finfo(FILEINFO_MIME_TYPE);
//            
//            // if the user uploaded a source file
//            if (file_exists($source_file) AND $finfo->file($source_file) == 'image/png')
//            {
//                // move to the target directory
//              //  rename($source_file, $target_file);
//                
//                try
//                {
//                    TTransaction::open($this->database);
//                    // update the photo_path
//                 //   $object->photo_path = 'images/'.$object->photo_path;
//                    $object->store();
//                    TTransaction::close();
//                }
//                catch (Exception $e) // in case of exception
//                {
//                    new TMessage('error', '<b>Error</b> ' . $e->getMessage());
//                    TTransaction::rollback();
//                }
//            }
//        }
    }
  
}
?>

