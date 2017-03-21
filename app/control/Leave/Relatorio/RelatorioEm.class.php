<?php
/** 
 * Esser Relatorio exibi dados da tabela system_militar
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class RelatorioEm extends TPage
{

    public function __construct()
    {
        parent::__construct();
         
        try{
            
        TTransaction::open('fiscalizacao');

        $repos = new TRepository('Viajem');
        $mil = new \Adianti\Database\TRepository('Militar');
        
        //Total de Militares do G1
        $critTotalG1 = new Adianti\Database\TCriteria();
        $critTotalG1->add(new TFilter('subunidade','=','G1'));
        $totalG1= $mil->count($critTotalG1);
        $totalRG1= $repos->count($critTotalG1);
       
        //Total de Militares do G2
        $critTotalG2 = new Adianti\Database\TCriteria();
        $critTotalG2->add(new TFilter('subunidade','=','G2'));
        $totalG2= $mil->count($critTotalG2);
        $totalRG2= $repos->count($critTotalG2);
        
        //Total de Militares do G3
        $critTotalG3 = new Adianti\Database\TCriteria();
        $critTotalG3->add(new TFilter('subunidade','=','G3'));
        $totalG3= $mil->count($critTotalG3);
        $totalRG3= $repos->count($critTotalG3);
        
        //Total de Militares do G4
        $critTotalG4 = new Adianti\Database\TCriteria();
        $critTotalG4->add(new TFilter('subunidade','=','G4'));
        $totalG4= $mil->count($critTotalG4);
        $totalRG4= $repos->count($critTotalG4);
        //Total de Militares do G6
        $critTotalG6= new Adianti\Database\TCriteria();
        $critTotalG6->add(new TFilter('subunidade','=','G6'));
        $totalG6= $mil->count($critTotalG6);
        $totalRG6= $repos->count($critTotalG6);
        //Total de Militares do G9
        $critTotalG9 = new Adianti\Database\TCriteria();
        $critTotalG9->add(new TFilter('subunidade','=','G9'));
        $totalG9= $mil->count($critTotalG9);
        $totalRG9= $repos->count($critTotalG9);
        //Total de Militares do G10
        $critTotalG10 = new Adianti\Database\TCriteria();
        $critTotalG10->add(new TFilter('subunidade','=','G10'));
        $totalG10= $mil->count($critTotalG10);
        $totalRG10= $repos->count($critTotalG10);
        //CALCULO LEAVE G1
        //Militares em Leave VIAJANDO
        $crit0 = new TCriteria();
        $crit0->add(new Adianti\Database\TFilter('status', '=', 'Autorizado'));
        $crit0->add(new Adianti\Database\TFilter('subunidade', '=', 'G1'));

        //Militares em Leave BASE
        $crit1 = new TCriteria();
        $crit1->add(new TFilter('status','=','Aguardando Autorização'));
        $crit1->add(new Adianti\Database\TFilter('subunidade', '=', 'G1'));
        //Militares em Leave FINALIZADO
        $crit2 = new TCriteria();
        $crit2->add(new TFilter('status','=','Não Autorizado'));
        $crit2->add(new Adianti\Database\TFilter('subunidade', '=', 'G1'));
        
        $G1Autorizado = $repos->count($crit0);
        $G1AguardandoAutorizacao = $repos->count($crit1);
        $G1NaoAutorizado = $repos->count($crit2);
        
        $paG1 = ((100 * $G1Autorizado)/$totalRG1);
        $paaG1 = ((100 * $G1AguardandoAutorizacao)/$totalRG1);
        $pnaG1 = ((100*$G1NaoAutorizado)/$totalRG1);
        
        //CALCULO LEAVE G2
        $crit3 = new TCriteria();
        $crit3->add(new Adianti\Database\TFilter('subunidade', '=', 'G2'));
        $crit3->add(new TFilter('status', '=', 'Autorizado'));
        
           
        $crit4 = new TCriteria();
        $crit4->add(new TFilter('status','=','Aguardando Autorização'));
        $crit4->add(new Adianti\Database\TFilter('subunidade', '=', 'G2'));
        
        $crit5 = new TCriteria();
        $crit5->add(new TFilter('status','=','Não Autorizado'));
        $crit5->add(new Adianti\Database\TFilter('subunidade', '=', 'G2'));

        $G2Autorizado = $repos->count($crit3);
        $G2AguardandoAutorizacao = $repos->count($crit4);
        $G2NaoAutorizado = $repos->count($crit5);
        
        $paG2 = ((100 * $G2Autorizado)/$totalRG2);
        $paaG2 = ((100 * $G2AguardandoAutorizacao)/$totalRG2);
        $pnaG2 = ((100*$G2NaoAutorizado)/$totalRG2);

        //CALCULO LEAVE G3
        $crit6 = new TCriteria();
        $crit6->add(new TFilter('status', '=', 'Autorizado'));
        $crit6->add(new Adianti\Database\TFilter('subunidade', '=', 'G3'));
           
        $crit7 = new TCriteria();
        $crit7->add(new TFilter('status','=','Aguardando Autorização'));
        $crit7->add(new Adianti\Database\TFilter('subunidade', '=', 'G3'));
        
        $crit8 = new TCriteria();
        $crit8->add(new TFilter('status','=','Não Autorizado'));
        $crit8->add(new Adianti\Database\TFilter('subunidade', '=', 'G3'));

        $G3Autorizado = $repos->count($crit6);
        $G3AguardandoAutorizacao = $repos->count($crit7);
        $G3NaoAutorizado = $repos->count($crit8);
        
        $paG3 = ((100 * $G3Autorizado)/$totalRG3);
        $paaG3 = ((100 * $G3AguardandoAutorizacao)/$totalRG3);
        $pnaG3 = ((100*$G3NaoAutorizado)/$totalRG3);
      
        //CALCULO LEAVE G4
        $crit9 = new TCriteria();
        $crit9->add(new TFilter('status', '=', 'Autorizado'));
        $crit9->add(new Adianti\Database\TFilter('subunidade', '=', 'G4'));
           
        $crit10 = new TCriteria();
        $crit10->add(new TFilter('status','=','Aguardando Autorização'));
        $crit10->add(new Adianti\Database\TFilter('subunidade', '=', 'G4'));
        
        $crit11 = new TCriteria();
        $crit11->add(new TFilter('status','=','Não Autorizado'));
        $crit11->add(new Adianti\Database\TFilter('subunidade', '=', 'G4'));

        $G4Autorizado = $repos->count($crit9);
        $G4AguardandoAutorizacao = $repos->count($crit10);
        $G4NaoAutorizado = $repos->count($crit11);
        
        $paG4 = ((100 * $G4Autorizado)/$totalRG4);
        $paaG4 = ((100 * $G4AguardandoAutorizacao)/$totalRG4);
        $pnaG4 = ((100*$G4NaoAutorizado)/$totalRG4);
        
        
        //CALCULO LEAVE G6
        $crit12 = new TCriteria();
        $crit12->add(new TFilter('status', '=', 'Autorizado'));
        $crit12->add(new Adianti\Database\TFilter('subunidade', '=', 'G6'));
           
        $crit13 = new TCriteria();
        $crit13->add(new TFilter('status','=','Aguardando Autorização'));
        $crit13->add(new Adianti\Database\TFilter('subunidade', '=', 'G6'));
        
        $crit14 = new TCriteria();
        $crit14->add(new TFilter('status','=','Não Autorizado'));
        $crit14->add(new Adianti\Database\TFilter('subunidade', '=', 'G6'));

        $G6Autorizado = $repos->count($crit12);
        $G6AguardandoAutorizacao = $repos->count($crit13);
        $G6NaoAutorizado = $repos->count($crit14);
        
        $paG6 = ((100 * $G6Autorizado)/$totalRG6);
        $paaG6 = ((100 * $G6AguardandoAutorizacao)/$totalRG6);
        $pnaG6 = ((100*$G6NaoAutorizado)/$totalRG6);
        
        //CALCULO LEAVE G9
        $crit15 = new TCriteria();
        $crit15->add(new TFilter('status', '=', 'Autorizado'));
        $crit15->add(new Adianti\Database\TFilter('subunidade', '=', 'G9'));
           
        $crit16 = new TCriteria();
        $crit16->add(new TFilter('status','=','Aguardando Autorização'));
        $crit16->add(new Adianti\Database\TFilter('subunidade', '=', 'G9'));
        
        $crit17 = new TCriteria();
        $crit17->add(new TFilter('status','=','Não Autorizado'));
        $crit17->add(new Adianti\Database\TFilter('subunidade', '=', 'G9'));

        $G9Autorizado = $repos->count($crit15);
        $G9AguardandoAutorizacao = $repos->count($crit16);
        $G9NaoAutorizado = $repos->count($crit17);
        
        $paG9 = ((100 * $G9Autorizado)/$totalRG9);
        $paaG9 = ((100 * $G9AguardandoAutorizacao)/$totalRG9);
        $pnaG9 = ((100*$G9NaoAutorizado)/$totalRG9);
        
        //CALCULO LEAVE G10
        $crit18 = new TCriteria();
        $crit18->add(new TFilter('status', '=', 'Autorizado'));
        $crit18->add(new Adianti\Database\TFilter('subunidade', '=', 'G10'));
           
        $crit19 = new TCriteria();
        $crit19->add(new TFilter('status','=','Aguardando Autorização'));
        $crit19->add(new Adianti\Database\TFilter('subunidade', '=', 'G10'));
        
        $crit20 = new TCriteria();
        $crit20->add(new TFilter('status','=','Não Autorizado'));
        $crit20->add(new Adianti\Database\TFilter('subunidade', '=', 'G10'));

        $G10Autorizado = $repos->count($crit18);
        $G10AguardandoAutorizacao = $repos->count($crit19);
        $G10NaoAutorizado = $repos->count($crit20);
        
        $paG10 = ((100 * $G10Autorizado)/$totalRG10);
        $paaG10 = ((100 * $G10AguardandoAutorizacao)/$totalRG10);
        $pnaG10 = ((100*$G10NaoAutorizado)/$totalRG10);
     
       
     
?>

<div class="tform" align="center" style="border:1px solid #B7B7B7; width: 100%">

    <table style="border:1px solid #B7B7B7; width: 100%;">
        <span style="font-size: 32px; color:black;" ><b>G1 - SELVA</b></span>
        <tr class="tformtitle">
            <td> <label>Total de Militares  </label> </td>
            <td> <label><?php echo $totalG1;?></label> </td>
            <td> <label>PERCENTUAL  </label> </td>
        </tr>
        <tr class="tformtitle">
            <td> <label>Total de Leaves Registrados  </label> </td>
            <td> <label><?php echo $totalRG1;?></label> </td>
        </tr>
         <tr>
            <td> <label>Total de Militares Autorizados </label> </td>
            <td> <label><?php echo $G1Autorizado?></label> </td>
            <td> <label style="font-size: 24px; color:blue;"><?php echo 'Autorizados'.' '.round($paG1,2).' %'?></label> </td>
        </tr>
        <tr>
            <td> <label>Total de Militares Aguardando Autorização </label> </td>
            <td> <label><?php echo $G1AguardandoAutorizacao?></label> </td>
            <td> <label style="font-size: 24px; color:red;"><?php echo 'Aguardando Autorização'.' '.round($paaG1,2).' %'?></label> </td>
        </tr>
        <tr>
            <td> <label>Total de Militares Não Autorizados </label> </td>
            <td> <label><?php echo $G1NaoAutorizado?></label> </td>
            <td> <label style="font-size: 24px; color:green;"><?php echo 'Não Autorizado'.' '.round($pnaG1,2).' %'?></label> </td>
        </tr>
   
    </table>
</div>
<div class="tform" align="center" style="border:1px solid #B7B7B7; width: 100%">
    <table style="border:1px solid #B7B7B7; width: 100%;">
        <span style="font-size: 32px; color:black;" ><b>G2 - CORUJA</b></span>
        <tr class="tformtitle">
            <td> <label>Total de Militares  </label> </td>
            <td> <label><?php echo $totalG2;?></label> </td>
            <td> <label>PERCENTUAL  </label> </td>
        </tr>
    
          <tr class="tformtitle">
            <td> <label>Total de Leaves Registrados  </label> </td>
            <td> <label><?php echo $totalRG2;?></label> </td>
        </tr>
         <tr>
            <td> <label>Total de Militares Autorizados </label> </td>
            <td> <label><?php echo $G2Autorizado?></label> </td>
            <td> <label style="font-size: 24px; color:blue;"><?php echo 'Autorizados'.' '.round($paG2,2).' %'?></label> </td>
        </tr>
        <tr>
            <td> <label>Total de Militares Aguardando Autorização </label> </td>
            <td> <label><?php echo $G2AguardandoAutorizacao?></label> </td>
            <td> <label style="font-size: 24px; color:red;"><?php echo 'Aguardando Autorização'.' '.round($paaG2,2).' %'?></label> </td>
        </tr>
        <tr>
            <td> <label>Total de Militares Não Autorizados </label> </td>
            <td> <label><?php echo $G2NaoAutorizado?></label> </td>
            <td> <label style="font-size: 24px; color:green;"><?php echo 'Não Autorizado'.' '.round($pnaG2,2).' %'?></label> </td>
        </tr>
    </table>
</div>
<div class="tform" align="center" style="border:1px solid #B7B7B7; width: 100%">
    <table style="border:1px solid #B7B7B7; width: 100%;">
        <span style="font-size: 32px; color:black;" ><b>G3 - </b></span>
        <tr class="tformtitle">
            <td> <label>Total de Militares  </label> </td>
            <td> <label><?php echo $totalG3;?></label> </td>
            <td> <label>PERCENTUAL  </label> </td>
        </tr>
        <tr class="tformtitle">
            <td> <label>Total de Leaves Registrados  </label> </td>
            <td> <label><?php echo $totalRG3;?></label> </td>
        </tr>
         <tr>
            <td> <label>Total de Militares Autorizados </label> </td>
            <td> <label><?php echo $G3Autorizado?></label> </td>
            <td> <label style="font-size: 24px; color:blue;"><?php echo 'Autorizados'.' '.round($paG3,2).' %'?></label> </td>
        </tr>
        <tr>
            <td> <label>Total de Militares Aguardando Autorização </label> </td>
            <td> <label><?php echo $G3AguardandoAutorizacao?></label> </td>
            <td> <label style="font-size: 24px; color:red;"><?php echo 'Aguardando Autorização'.' '.round($paaG3,2).' %'?></label> </td>
        </tr>
        <tr>
            <td> <label>Total de Militares Não Autorizados </label> </td>
            <td> <label><?php echo $G3NaoAutorizado?></label> </td>
            <td> <label style="font-size: 24px; color:green;"><?php echo 'Não Autorizado'.' '.round($pnaG3,2).' %'?></label> </td>
        </tr>
    </table>
</div>
<div class="tform" align="center" style="border:1px solid #B7B7B7; width: 100%">
    <table style="border:1px solid #B7B7B7; width: 100%;">
        <span style="font-size: 32px; color:black;" ><b>G4 - GUARÁ </b></span>
        <tr class="tformtitle">
            <td> <label>Total de Militares  </label> </td>
            <td> <label><?php echo $totalG4;?></label> </td>
            <td> <label>PERCENTUAL  </label> </td>
        </tr>
          <tr class="tformtitle">
            <td> <label>Total de Leaves Registrados  </label> </td>
            <td> <label><?php echo $totalRG4;?></label> </td>
        </tr>
         <tr>
            <td> <label>Total de Militares Autorizados </label> </td>
            <td> <label><?php echo $G4Autorizado?></label> </td>
            <td> <label style="font-size: 24px; color:blue;"><?php echo 'Autorizados'.' '.round($paG4,2).' %'?></label> </td>
        </tr>
        <tr>
            <td> <label>Total de Militares Aguardando Autorização </label> </td>
            <td> <label><?php echo $G4AguardandoAutorizacao?></label> </td>
            <td> <label style="font-size: 24px; color:red;"><?php echo 'Aguardando Autorização'.' '.round($paaG4,2).' %'?></label> </td>
        </tr>
        <tr>
            <td> <label>Total de Militares Não Autorizados </label> </td>
            <td> <label><?php echo $G4NaoAutorizado?></label> </td>
            <td> <label style="font-size: 24px; color:green;"><?php echo 'Não Autorizado'.' '.round($pnaG4,2).' %'?></label> </td>
        </tr>
    </table>
</div>
<div class="tform" align="center" style="border:1px solid #B7B7B7; width: 100%">
    <table style="border:1px solid #B7B7B7; width: 100%;">
        <span style="font-size: 32px; color:black;" ><b>G6 -  </b></span>
        <tr class="tformtitle">
            <td> <label>Total de Militares  </label> </td>
            <td> <label><?php echo $totalG6;?></label> </td>
            <td> <label>PERCENTUAL  </label> </td>
        </tr>
          <tr class="tformtitle">
            <td> <label>Total de Leaves Registrados  </label> </td>
            <td> <label><?php echo $totalRG6;?></label> </td>
        </tr>
         <tr>
            <td> <label>Total de Militares Autorizados </label> </td>
            <td> <label><?php echo $G6Autorizado?></label> </td>
            <td> <label style="font-size: 24px; color:blue;"><?php echo 'Autorizados'.' '.round($paG6,2).' %'?></label> </td>
        </tr>
        <tr>
            <td> <label>Total de Militares Aguardando Autorização </label> </td>
            <td> <label><?php echo $G6AguardandoAutorizacao?></label> </td>
            <td> <label style="font-size: 24px; color:red;"><?php echo 'Aguardando Autorização'.' '.round($paaG6,2).' %'?></label> </td>
        </tr>
        <tr>
            <td> <label>Total de Militares Não Autorizados </label> </td>
            <td> <label><?php echo $G6NaoAutorizado?></label> </td>
            <td> <label style="font-size: 24px; color:green;"><?php echo 'Não Autorizado'.' '.round($pnaG6,2).' %'?></label> </td>
        </tr>
    </table>
</div>
<div class="tform" align="center" style="border:1px solid #B7B7B7; width: 100%">
    <table style="border:1px solid #B7B7B7; width: 100%;">
        <span style="font-size: 32px; color:black;" ><b>G9 - </b></span>
        <tr class="tformtitle">
            <td> <label>Total de Militares  </label> </td>
            <td> <label><?php echo $totalG9;?></label> </td>
            <td> <label>PERCENTUAL  </label> </td>
        </tr>
          <tr class="tformtitle">
            <td> <label>Total de Leaves Registrados  </label> </td>
            <td> <label><?php echo $totalRG9;?></label> </td>
        </tr>
         <tr>
            <td> <label>Total de Militares Autorizados </label> </td>
            <td> <label><?php echo $G9Autorizado?></label> </td>
            <td> <label style="font-size: 24px; color:blue;"><?php echo 'Autorizados'.' '.round($paG9,2).' %'?></label> </td>
        </tr>
        <tr>
            <td> <label>Total de Militares Aguardando Autorização </label> </td>
            <td> <label><?php echo $G9AguardandoAutorizacao?></label> </td>
            <td> <label style="font-size: 24px; color:red;"><?php echo 'Aguardando Autorização'.' '.round($paaG9,2).' %'?></label> </td>
        </tr>
        <tr>
            <td> <label>Total de Militares Não Autorizados </label> </td>
            <td> <label><?php echo $G9NaoAutorizado?></label> </td>
            <td> <label style="font-size: 24px; color:green;"><?php echo 'Não Autorizado'.' '.round($pnaG9,2).' %'?></label> </td>
        </tr>
    </table>
</div>
<div class="tform" align="center" style="border:1px solid #B7B7B7; width: 100%">
    <table style="border:1px solid #B7B7B7; width: 100%;">
        <span style="font-size: 32px; color:black;" ><b>G10 - </b></span>
        <tr class="tformtitle">
            <td> <label>Total de Militares  </label> </td>
            <td> <label><?php echo $totalG10;?></label> </td>
            <td> <label>PERCENTUAL  </label> </td>
        </tr>
          <tr class="tformtitle">
            <td> <label>Total de Leaves Registrados  </label> </td>
            <td> <label><?php echo $totalRG10;?></label> </td>
        </tr>
         <tr>
            <td> <label>Total de Militares Autorizados </label> </td>
            <td> <label><?php echo $G10Autorizado?></label> </td>
            <td> <label style="font-size: 24px; color:blue;"><?php echo 'Autorizados'.' '.round($paG10,2).' %'?></label> </td>
        </tr>
        <tr>
            <td> <label>Total de Militares Aguardando Autorização </label> </td>
            <td> <label><?php echo $G10AguardandoAutorizacao?></label> </td>
            <td> <label style="font-size: 24px; color:red;"><?php echo 'Aguardando Autorização'.' '.round($paaG10,2).' %'?></label> </td>
        </tr>
        <tr>
            <td> <label>Total de Militares Não Autorizados </label> </td>
            <td> <label><?php echo $G10NaoAutorizado?></label> </td>
            <td> <label style="font-size: 24px; color:green;"><?php echo 'Não Autorizado'.' '.round($pnaG10,2).' %'?></label> </td>
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
                