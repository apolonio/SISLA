<?php
/** 
 * Esser Relatorio exibi dados da tabela system_militar
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class RelatorioMilitar extends TPage
{
    private $form; // form
 
    function __construct()
    {
        parent::__construct();
        
        ini_set( 'display_errors', 0 );
     
      
        // creates the form
        $this->form = new TForm('form_relatorio_militar');
        $this->form->class = 'tform'; // CSS class
        
        // creates a table
        $table = new TTable;
        //$table-> width = '100%';
        $table-> width = '650px';
        
        // add the table inside the form
        $this->form->add($table);

        // create the form fields
        $postograd     = new TCombo('postograd');
        $guerra         = new TEntry('guerra');
        $su         = new TCombo('su');
        $subunidade         = new TCombo('subunidade');
  
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
        
        // Tela de Saída     
        $output_type  = new TRadioGroup('output_type');
        $options = array('html' => 'HTML', 'pdf' => 'PDF', 'rtf' => 'RTF');
        $output_type->addItems($options);
        $output_type->setValue('pdf');
        $output_type->setLayout('horizontal');
        
        // define the sizes
        $guerra->setSize(200);
      //  $tipo_id->setSize(100);
      //  $tipo_name->setEditable(FALSE);
        
        // add a row for the field name
        $row  = $table->addRowSet(new TLabel('Relatórios Militar para Impressão'), '');
        $row->class = 'tformtitle'; // CSS class
        
        // add the fields into the table
        $table->addRowSet(new TLabel('P/G' . ': '), $postograd);
        $table->addRowSet(new TLabel('Guerra' . ': '), $guerra);
        $table->addRowSet(new TLabel('SU' . ': '), $su);
        $table->addRowSet(new TLabel('Pelotão/Cel' . ': '), $subunidade);
        $table->addRowSet(new TLabel('Tipo Saída' . ': '), $output_type);
        
        // create an action button (save)
        $save_button=new TButton('generate');
        $save_button->setAction(new TAction(array($this, 'onGenerate')), 'Generate');
        $save_button->setImage('ico_save.png');

        // add a row for the form action
        $row = $table->addRowSet($save_button, '');
        $row->class = 'tformaction';

        // define wich are the form fields
        //$this->form->setFields(array($name,$tipo_id,$tipo_name,$output_type,$save_button));
        $this->form->setFields(array($postograd,$guerra,$su,$subunidade,$output_type,$save_button));
        
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
            $repository = new TRepository('Militar');
            $criteria   = new TCriteria;
            if ($object->guerra)
            {
                $criteria->add(new TFilter('guerra', 'like', "%{$object->guerra}%"));
            }
            if ($object->postograd)
            {
                $criteria->add(new TFilter('postograd', '=', "{$object->postograd}"));
            }
       
            if ($object->su)
            {
                $criteria->add(new TFilter('su', '=', "{$object->su}"));
            }
            if ($object->subunidade)
            {
                $criteria->add(new TFilter('subunidade', '=', "{$object->subunidade}"));
            }
      
      
      
            
          
           
            $customers = $repository->load($criteria);
            $format  = $object->output_type;
            
            if ($customers)
            {                 //01-02-03-04-05-06-07-08-09-10-11
                $widths = array(20,20,40,90,90,80,80,70,70);
                
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
                    $tr->addStyle('header', 'Times', '14',  '', '#ff0000', '#FFF1B2');
                    $tr->addStyle('footer', 'Times', '10',  '', '#2B2B2B', '#B5FFB4');
                    
                    // add a header row
                    $tr->addRow();
                    $tr->addCell('Relatório Militar - BRABAT 24', 'center', 'header', 40);
                   
                    // add titles row
                    $tr->addRow();
                    $tr->addCell('Or', 'left', 'title');
                    $tr->addCell('Nr', 'left', 'title');
                    $tr->addCell('P/G', 'left', 'title');
                    $tr->addCell('Guerra', 'left', 'title');
                    $tr->addCell('SU', 'left', 'title');
                    $tr->addCell('Subunidade', 'left', 'title');
                    $tr->addCell('NºPassaporte', 'left', 'title');
                    $tr->addCell('NºVisto', 'left', 'title');
                    $tr->addCell('PREC-CP', 'left', 'title');
             

                    // controls the background filling
                    $colour= FALSE;
                    $i=0;
                    // data rows
                    foreach ($customers as $customer)
                    {
                        $i++;
                        $style = $colour ? 'datap' : 'datai';
                        $tr->addRow();
                        $tr->addCell($i, 'left', $style);
                        $tr->addCell($customer->id, 'left', $style);
                        $tr->addCell($customer->postograd, 'left', $style);
                        $tr->addCell($customer->guerra, 'left', $style);
                        $tr->addCell($customer->su, 'left', $style);
                        $tr->addCell($customer->subunidade, 'left', $style);
                        $tr->addCell($customer->passaporteOficial, 'left', $style);
                        $tr->addCell($customer->numeroVisto, 'left', $style);
                    //    $tr->addCell($customer->identidade, 'left', $style);
                   //     $tr->addCell($customer->cpf, 'left', $style);
                        $tr->addCell($customer->preccp, 'left', $style);

                        $colour = !$colour;
                    }
                    
                    // footer row
                    $tr->addRow();
                                          
                    
                   // $tr->addCell('Total de Registros: '.$contagemccap, 'center', 'footer',24);
                    $tr->addCell(date('Y-m-d h:i:s'), 'center', 'footer', 24);
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
                    new TMessage('info', 'Relatório Gerado. Habilite o popup no navegador');
                }
            }
            else
            {
                new TMessage('error', 'Registro não encontrado');
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