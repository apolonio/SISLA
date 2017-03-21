<?php

class MilitarForm extends Adianti\Control\TWindow
{
    private $form; // form

    function __construct()
    {
        parent::__construct();
        // creates the form
        $this->form = new TForm('form_militar');
        
        // creates a table
        $table_data    = new TTable;
        //$table_contact = new TTable;
        //$table_skill   = new TTable;
        $notebook = new TNotebook(800, 750);
        // add the notebook inside the form
        $this->form->add($notebook);
        $notebook->appendPage('Alteração dados Militar', $table_data);
      //  $notebook->appendPage('Contact (composition)', $table_contact);
       // $notebook->appendPage('Skill (aggregation)', $table_skill);
        
        // create the form fields
        $id = new TEntry('id');
        $postograd = new TCombo('postograd');
        $nome = new TEntry('nome');
        $guerra = new TEntry('guerra');
        $sex = new TCombo('sexo');
        $forca = new TCombo('forca');
        $su = new TCombo('su');
        $subunidade = new TCombo('pelotao');
        $identidade = new TEntry('identidade');
        $cpf = new TEntry('cpf');
        $preccp = new TEntry('preccp');
        $dataNascimento = new TDate('dataNascimento');
        $tipoPassaporteOficial = new TCombo('tipoPassaporteOficial');
        $passaporteOficial = new TEntry('passaporteOficial');
        $dataExpedicao = new TDate('dataExpedicao');
        $dataExpiracao = new TDate('dataExpiracao');
        
        $passaporteCivil = new TEntry('passaporteCivil');
        $dataExpiracaoCivil = new TDate('dataExpiracaoCivil');
        $numeroVisto = new TEntry('numeroVisto');
        $first = new TEntry('first');
        $middle = new TEntry('middle');
        $last = new TEntry('last');
        
        $f = array();
        $f['Exército'] = 'Exército';
        $f['Marinha'] = 'Marinha';
        $f['Aeronáutica'] = 'Aeronáutica';
        $forca->addItems($f);
        //$forca->setLayout('horizontal');
        
        $tipoP = array();
        $tipoP['PD'] = 'PD';
        $tipoP['PO'] = 'PO';
        $tipoPassaporteOficial->addItems($tipoP);
       // $tipoPassaporte->setLayout('horizontal');
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
       // $postograd->setLayout('horizontal');
        
        $unidade = array();
        $unidade['1ª Cia Fuz'] = '1ª Cia Fuz';
        $unidade['2ª Cia Fuz'] = '2ª Cia Fuz';
        $unidade['CCAp/Btl F Paz'] = 'CCAp/Btl F Paz';
        $unidade['EM/Btl F Paz'] = 'EM/Btl F Paz';
        $unidade['Esqd C Mec'] = 'Esqd C Mec';
      
        $su->addItems($unidade);
       // $su->setLayout('horizontal');
       
       
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
       // $pelotao->setLayout('horizontal');
        
        $sexo = array();
        $sexo['Masculino'] = 'Masculino';
        $sexo['Feminino'] = 'Feminino';
        $sex->addItems($sexo);
     //   $sex->setLayout('horizontal');
        
        // define some properties for the form fields
        $id->setEditable(FALSE);
        $postograd->setSize(160);
        $nome->setSize(280);
        $guerra->setSize(150);
        $sex->setSize(100);
        $tipoPassaporteOficial->setSize(60);
        $dataNascimento->setSize(120);
        $first->setSize(200);
        $middle->setSize(200);
        $last->setSize(200);
        // add a row for the field code
        $table_data->addRowSet(new TLabel('Id:'), $id);
        $table_data->addRowSet(new TLabel('Posto/Grad:'),   array($postograd, new TLabel('Nome:'), $nome));
        $table_data->addRowSet(new TLabel('Guerra:'),   array($guerra, new TLabel('Sexo:'), $sex));
        $table_data->addRowSet(new TLabel('SU:'),   array($su, new TLabel('Pelotão:'), $subunidade));
        $table_data->addRowSet(new TLabel('Data Nascimento'),   array($dataNascimento, new TLabel('Prec-CP:'), $preccp));
        $table_data->addRowSet(new TLabel('Identidade:'),   array($identidade, new TLabel('    CPF:'), $cpf));
        $table_data->addRowSet(new TLabel('TipoPass.:'),   array($tipoPassaporteOficial, new TLabel('NºPassaporte:'), $passaporteOficial));
        $table_data->addRowSet(new TLabel('Data Expedição.:'),   array($dataExpedicao, new TLabel('Data Expiração:'), $dataExpiracao));
        $table_data->addRowSet(new TLabel('NºPassaporte Civil.'),   array($passaporteCivil, new TLabel('Data Exp. Civil:'), $dataExpiracaoCivil));
        $table_data->addRowSet(new TLabel('NºVisto:'),$numeroVisto);
        $table_data->addRowSet(new TLabel('FIRST:'),   array($first, new TLabel('MIDLLE:'), $middle));
        $table_data->addRowSet(new TLabel('LAST:'),$last);


        
//        $row=$table_contact->addRow();
//        $cell=$row->addCell(new TLabel('<b>Contact</b>'));
//        $cell->valign = 'top';
        
        // add two fields inside the multifield in the second sheet
//        $contacts_list->setHeight(100);
//        $contacts_list->setClass('Contact'); // define the returning class
//        $contacts_list->addField('type',  'Contact Type: ',  new TEntry('type'), 200);
//        $contacts_list->addField('value', 'Contact Value: ', new TEntry('value'), 200);
//        $row=$table_contact->addRow();
//        $row->addCell($contacts_list);
        
        // create the radio button for the skills list
//        $skill_list = new TDBCheckGroup('skill_list', 'samples', 'Skill', 'id', 'name');
//        $table_skill->addRow()->addCell($lbl=new TLabel('Skills'));
//        $table_skill->addRow()->addCell($skill_list);
//        $lbl->setFontStyle('b');
        
        // create an action button
        $button1=new TButton('action1');
        $button1->setAction(new TAction(array($this, 'onSave')), 'Save');
        $button1->setImage('ico_save.png');
        
        // create an action button (go to list)
        $button2=new TButton('list');
        $button2->setAction(new TAction(array('PesquisaMilitar', 'onReload')), 'Go to Listing');
        $button2->setImage('ico_datagrid.gif');
        
        // define wich are the form fields
        $this->form->setFields(array($id, $postograd, $nome, $guerra, $button1, $button2));
        
        $subtable = new TTable;
        $row = $subtable->addRow();
        $row->addCell($button1);
        $row->addCell($button2);
        
        // wrap the page content
        $vbox = new TVBox;
        $vbox->add(new TXMLBreadCrumb('menu.xml', 'PesquisaMilitar'));
        $vbox->add($this->form);
        $vbox->add($subtable);
        
        // add the form inside the page
        parent::add($vbox);
    }
    
    /**
     * method onSave
     * Executed whenever the user clicks at the save button
     */
    function onSave()
    {
        try
        {
            // open a transaction with database 'samples'
            TTransaction::open('fiscalizacao');
            
            $this->form->validate();
            // read the form data and instantiates an Active Record
            $customer = $this->form->getData('Militar');
            
            // stores the object in the database
            $customer->store();
            $this->form->setData($customer);
            
            // shows the success message
            new TMessage('info', 'Registro Salvo');
            
            TTransaction::close(); // close the transaction
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', '<b>Error</b>: ' . $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }
    
    /**
     * method onEdit
     * Edit a record data
     */
    function onEdit($param)
    {
        try
        {
            if (isset($param['key']))
            {
                // open a transaction with database 'samples'
                TTransaction::open('fiscalizacao');
                
                // load the Active Record according to its ID
                $customer= new Militar($param['key']);
                
                // fill the form with the active record data
                $this->form->setData($customer);
                
                // close the transaction
                TTransaction::close();
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', '<b>Error</b>' . $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }
}
?>