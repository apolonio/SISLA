<?php
class Grafico extends TPage
{
    /**
     * Class constructor
     * Creates the page
     */
    function __construct()
    {
        parent::__construct();
        
//        $data['Energia'] = array( 1, 2,  3, 4,  5, 6, 7);
//        $data['Elevadores'] = array(12, 3, 12, 4, 12, 4, 2);
//        $data['Agua']  = array( 9, 8,  7, 6,  5, 4, 3);
//        
//        $chart = new TLineChart(new TPChartDesigner);
//        $chart->setTitle('Financeiro', NULL, NULL);
//        $chart->setSize(640, 300);
//        $chart->setXLabels(array('Jan', 'Fev', 'Mar', 'Abril'));
//        $chart->setYLabel('Y axis label');
//        
//        $chart->setOutputPath('app/output/linechart.png');
//        $chart->addData('Energia', $data['Energia']);
//        $chart->addData('Elevadores', $data['Elevadores']);
//        $chart->addData('Agua',  $data['Agua']);
//        $chart->generate();
        
             
            TTransaction::open('fiscalizacao');
            
            $repository = new TRepository('Viatura');
            
            // CAPTURANDO USUARIO
            $user= SystemUser::newFromLogin(TSession::getValue('login'));
            
            $critA = new \Adianti\Database\TCriteria();
            $critA->add(new TFilter('destino','=','AEROPORTO'));
            $totalA = $repository->count($critA);
            
            $critE = new \Adianti\Database\TCriteria();
            $critE->add(new TFilter('destino','=','RODOVIARIA'));
            $totalE = $repository->count($critE);
            
            $critO = new \Adianti\Database\TCriteria();
            $critO->add(new TFilter('destino','=','OUTROS'));
            $totalO = $repository->count($critO);
            
            //Contagem dos valores para repassar ao construtor de gráfico
             $totalA;
             $totalE;
             $totalO;
            
            $criteria = new TCriteria;
            
            //$order    = isset($param['order']) ? $param['order'] : 'ida';
           // $criteria->setProperty('order', $order);
          //  $criteria->add(new TFilter('nome','=',$user->name));
            $categories = $repository->load($criteria);
           // $this->datagrid->clear();

            if ($categories)
            {
                $total=0;
                $dia =0;
                foreach ($categories as $category)
                {
                  if($total):
                      
                      
                      
                  endif;
                     $category->idChefeVtr.'<br>';
                     $category->ida.'<br>';
                     $ida= $category->hodoIda;
                     $chegada= $category->hodoChegada;
                     $dia = ($chegada) - ($ida);
                     $total = $total + $dia;
                   
                    //$total.'<br>';
                }
             
            }
        
            TTransaction::close();
            
        
        
        //Cria Grafico
        $chart = new TPieChart(new TPChartDesigner);
         $chart->setTitle('Gráfico Saída de Viaturas do G1');
         $chart->setSize(640, 300);
         $chart->setOutputPath('app/output/piechart.png');
         
              
         
         //Puxando os dados
         $chart->addData('AEROPOTO', $totalA);
         $chart->addData('RODOVI�RIA', $totalE);
         $chart->addData('OUTROS', $totalO);
         $chart->generate();
        
    //    parent::add(new TImage('app/output/piechart.png'));
        
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add(new TImage('app/output/piechart.png'));

        parent::add($vbox);
        
        echo " <span>Total de saídas - AEROPORTO - <font style=color:blue>". $totalA ."</font></span></br>";
        echo " <span>Total de saídas - RODOVI�RIA - <font style=color:blue> ". $totalE ."</font></span></br>";
        echo " <span>Total de saídas - OUTROS - <font style=color:blue> ". $totalO."</font></span></br>";
        echo " <span>Total de Kilometros Rodados - GERAL - <font style=color:red> ". $total."</font></span>";
    }
}
?>


