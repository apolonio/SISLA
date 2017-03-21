<?php
/** 
 * Esser Relatorio exibi dados da tabela system_militar e permiti exportar arquivo csv(excel)
 * class CustomerDataGridView extends TPage
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class RelatorioVoo extends TPage
{
    private $form; // form
    
    /**
     * Class constructor
     * Creates the page and the registration form
     */
    function __construct()
    {
        parent::__construct();
        
        ini_set( 'display_errors', 0 );
        
        // creates the form
        $this->form = new TForm('form_Customer_Report');
        $this->form->class = 'tform'; // CSS class
        
        // creates a table
        $table = new TTable;
       // $table-> width = '100%';
        $table-> width = '600px';
        
        // add the table inside the form
        $this->form->add($table);

        // create the form fields
        $name         = new TEntry('guerra');
        $su         = new TCombo('su');
        $subunidade         = new TCombo('subunidade');
        $l4levas=new Adianti\Widget\Form\TCombo('l4levas');
        $l7levas=new Adianti\Widget\Form\TCombo('l7levas');
       // $pelotao=new Adianti\Widget\Form\TCombo('pelotao');
        
             //caixas de selecao
        $voo = array('1º' => '1º',
                     '2º' => '2º',
                     '3º' => '3º',
                     '4º' => '4º'
            );
        
        $l4levas->addItems($voo);
        
          $voos = array('1º' => '1º',
                     '2º' => '2º',
                     '3º' => '3º',
                     '4º' => '4º',
                     '5º' => '5º',
                     '6º' => '6º',
                     '7º' => '7º'
            );
        
        $l7levas->addItems($voos);
        
             //Caixa selecao Subunidade
        $unidade = array();
        $unidade['1ªCia Fuz'] = '1ª Cia Fuz';
        $unidade['2ªCia Fuz'] = '2ª Cia Fuz';
        $unidade['CCAp/Btl F Paz'] = 'CCAp/Btl F Paz';
        $unidade['EM/Btl F Paz'] = 'EM/Btl F Paz';
        $unidade['Esqd C Mec'] = 'Esqd C Mec';
        $su->addItems($unidade);
        
        
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
        $subunidade->addItems($pel);
        
        $output_type  = new TRadioGroup('output_type');
        $options = array('html' => 'HTML', 'pdf' => 'PDF', 'rtf' => 'RTF');
        $output_type->addItems($options);
        $output_type->setValue('pdf');
        $output_type->setLayout('horizontal');
        
        // define the sizes
        $name->setSize(200);
      //  $tipo_id->setSize(100);
      //  $tipo_name->setEditable(FALSE);
        
        // add a row for the field name
        $row  = $table->addRowSet(new TLabel('Relatório de VOO para Impressão'), '');
        $row->class = 'tformtitle'; // CSS class
        
        // add the fields into the table
        $table->addRowSet(new TLabel('Nome Guerra' . ': '), $name);
        $table->addRowSet(new TLabel('SU' . ': '), $su);
        $table->addRowSet(new TLabel('SubUnidade' . ': '), $subunidade);
        $table->addRowSet(new TLabel('L4Levas' . ': '), $l4levas);
        $table->addRowSet(new TLabel('L7Levas' . ': '), $l7levas);
      
    //    $table->addRowSet(new TLabel('Tipo' . ': '), array($tipo_id,$tipo_name));
        $table->addRowSet(new TLabel('Tipo Saída' . ': '), $output_type);
        
        // create an action button (save)
        $save_button=new TButton('generate');
        $save_button->setAction(new TAction(array($this, 'onGenerate')), 'Generate');
        $save_button->setImage('ico_save.png');

        // add a row for the form action
        $row = $table->addRowSet($save_button, '');
        $row->class = 'tformaction';

        // Define os campos do formulario usados na pesquisa
        //$this->form->setFields(array($name,$tipo_id,$tipo_name,$output_type,$save_button));
        $this->form->setFields(array($name,$su,$subunidade,$l4levas,$l7levas,$output_type,$save_button));
        
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->form);

        parent::add($vbox);
    }

    /**
     * method onGenerate()
     * Executed whenever the user clicks at the generate button
     */
    function onGenerate()
    {
        try
        {
            // open a transaction with database 'samples'
            TTransaction::open('fiscalizacao');
            
            // get the form data into an active record Customer
            $object = $this->form->getData();
            
           // var_dump($object);
            $repository = new TRepository('Partida');
            $criteria   = new TCriteria;
            if ($object->guerra)
            {
                $criteria->add(new TFilter('guerra', 'like', "%{$object->guerra}%"));
            }
            if ($object->su)
            {
                $criteria->add(new TFilter('su', 'like', "%{$object->su}%"));
            }
            if ($object->subunidade)
            {
                $criteria->add(new TFilter('subunidade', 'like', "%{$object->subunidade}%"));
            }
            if ($object->l4levas)
            {
                $criteria->add(new TFilter('l4levas', 'like', "%{$object->l4levas}%"));
            }
            if ($object->l7levas)
            {
                $criteria->add(new TFilter('l7levas', 'like', "%{$object->l7levas}%"));
            }
            
          
           
            $customers = $repository->load($criteria);
            $format  = $object->output_type;
            
            if ($customers)
            {
                $widths = array(20,20,40, 250, 100, 80, 80,50,50,80);
                
                switch ($format)
                {
                    case 'html':
                        $tr = new TTableWriterHTML($widths);
                        break;
                    case 'pdf':
                        //alterei o parametro da classe para L paisagem
                        $tr = new TTableWriterPDF($widths);
                        break;
                    case 'rtf':
                        if (!class_exists('PHPRtfLite_Autoloader'))
                        {
                            PHPRtfLite::registerAutoloader();
                        }
                        $tr = new TTableWriterRTF($widths);
                        break;
                }
                
                if (!empty($tr))
                {
                    // create the document styles
                    $tr->addStyle('title', 'Arial',  '14', 'I', '#d3d3d3', '#407B49');
                    $tr->addStyle('datap', 'Arial',  '10',  '', '#000000', '#869FBB');
                    $tr->addStyle('datai', 'Arial',  '10',  '', '#000000', '#ffffff');
                    $tr->addStyle('header', 'Times', '10',  '', '#ff0000', '#FFF1B2');
                    $tr->addStyle('footer', 'Times', '10',  '', '#2B2B2B', '#B5FFB4');
                    
                    // add a header row
                    $tr->addRow();
                    $tr->addCell('Relatório Voo', 'center', 'header', 40);
                    
                    // add titles row
                    $tr->addRow();
                    $tr->addCell('Or', 'left', 'title');
                    $tr->addCell('Nr', 'left', 'title');
                    $tr->addCell('Posto/Grad', 'left', 'title');
                    $tr->addCell('Nome', 'left', 'title');
                    $tr->addCell('Guerra', 'left', 'title');
                    $tr->addCell('SU', 'left', 'title');
                    $tr->addCell('Subunidade', 'left', 'title');
                    $tr->addCell('L4', 'left', 'title');
                    $tr->addCell('L7', 'left', 'title');
                    $tr->addCell('Passaporte', 'left', 'title');
                    // controls the background filling
                    $colour= FALSE;
                    
                    // data rows
                    $n=0;
                    foreach ($customers as $customer)
                    {
                        $n=$n+1;
                        $style = $colour ? 'datap' : 'datai';
                        $tr->addRow();
                        $tr->addCell($customer->id, 'left', $style);
                      //  $tr->addCell($customer->id_pessoa, 'left', $style);
                    
                        $tr->addCell($n, 'left', $style);
                        $tr->addCell($customer->pg, 'left', $style);
                        $tr->addCell($customer->nome, 'left', $style);
                        $tr->addCell($customer->guerra, 'left', $style);
                        $tr->addCell($customer->su, 'left', $style);
                        $tr->addCell($customer->subunidade, 'left', $style);
                        $tr->addCell($customer->l4levas, 'left', $style);
                        $tr->addCell($customer->l7levas, 'left', $style);
                        $tr->addCell($customer->passaporte, 'left', $style);
                        $colour = !$colour;
                    }
                    
                    // footer row
                    $tr->addRow();
                    $tr->addCell(date('Y-m-d h:i:s'), 'center', 'footer', 15);
                    // stores the file
                    if (!file_exists("app/output/tabular.{$format}") OR is_writable("app/output/tabular.{$format}"))
                    {
                        $tr->save("app/output/tabular.{$format}");
                    }
                    else
                    {
                        throw new Exception(_t('Permission denied') . ': ' . "app/output/tabular.{$format}");
                    }
                    
                    parent::openFile("app/output/tabular.{$format}");
                    
                    // shows the success message
                    new TMessage('info', 'Report generated. Please, enable popups in the browser (just in the web).');
                }
            }
            else
            {
                new TMessage('error', 'Registros não encontrados!');
            }
    
            // fill the form with the active record data
            $this->form->setData($object);
            
            // close the transaction
            TTransaction::close();
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            
            // undo all pending operations
            TTransaction::rollback();
        }
    }
}
?>
