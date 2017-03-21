<?php
/** 
 * Esser Relatorio exibi dados da tabela system_viajem
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class RelatorioAutorizacao extends TPage
{
    
 //   private $repos;
    
    public function __construct()
    {
        parent::__construct();
        
            TPage::include_css('app/resources/quantitativo.css');
         
                try{
                
                TTransaction::open('fiscalizacao');

                $repos = new TRepository('Viajem');
                $mil = new \Adianti\Database\TRepository('Militar');
               // $total = $mil->count();
                
                //CALCULO LEAVE GERAL
                //Militares em Leave VIAJANDO
                $crit0 = new TCriteria();
                $crit0->add(new Adianti\Database\TFilter('status', '=', 'Autorizado'));
                
                //Militares em Leave BASE
                $crit1 = new TCriteria();
                $crit1->add(new TFilter('status','=','Aguardando Autorização'));
                
                //Militares em Leave FINALIZADO
                $crit2 = new TCriteria();
                $crit2->add(new TFilter('status','=','Não Autorizado'));
                
             
                
                //CALCULO LEAVE BASE
                $crit3 = new TCriteria();
                $crit3->add(new TFilter('status', '=', 'Autorizado'));
                $crit3->add(new TFilter('su','=','CCAp/Btl F Paz'));
                $crit4 = new TCriteria();
                $crit4->add(new TFilter('status','=','Aguardando Autorização'));
                $crit4->add(new TFilter('su','=','CCAp/Btl F Paz'));
                $crit5 = new TCriteria();
                $crit5->add(new TFilter('status','=','Não Autorizado'));
                $crit5->add(new TFilter('su','=','CCAp/Btl F Paz'));
   
                $ccapAutorizado = $repos->count($crit3);
                $ccapAguardandoAutorizacao = $repos->count($crit4);
                $ccapNaoAutorizado = $repos->count($crit5);
                
                
                 //Em Leave Viajando         
                $Autorizados = $repos->count($crit0);
                //leave na Base
                $AguardandoAutorizacao = $repos->count($crit1);
                //Leave Finalizado
                $NaoAutorizados = $repos->count($crit2);
                
                $TotalAutorizacao = $Autorizados + $AguardandoAutorizacao + $NaoAutorizados ;
                
                //Calculando Porcentagem
                $porcentagemAutorizados = ((100 * $Autorizados)/$TotalAutorizacao);
                $porcentagemAguardando = ((100 * $AguardandoAutorizacao)/$TotalAutorizacao);
                $porcentagemNao = ((100*$NaoAutorizados)/$TotalAutorizacao);
                
//                if ($leaveTotal > 10){
//                    $msg = new \Adianti\Widget\Dialog\TMessage('info','Limite Atingido');
//                }
                
                
                //CALCULO ESTADO MAIOR
                $crit6 = new TCriteria();
                $crit6->add(new TFilter('status','=','Autorizado'));
                $crit6->add(new TFilter('su','=','EM/Btl F Paz'));
                $crit7 = new TCriteria();
                $crit7->add(new TFilter('status','=','Aguardando Autorização'));
                $crit7->add(new TFilter('su','=','EM/Btl F Paz'));
                $crit8 = new TCriteria();
                $crit8->add(new TFilter('status','=','Não Autorizado'));
                $crit8->add(new TFilter('su','=','EM/Btl F Paz'));
          
                 //Em Leave Viajando         
                $emAutorizado = $repos->count($crit6);
                //leave na Base
                $emAguardandoAutorizacao = $repos->count($crit7);
                //Leave Finalizado
                $emNaoAutorizado = $repos->count($crit8);
             
                
                //CALCULO ESQD
                $crit9 = new TCriteria();
                $crit9->add(new TFilter('status','=','Autorizado'));
                $crit9->add(new TFilter('su','=','Esqd C Mec'));
                $crit10 = new TCriteria();
                $crit10->add(new TFilter('status','=','Aguardando Autorização'));
                $crit10->add(new TFilter('su','=','Esqd C Mec'));
                $crit11 = new TCriteria();
                $crit11->add(new TFilter('status','=','Não Autorizado'));
                $crit11->add(new TFilter('su','=','Esqd C Mec'));
          
                 //Em Leave Viajando         
                $esqdAutorizado = $repos->count($crit9);
                //leave na Base
                $esqdAguardandoAutorizacao = $repos->count($crit10);
                //Leave Finalizado
                $esqdNaoAutorizado = $repos->count($crit11);
                
                
                
                //CALCULO 1CIA
                $crit12 = new TCriteria();
                $crit12->add(new TFilter('status','=','Autorizado'));
                $crit12->add(new TFilter('su','=','1ª Cia Fuz'));
                $crit13 = new TCriteria();
                $crit13->add(new TFilter('status','=','Aguardando Autorização'));
                $crit13->add(new TFilter('su','=','1ª Cia Fuz'));
                $crit14 = new TCriteria();
                $crit14->add(new TFilter('status','=','Não Autorizado'));
                $crit14->add(new TFilter('su','=','1ª Cia Fuz'));
          
                 //Em Leave Viajando         
                $cia1Autorizado = $repos->count($crit12);
                //leave na Base
                $cia1AguardandoAutorizacao = $repos->count($crit13);
                //Leave Finalizado
                $cia1NaoAutorizado = $repos->count($crit14);
                

                //CALCULO 2CIA
                $crit15 = new TCriteria();
                $crit15->add(new TFilter('status','=','Autorizado'));
                $crit15->add(new TFilter('su','=','2ª Cia Fuz'));
                $crit16 = new TCriteria();
                $crit16->add(new TFilter('status','=','Aguardando Autorização'));
                $crit16->add(new TFilter('su','=','2ª Cia Fuz'));
                $crit17 = new TCriteria();
                $crit17->add(new TFilter('status','=','Não Autorizado'));
                $crit17->add(new TFilter('su','=','2ª Cia Fuz'));
          
                 //Em Leave Viajando         
                $cia2Autorizado = $repos->count($crit15);
                //leave na Base
                $cia2AguardandoAutorizacao = $repos->count($crit16);
                //Leave Finalizado
                $cia2NaoAutorizado = $repos->count($crit17);
                
?>



<div class="tform" align="center" style="border:1px solid #B7B7B7; width: 100%">
    <table style="border:1px solid #B7B7B7; width: 100%;">
        <span style="font-size: 32px; color:black;" ><b>EM PROCESSO AUTORIZAÇÃO</b></span>
        <tr class="tformtitle">
            <td> <label>Total de Lançamento de Cadastro de Leave  </label> </td>
            <td> <label><?php echo $TotalAutorizacao;?></label> </td>
        </tr>
         <tr>
       
            <td> <label>Total de Militares Autorizados </label> </td>
            <td> <label><?php echo $Autorizados?></label> </td>
        </tr>
        <tr>
            <td> <label>Total de Militares Aguardando Autorização </label> </td>
            <td> <label><?php echo $AguardandoAutorizacao?></label> </td>
        </tr>
        <tr>
            <td> <label>Total de Militares Não Autorizados </label> </td>
            <td> <label><?php echo $NaoAutorizados?></label> </td>
        </tr>
   
    </table>
</div>


<div class="tform" align="center" style="border:3px solid #008749; width: 100%">
    <table style="border:3px solid; width: 100%;">
        <span style="font-size: 32px; color:black;" ><b>PORCENTAGENS</span>
        <tr class="tform">
    
            <td> <label style="font-size: 24px; color:blue;"><?php echo 'Autorizados'.' '.round($porcentagemAutorizados,2).' %'?></label> </td>
            <td> <label style="font-size: 24px; color:red;"><?php echo 'Aguardando Autorização'.' '.round($porcentagemAguardando,2).' %'?></label> </td>
            <td> <label style="font-size: 24px; color:green;"><?php echo 'Não Autorizado'.' '.round($porcentagemNao,2).' %'?></label> </td>
        </tr>
  
    </table>
</div>




<div class="tform" style="border:1px solid ; width: 100%">
    <table style="border:1px solid #008749; width: 100%; ">
        <tr style="background-color: yellow;">
        <span style="font-size: 24px; color:black;">TOTAL ESTADO MAIOR</span>
        <td> <label style="font-size: 18px; color:black;">EM Autorizados </label> </td>
            <td> <label style="font-size: 18px; color:black;"><?php echo $emAutorizado?></label> </td>
        </tr>
         <tr style="background-color: yellow;">
            <td> <label style="font-size: 18px; color:black;">EM Aguardando Autorização</label> </td>
            <td> <label style="font-size: 18px; color:black;"><?php echo $emAguardandoAutorizacao?></label> </td>
        </tr>
        <tr style="background-color: yellow;">
            <td> <label style="font-size: 18px; color:black;">EM Não Autorizados</label> </td>
            <td><label style="font-size: 18px; color:black;"><?php echo $emNaoAutorizado?></label> </td>
        </tr>
    
    </table>
</div>

<div class="tform" style="border:1px solid ; width: 100%">
    <table style="border:1px solid #008749; width: 100%; ">
        <tr style="background-color: green;">
        <span style="font-size: 24px; color:black;">TOTAL CCAp</span>
        <td> <label style="font-size: 18px; color:#ffffff;">CCAp Autorizados</label> </td>
            <td> <label style="font-size: 18px; color:#ffffff;"><?php echo $ccapAutorizado?></label> </td>
        </tr>
         <tr style="background-color: green;">
            <td> <label style="font-size: 18px; color:#ffffff;">CCAp Aguardando Autorização</label> </td>
            <td> <label style="font-size: 18px; color:#ffffff;"><?php echo $ccapAguardandoAutorizacao?></label> </td>
        </tr>
        <tr style="background-color: green;">
            <td> <label style="font-size: 18px; color:#ffffff;">CCAp Não Autorizados</label> </td>
            <td><label style="font-size: 18px; color:#ffffff;"><?php echo $ccapNaoAutorizado?></label> </td>
        </tr>
    
    </table>
</div>
<div class="tform" style="border:1px solid ; width: 100%">
    <table style="border:1px solid #008749; width: 100%; ">
        <tr style="background-color: red;">
        <span style="font-size: 24px; color:black;">TOTAL ESQD</span>
        <td> <label style="font-size: 18px; color:#ffffff;">ESQD Autorizados</label> </td>
            <td> <label style="font-size: 18px; color:#ffffff;"><?php echo $esqdAutorizado?></label> </td>
        </tr>
         <tr style="background-color: red;">
            <td> <label style="font-size: 18px; color:#ffffff;">ESQD Aguardando Autorização</label> </td>
            <td> <label style="font-size: 18px; color:#ffffff;"><?php echo $esqdAguardandoAutorizacao?></label> </td>
        </tr>
        <tr style="background-color: red;">
            <td> <label style="font-size: 18px; color:#ffffff;">ESQD Não Autorizados</label> </td>
            <td><label style="font-size: 18px; color:#ffffff;"><?php echo $esqdNaoAutorizado?></label> </td>
        </tr>
    
    </table>
</div>
<div class="tform" style="border:1px solid ; width: 100%">
    <table style="border:1px solid #008749; width: 100%; ">
        <tr style="background-color:#00c0ef;">
        <span style="font-size: 24px; color:black;">TOTAL 1ªCIA FUZ PAZ</span>
        <td> <label style="font-size: 18px; color:#000;">1ªCIA FUZ PAZ Autorizados</label> </td>
            <td> <label style="font-size: 18px; color:#000;"><?php echo $cia1Autorizado?></label> </td>
        </tr>
         <tr style="background-color: #00c0ef;">
            <td> <label style="font-size: 18px; color:#000;">1ªCIA FUZ PAZ Aguardando Autorização</label> </td>
            <td> <label style="font-size: 18px; color:#000;"><?php echo $cia1AguardandoAutorizacao?></label> </td>
        </tr>
        <tr style="background-color: #00c0ef;">
            <td> <label style="font-size: 18px; color:#000;">1ªCIA FUZ PAZ Não Autorizados</label> </td>
            <td><label style="font-size: 18px; color:#000;"><?php echo $cia1NaoAutorizado?></label> </td>
        </tr>
    
    </table>
</div>
<div class="tform" style="border:1px solid ; width: 100%">
    <table style="border:1px solid #008749; width: 100%; ">
        <tr style="background-color: black;">
        <span style="font-size: 24px; color:black;">TOTAL 2ºCIA FUZ PAZ</span>
        <td> <label style="font-size: 18px; color:#ffffff;">2ºCIA FUZ PAZ Autorizados</label> </td>
            <td> <label style="font-size: 18px; color:#ffffff;"><?php echo $cia2Autorizado?></label> </td>
        </tr>
         <tr style="background-color: black;">
            <td> <label style="font-size: 18px; color:#ffffff;">2ºCIA FUZ PAZ Aguardando Autorização</label> </td>
            <td> <label style="font-size: 18px; color:#ffffff;"><?php echo $cia2AguardandoAutorizacao?></label> </td>
        </tr>
        <tr style="background-color: black;">
            <td> <label style="font-size: 18px; color:#ffffff;">2ºCIA FUZ PAZ Não Autorizados</label> </td>
            <td><label style="font-size: 18px; color:#ffffff;"><?php echo $cia2NaoAutorizado?></label> </td>
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





