<?php 
/** 
 * Esser Relatorio exibi dados da tabela system_viajem
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class RelatorioQuantitativo extends TPage
{
 //   private $repos;
    public function __construct()
    {
        parent::__construct();
        
         //   TPage::include_css('app/resources/quantitativo.css');
         
                try{
                
                TTransaction::open('fiscalizacao');

                $repos = new TRepository('Viajem');
                $mil = new \Adianti\Database\TRepository('Militar');
                $total = $mil->count();
                
                //CALCULO LEAVE GERAL
                //Militares em Leave VIAJANDO
                $crit0 = new TCriteria();
                $crit0->add(new Adianti\Database\TFilter('situacao', '=', 'Viajando'));
                
                //Militares em Leave BASE
                $crit1 = new TCriteria();
                $crit1->add(new TFilter('situacao','=','Não Vai Viajar'));

                //Em Leave Viajando         
               
                $leaveViajando = $repos->count($crit0);
                //leave na Base
                $leaveBase = $repos->count($crit1);
                //Leave
                $leaveTotal = $leaveViajando;
                //Calculando Porcentagem
		$efetivoPresente = $total - $leaveTotal;
                $porcentagemLeave = ((100*$leaveTotal)/$total);
                $porcentagemLeaveBase = ((100*$leaveBase)/$total);
                $porcentagemBase = (100 - $porcentagemLeave);
                


                //CALCULO LEAVE BASE
                $crit3 = new TCriteria();
                $crit3->add(new TFilter('situacao','=','Viajando'));
                $crit3->add(new TFilter('su','=','CCAp/Btl F Paz'));
                $crit4 = new TCriteria();
                $crit4->add(new TFilter('situacao','=','Não Vai Viajar'));
                $crit4->add(new TFilter('su','=','CCAp/Btl F Paz'));
   
                $ccapviajando = $repos->count($crit3);
                $ccapbase = $repos->count($crit4);
                
     

                //CALCULO ESTADO MAIOR
                $crit6 = new TCriteria();
                $crit6->add(new TFilter('situacao','=','Viajando'));
                $crit6->add(new TFilter('su','=','EM/Btl F Paz'));
                $crit7 = new TCriteria();
                $crit7->add(new TFilter('situacao','=','Não Vai Viajar'));
                $crit7->add(new TFilter('su','=','EM/Btl F Paz'));
  
          
                 //Em Leave Viajando         
                $emviajando = $repos->count($crit6);
                //leave na Base
                $embase = $repos->count($crit7);
                
                //CALCULO ESQD
                $crit9 = new TCriteria();
                $crit9->add(new TFilter('situacao','=','Viajando'));
                $crit9->add(new TFilter('su','=','Esqd C Mec'));
                $crit10 = new TCriteria();
                $crit10->add(new TFilter('situacao','=','Não Vai Viajar'));
                $crit10->add(new TFilter('su','=','Esqd C Mec'));
                      
                 //Em Leave Viajando         
                $esqdviajando = $repos->count($crit9);
                //leave na Base
                $esqdbase = $repos->count($crit10);
        
                //CALCULO 1CIA
                $crit12 = new TCriteria();
                $crit12->add(new TFilter('situacao','=','Viajando'));
                $crit12->add(new TFilter('su','=','1ª Cia Fuz'));
                $crit13 = new TCriteria();
                $crit13->add(new TFilter('situacao','=','Não Vai Viajar'));
                $crit13->add(new TFilter('su','=','1ª Cia Fuz'));
          
                 //Em Leave Viajando         
                $cia1viajando = $repos->count($crit12);
                //leave na Base
                $cia1base = $repos->count($crit13);

                //CALCULO 2CIA
                $crit15 = new TCriteria();
                $crit15->add(new TFilter('situacao','=','Viajando'));
                $crit15->add(new TFilter('su','=','2ª Cia Fuz'));
                $crit16 = new TCriteria();
                $crit16->add(new TFilter('situacao','=','Não Vai Viajar'));
                $crit16->add(new TFilter('su','=','2ª Cia Fuz'));
               
          
                 //Em Leave Viajando         
                $cia2viajando = $repos->count($crit15);
                //leave na Base
                $cia2base = $repos->count($crit16);
 
?>



<div class="tform" align="center" style="border:1px solid #B7B7B7; width: 100%">
    <table style="border:1px solid #B7B7B7; width: 100%;">
        <span style="font-size: 32px; color:black;" ><b>LEAVE HOJE</b></span>
        <tr class="tformtitle">
            <td> <label>Total de Militares  </label> </td>
            <td> <label><?php echo $total;?></label> </td>
        </tr>
         <tr>
                  
            <td> <label > <a class='btn btn-flat' generator="adianti" href="index.php?class=RelatorioViajando" class="btn btn-default btn-flat">Total de Militares em Leave VIAJANDO</a> </label> </td>
            <td> <label><?php echo $leaveViajando?></label> </td>
        </tr>
      
        <tr class="tformtitle">
            <td> <label>Total de LEAVE </label> </td>
            <td> <label><?php echo $leaveTotal?></label> </td>
        </tr>
    </table>
</div>


<div class="tform" align="center" style="border:3px solid #008749; width: 100%">
    <table style="border:3px solid; width: 100%;">
        <span style="font-size: 32px; color:black;" ><b>TOTAL LEAVE DO BRABAT</span>
        <tr class="tform">
    
            <td> <label style="font-size: 24px; color:blue;"><?php echo 'Pronto Geral'.' '.round($efetivoPresente,2).' -'?></label> </td>
            <td> <label style="font-size: 24px; color:red;"><?php echo 'Leave Viajando'.' '.round($leaveViajando,2).' -'?></label> </td>
            <td> <label style="font-size: 24px; color:green;"><?php echo 'Leave Base'.' '.round($leaveBase,2).' -'?></label> </td>
        </tr>
  
    </table>
</div>




<div class="tform" style="border:1px solid ; width: 100%">
    <table style="border:1px solid #008749; width: 100%; ">
        <tr style="background-color: yellow;">
        <span style="font-size: 24px; color:black;">TOTAL LEAVE ESTADO MAIOR</span>
        <td> <label style="font-size: 18px; color:black;">LEAVE NÃO VAI VIAJAR</label> </td>
            <td> <label style="font-size: 18px; color:black;"><?php echo $embase?></label> </td>
        </tr>
         <tr style="background-color: yellow;">
            <td> <label style="font-size: 18px; color:black;">LEAVE VIAJANDO</label> </td>
            <td> <label style="font-size: 18px; color:black;"><?php echo $emviajando?></label> </td>
        </tr>
   
    
    </table>
</div>

<div class="tform" style="border:1px solid ; width: 100%">
    <table style="border:1px solid #008749; width: 100%; ">
        <tr style="background-color: green;">
        <span style="font-size: 24px; color:black;">TOTAL LEAVE CCAP</span>
        <td> <label style="font-size: 18px; color:#ffffff;">LEAVE NÃO VAI VIAJAR</label> </td>
            <td> <label style="font-size: 18px; color:#ffffff;"><?php echo $ccapbase?></label> </td>
        </tr>
         <tr style="background-color: green;">
            <td> <label style="font-size: 18px; color:#ffffff;">LEAVE VIAJANDO</label> </td>
            <td> <label style="font-size: 18px; color:#ffffff;"><?php echo $ccapviajando?></label> </td>
        </tr>
  
    
    </table>
</div>
<div class="tform" style="border:1px solid ; width: 100%">
    <table style="border:1px solid #008749; width: 100%; ">
        <tr style="background-color: red;">
        <span style="font-size: 24px; color:black;">PORCENTAGEM LEAVE ESQD</span>
        <td> <label style="font-size: 18px; color:#ffffff;">LEAVE NÃO VAI VIAJAR</label> </td>
            <td> <label style="font-size: 18px; color:#ffffff;"><?php echo $esqdbase?></label> </td>
        </tr>
         <tr style="background-color: red;">
            <td> <label style="font-size: 18px; color:#ffffff;">LEAVE VIAJANDO</label> </td>
            <td> <label style="font-size: 18px; color:#ffffff;"><?php echo $esqdviajando?></label> </td>
        </tr>

    
    </table>
</div>
<div class="tform" style="border:1px solid ; width: 100%">
    <table style="border:1px solid #008749; width: 100%; ">
        <tr style="background-color:#00c0ef;">
        <span style="font-size: 24px; color:black;">PORCENTAGEM LEAVE 1ªCIA FUZ PAZ</span>
        <td> <label style="font-size: 18px; color:#000;">LEAVE NÃO VAI VIAJAR</label> </td>
            <td> <label style="font-size: 18px; color:#000;"><?php echo $cia1base?></label> </td>
        </tr>
         <tr style="background-color: #00c0ef;">
            <td> <label style="font-size: 18px; color:#000;">LEAVE VIAJANDO</label> </td>
            <td> <label style="font-size: 18px; color:#000;"><?php echo $cia1viajando?></label> </td>
        </tr>

    
    </table>
</div>
<div class="tform" style="border:1px solid ; width: 100%">
    <table style="border:1px solid #008749; width: 100%; ">
        <tr style="background-color: black;">
        <span style="font-size: 24px; color:black;">PORCENTAGEM LEAVE 2ºCIA FUZ PAZ</span>
        <td> <label style="font-size: 18px; color:#ffffff;">LEAVE NÃO VAI VIAJAR</label> </td>
            <td> <label style="font-size: 18px; color:#ffffff;"><?php echo $cia2base?></label> </td>
        </tr>
         <tr style="background-color: black;">
            <td> <label style="font-size: 18px; color:#ffffff;">LEAVE VIAJANDO</label> </td>
            <td> <label style="font-size: 18px; color:#ffffff;"><?php echo $cia2viajando?></label> </td>
        </tr>

    
    </table>
</div>



<?php

            
                TTransaction::close();
               
                } catch (Exception $e) {
                       
                    new \Adianti\Widget\Dialog\TMessage('error', $e->getMessage());
                }
               
    }
      
    
}





