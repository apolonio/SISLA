<?php
/** 
 * Esser Relatorio exibi dados da tabela system_militar
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class RelatorioViatura extends TPage
{
    private $form; // form

    function __construct()
    {
        parent::__construct();
        
        ini_set( 'display_errors', 0 );
        
        $this->form = new TForm('form_Customer_Report');
        $this->form->class = 'tform'; // CSS class
        $table = new TTable;
        $table-> width = '650px';
        $this->form->add($table);

        $idChefeVtr         = new TEntry('idChefeVtr');
        $destino      = new TCombo('destino');
        $idViatura      = new TCombo('idViatura');
       
        $dest = array();
        $dest['AEROPORTO'] = 'AEROPORTO';
        $dest['RODOVIARIA'] = 'RODOVIARIA';
        $dest['OUTROS'] = 'OUTROS';
        $destino->addItems($dest);
        
        $vtr = array();
        $vtr['VAN-UN25269'] = 'VAN-UN25269';
        $vtr['VAN-UN25264'] = 'VAN-UN25264';
        $vtr['MARRUA-UN24772'] = 'MARRUA-UN24772';
        $idViatura->addItems($vtr);
        
        // Tela de Saída     
        $output_type  = new TRadioGroup('output_type');
        $options = array('html' => 'HTML', 'pdf' => 'PDF', 'rtf' => 'RTF');
        $output_type->addItems($options);
        $output_type->setValue('pdf');
        $output_type->setLayout('horizontal');
        
        // define the sizes
        $idChefeVtr->setSize(200);
        
        // add a row for the field name
        $row  = $table->addRowSet(new TLabel('Relatórios para Impressão'), '');
        $row->class = 'tformtitle'; // CSS class
        
        // add the fields into the table
        $table->addRowSet(new TLabel('Guerra' . ': '), $idChefeVtr);
        $table->addRowSet(new TLabel('Viatura' . ': '), $idViatura);
        $table->addRowSet(new TLabel('Destino' . ': '), $destino);
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
        $this->form->setFields(array($idChefeVtr,$idViatura,$destino,$output_type,$save_button));
        
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
            $repository = new TRepository('Viatura');

            $criteria   = new TCriteria;
            if ($object->idChefeVtr)
            {
                $criteria->add(new TFilter('idChefeVtr', 'like', "%{$object->idChefeVtr}%"));
            }
           
            if ($object->idViatura)
            {
                $criteria->add(new TFilter('idViatura', '=', "{$object->idViatura}"));
            }

            if ($object->destino)
            {
                $criteria->add(new TFilter('destino', '=', "{$object->destino}"));
            }
        
            $order = isset($param['order']) ? $param['order'] : 'ida';          
            $criteria ->setProperty('order', $order);   

            $customers = $repository->load($criteria);
            $format  = $object->output_type;
            
            if ($customers)
            {                 //01-02--04-05-06-07-08
                $widths = array(20,80,50,30,50,50,50,70,140);
                
                switch ($format)
                {
                    case 'html':
                        $tr = new TTableWriterHTML($widths,'L');
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
                    $tr->addStyle('title', 'Arial',  '10', '', '#d3d3d3', '#407B49');
                    $tr->addStyle('datap', 'Arial',  '6',  '', '#000000', '#869FBB');
                    $tr->addStyle('datai', 'Arial',  '6',  '', '#000000', '#ffffff');
                    $tr->addStyle('header', 'Times', '12',  '', '#000000', '#dddddd');
                    $tr->addStyle('footer', 'Times', '10',  '', '#2B2B2B', '#dddddd');
                    
                    // add a header row
                    $tr->addRow();
                    $tr->addCell('Relatório VTR G1 - BRABAT', 'center', 'header', 40);
                    
                    // add titles row
                    $tr->addRow();
                    $tr->addCell('Nr', 'center', 'title');
                    $tr->addCell('Chefe', 'center', 'title');
                    $tr->addCell('Data', 'center', 'title');
                    $tr->addCell('Efet.', 'center', 'title');
                    $tr->addCell('Viatura', 'center', 'title');
                    $tr->addCell('Hora Saída', 'center', 'title');
                    $tr->addCell('Hora Retorno', 'center', 'title');
                    $tr->addCell('Destino', 'center', 'title');
                    $tr->addCell('Observação', 'center', 'title');

                    // controls the background filling
                    $colour= FALSE;
                    $i =0;
                    // data rows
                    foreach ($customers as $customer)
                    {
                      $i++;
                      //  $style = $colour ? 'datap' : 'datai';
                        $style = 'datai';
                        $tr->addRow();
                        $tr->addCell($i, 'center', $style);
                        $tr->addCell($customer->idChefeVtr, 'center', $style);
                         $tr->addCell($customer->ida, 'center', $style);
                         $tr->addCell($customer->efetivo, 'center', $style);
                         $tr->addCell($customer->idViatura, 'center', $style);
                         $tr->addCell($customer->horaIda, 'center', $style);
                         $tr->addCell($customer->horaChegada, 'center', $style);
                         $tr->addCell($customer->destino, 'center', $style);
                         $tr->addCell($customer->alteracao, 'center', $style);

                        $colour = !$colour;
                    }
                    
                    $tr->addRow();
                    $tr->addCell(date('Y-m-d h:i:s'), 'center', 'footer', 12);
                    if (!file_exists("app/output/tabular.{$format}") OR is_writable("app/output/tabular.{$format}"))
                    {
                        $tr->save("app/output/tabular.{$format}");
                    }
                    else
                    {
                        throw new Exception(_t('Permission denied') . ': ' . "app/output/tabular.{$format}");
                    }
                    
                    parent::openFile("app/output/tabular.{$format}");
                    
                    new TMessage('info', 'Relatório Viatura gerado. Habilite o popup no seu navegador.');
                }
            }
            else
            {
                new TMessage('error', 'Registro não encontrado');
            }
    
            $this->form->setData($object);
            
            TTransaction::close();
        }
        catch (Exception $e) 
        {
            new TMessage('error', '<b>Error</b> ' . $e->getMessage());
            
            TTransaction::rollback();
        }
    }
}
?>
<div>
    <h3>Relatorio odometro em Desenvolvimento...</h3>

</div>
