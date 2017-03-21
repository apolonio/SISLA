<?php
class GraficoLeave extends TPage
{

    function __construct()
    {
        parent::__construct();
                
             
            TTransaction::open('fiscalizacao');
            
            $repository = new TRepository('Viajem');
            
            // CAPTURANDO USUARIO
            $user= SystemUser::newFromLogin(TSession::getValue('login'));
            
            $critA = new \Adianti\Database\TCriteria();
            $critA->add(new TFilter('destino','=','Brasil'));
            $critA->add(new TFilter('situacao','=','Finalizado'));
            $totalA = $repository->count($critA);
            
            $critEUA = new \Adianti\Database\TCriteria();
            $critEUA->add(new TFilter('destino','=','EUA'));
            $critEUA->add(new TFilter('situacao','=','Finalizado'));
            $totalEUA = $repository->count($critEUA);
            
            $critRD = new \Adianti\Database\TCriteria();
            $critRD->add(new TFilter('destino','=','Republica Dominicana'));
            $critRD->add(new TFilter('situacao','=','Finalizado'));
            $totalRD = $repository->count($critRD);
            
            $critPC = new \Adianti\Database\TCriteria();
            $critPC->add(new TFilter('destino','=','Punta Cana'));
            $critPC->add(new TFilter('situacao','=','Finalizado'));
            $totalPC = $repository->count($critPC);
            
            $critSD = new \Adianti\Database\TCriteria();
            $critSD->add(new TFilter('destino','=','Santo Domingo'));
            $critSD->add(new TFilter('situacao','=','Finalizado'));
            $totalSD = $repository->count($critSD);
            
            $critOUT = new \Adianti\Database\TCriteria();
            $critOUT->add(new TFilter('destino','=','Outro'));
            $critOUT->add(new TFilter('situacao','=','Finalizado'));
            $totalOUT = $repository->count($critOUT);
                       
            $critO = new \Adianti\Database\TCriteria();
            $critO->add(new TFilter('destino','=','Base'));
            $critO->add(new TFilter('situacao','=','Finalizado'));
            $totalO = $repository->count($critO);
            
            //Contagem dos valores para repassar ao construtor de gráfico
             $totalA;
             $totalE = $totalEUA + $totalPC + $totalSD + $totalOUT ;
             $totalO;
            
            $criteria = new TCriteria;
            
            //$order    = isset($param['order']) ? $param['order'] : 'ida';
           // $criteria->setProperty('order', $order);
          //  $criteria->add(new TFilter('nome','=',$user->name));
          //  $categories = $repository->load($criteria);
           // $this->datagrid->clear();

             
          
            TTransaction::close();
            
        
        
        //Cria Grafico
         $chart = new TPieChart(new TPChartDesigner);
         $chart->setTitle('Gráfico Leave');
         $chart->setSize(640, 300);
         $chart->setOutputPath('app/output/piechart.png');
         
              
         
         //Puxando os dados
         $chart->addData('BRASIL', $totalA);
         $chart->addData('EXTERIOR', $totalE);
         $chart->addData('BASE', $totalO);
         $chart->generate();
        
    //    parent::add(new TImage('app/output/piechart.png'));
        
        // wrap the page content using vertical box
        $vbox = new TVBox;
        $vbox->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $vbox->add(new TImage('app/output/piechart.png'));

        parent::add($vbox);
        
        echo " <span>Total de saídas - BRASIL - <font style=color:blue>". $totalA ."</font></span></br>";
        echo " <span>Total de saídas - EXTERIOR - <font style=color:blue> ". $totalE ."</font></span></br>";
        echo " <span>Total de saídas - BASE - <font style=color:blue> ". $totalO."</font></span></br>";
    }
}
?>


