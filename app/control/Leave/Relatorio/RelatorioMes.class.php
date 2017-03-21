
<?php

class RelatorioMes extends TPage
{
    private $form;

    function __construct()
    {
        parent::__construct();
        
        ini_set( 'display_errors', 0 );
        
        $this->form = new TForm('form_Customer_Report');
        $this->form->class = 'tform'; 
             
        $table = new TTable;
        $table-> width = '650px';

        $this->form->add($table);

        $postograd     = new TCombo('postograd');
        $name         = new TEntry('nome');
        $su         = new TCombo('su');
        $subunidade         = new TCombo('subunidade');
        $ida      = new TCombo('ida');
        $chegada      = new TCombo('chegada');
        $destino      = new TCombo('destino');
        $situacao      = new TCombo('situacao');
        
        
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
        
        $vj = array();
        $vj['Não Vai Viajar'] = 'Não Vai Viajar';
        $vj['Vai Viajar'] = 'Vai Viajar';        
        $vj['Viajando']='Viajando'; 
        $vj['Finalizado'] = 'Finalizado';
        $situacao->addItems($vj);
        
        $dst =  array();
        $dst['Base'] = 'Base';
        $dst['Brasil'] = 'Brasil';
        $dst['Europa'] = 'Europa';
        $dst['EUA'] = 'EUA';
        $dst['Republica Dominicana'] = 'Republica Dominicana';
        $dst['Santo Domingo'] = 'Santo Domingo';
        $dst['Juan Dolio'] = 'Juan Dolio';
        $dst['Punta Cana'] = 'Punta Cana';      
        $dst['Boca Chica'] = 'Boca Chica';      
        $dst['Outro'] = 'Outro';
        $destino->addItems($dst);
        
        //Caixa selecao Subunidade
        $mes = array();
        $mes['01'] = 'Janeiro';
        $mes['02'] = 'Fevereiro';
        $mes['03'] = 'Março';
        $mes['04'] = 'Abril';
        $mes['05'] = 'Maio';
        $mes['06'] = 'Junho';
        $mes['07'] = 'Julho';
        $mes['08'] = 'Agosto';
        $mes['09'] = 'Setembro';
        $mes['10'] = 'Outubro';
        $mes['11'] = 'Novembro';
        $mes['12'] = 'Dezembro';
        $ida->addItems($mes);

        //Caixa selecao Subunidade
        $me = array();
        $me['01'] = 'Janeiro';
        $me['02'] = 'Fevereiro';
        $me['03'] = 'Março';
        $me['04'] = 'Abril';
        $me['05'] = 'Maio';
        $me['06'] = 'Junho';
        $me['07'] = 'Julho';
        $me['08'] = 'Agosto';
        $me['09'] = 'Setembro';
        $me['10'] = 'Outubro';
        $me['11'] = 'Novembro';
        $me['12'] = 'Dezembro';
        $chegada->addItems($me);
        
        // Tela de Saída     
        $output_type  = new TRadioGroup('output_type');
        $options = array('html' => 'HTML', 'pdf' => 'PDF', 'rtf' => 'RTF');
        $output_type->addItems($options);
        $output_type->setValue('pdf');
        $output_type->setLayout('horizontal');
        
        // define the sizes
        $name->setSize(200);
        
        // add a row for the field name
        $row  = $table->addRowSet(new TLabel('Relatórios Mensal de Leave Arejamento'), '');
        $row->class = 'tformtitle'; // CSS class
        
        // add the fields into the table
        $table->addRowSet(new TLabel('P/G' . ': '), $postograd);
        $table->addRowSet(new TLabel('Nome Guerra' . ': '), $name);
        $table->addRowSet(new TLabel('SU' . ': '), $su);
        $table->addRowSet(new TLabel('Fração' . ': '), $subunidade);
        $table->addRowSet(new TLabel('Mes Embarque' . ': '), $ida);
        $table->addRowSet(new TLabel('Mes Chegada' . ': '), $chegada);
        $table->addRowSet(new TLabel('Situação' . ': '),$situacao);
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
        $this->form->setFields(array($postograd,$name,$su,$subunidade,$ida,$chegada,$destino,$situacao,$output_type,$save_button));
        
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add($this->form);

        parent::add($vbox);
    }

    function onGenerate()
    {
        try
        {
            // open a transaction with database 'samples'
            TTransaction::open('fiscalizacao');
            
            // get the form data into an active record Customer
            $object = $this->form->getData();
            
           // var_dump($object);
            $repository = new TRepository('Viajem');
	

            $criteria   = new TCriteria;
            if ($object->nome)
            {
                $criteria->add(new TFilter('nome', 'like', "%{$object->nome}%"));
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
            
            if ($object->situacao)
            {
                $criteria->add(new TFilter('situacao', '=', "{$object->situacao}"));
            }
            if ($object->ida)
            {
                $criteria->add(new TFilter('Month(ida)', '=', "$object->ida}"));
            }
            if ($object->chegada)
            {
                $criteria->add(new TFilter('Month(chegada)', '=', "{$object->chegada}"));
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
            {                 //01-02-03--04-05-06-07-08-09-10-11--12-13
                $widths = array(20,20,40,100,70,60,60,60,60,60,100,70);
                
                switch ($format)
                {
                    case 'html':
                        $tr = new TTableWriterHTML($widths);
                        break;
                    case 'pdf':
                        //alterei o parametro da classe para L paisagem
                        $tr = new TTableWriterPDF($widths,'L');
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
                    $tr->addStyle('datap', 'Arial',  '8',  '', '#000000', '#869FBB');
                    $tr->addStyle('datai', 'Arial',  '8',  '', '#000000', '#ffffff');
                    $tr->addStyle('header', 'Times', '12',  '', '#000000', '#B5FFB4');
                    $tr->addStyle('footer', 'Times', '10',  '', '#2B2B2B', '#B5FFB4');
                    
                    // add a header row
                    $tr->addRow();
                    $tr->addCell('Relatório Leave - BRABAT 24', 'center', 'header', 40);
                    
                    // add titles row
                    $tr->addRow();
                    $tr->addCell('Or', 'center', 'title');
                    $tr->addCell('Nr', 'center', 'title');
                    $tr->addCell('P/G', 'center', 'title');
                    $tr->addCell('Guerra', 'center', 'title');
                    $tr->addCell('SU', 'center', 'title');
                    $tr->addCell('D. Embarque', 'center', 'title');
                    $tr->addCell('H. Embarque', 'center', 'title');
                    $tr->addCell('Saída Base', 'center', 'title');
                    $tr->addCell('D. Chegada', 'center', 'title');
                    $tr->addCell('H. Chegada', 'center', 'title');
                    $tr->addCell('Destino', 'center', 'title');
                    $tr->addCell('Situação', 'center', 'title');

                    // controls the background filling
                    $colour= FALSE;
                    $i=0;
                    // data rows
                    foreach ($customers as $customer)
                    {
                        $i++;
                      //  $style = $colour ? 'datap' : 'datai';
                        $style = 'datai';
                        $tr->addRow();
                        $tr->addCell($i, 'center', $style);
                        $tr->addCell($customer->id, 'center', $style);
                        $tr->addCell($customer->postograd, 'center', $style);
                        $tr->addCell($customer->guerra, 'center', $style);
                        $tr->addCell($customer->su, 'center', $style);
                        $tr->addCell($customer->ida, 'center', $style);
                        $tr->addCell($customer->horaIda, 'center', $style);
                        $tr->addCell($customer->saidaBase, 'center', $style);
                         $tr->addCell($customer->chegada, 'center', $style);
                         $tr->addCell($customer->horaChegada, 'center', $style);
                         $tr->addCell($customer->destino, 'center', $style);
                        $tr->addCell($customer->situacao, 'center', $style);

                        $colour = !$colour;
                    }
                    
                    $tr->addRow();
                    $tr->addCell(date('Y-m-d h:i:s'), 'center', 'footer', 15);
                    if (!file_exists("app/output/tabular.{$format}") OR is_writable("app/output/tabular.{$format}"))
                    {
                        $tr->save("app/output/tabular.{$format}");
                    }
                    else
                    {
                        throw new Exception(_t('Permission denied') . ': ' . "app/output/tabular.{$format}");
                    }
                    
                    parent::openFile("app/output/tabular.{$format}");
                    
                    new TMessage('info', 'Relatório gerado. Habilite o popup no seu navegador.');
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
    <h3>Nas pesquisas com DATAS utilize uma opção <b>DATA EMBARQUE OU  DATA CHEGADA</b>!</h3>

</div>

