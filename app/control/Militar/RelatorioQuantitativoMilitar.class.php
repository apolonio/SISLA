<?php

/**
 * Description of RelatorioQuantitativo
 *
 * @author junio
 */
class RelatorioQuantitativoMilitar extends TPage{
    
    function __construct()
    {
        parent::__construct();
        
        ini_set( 'display_errors', 0 );
    
        //Acesso tabela para contar o total
           
        TTransaction::open('fiscalizacao');  

        $repos = new TRepository('Militar');
      //  $total = $repos->count();

        //Contagem Militares 2 Cia
        $crit = new TCriteria();
        $crit->add(new Adianti\Database\TFilter('su', '=', '2ª Cia Fuz'));
        //Contagem Militares 1 Cia
        $crit1 = new TCriteria();
        $crit1->add(new Adianti\Database\TFilter('su', '=', '1ª Cia Fuz'));
        
        $crit2 = new TCriteria();
        $crit2->add(new Adianti\Database\TFilter('su', '=', 'CCAp/Btl F Paz'));
        
        $crit3 = new TCriteria();
        $crit3->add(new Adianti\Database\TFilter('su', '=', 'Esqd C Mec'));
       
        $crit4 = new TCriteria();
        $crit4->add(new Adianti\Database\TFilter('su', '=', 'EM/Btl F Paz'));
        
         $contagem2cia = $repos->count($crit);
         $contagem1cia = $repos->count($crit1);
         $contagemccap = $repos->count($crit2);
         $contagemesqd = $repos->count($crit3);
         $contagemem = $repos->count($crit4);
        ?>
        <div class="tform" align="center" style="border:3px solid #008749; width: 100%">
            <table style="border:3px solid; width: 100%;">
                <span style="font-size: 32px; color:black;" ><b>RELATÓRIO DE MILITARES SU<span>
                <tr class="tform">

                    <td> <label style="font-size: 24px; color:blue;"><?php echo 'EM/Btl F PazEM: '.' ------'.$contagemem?></label> </td>
                 </tr>
                  <tr class="tform">
                    <td> <label style="font-size: 24px; color:red;"><?php echo 'Esqd C Mec: '.'-----------'.$contagemesqd?></label> </td>
                  </tr>  
                <tr class="tform">
                    <td> <label style="font-size: 24px; color:indigo;"><?php echo 'CCAp/Btl F Paz: '.' ------'.$contagemccap?></label> </td>
                </tr>
                <tr class="tform">
                    <td> <label style="font-size: 24px; color:#f71752;"><?php echo '1ª Cia Fuz: '.' -------------'.$contagem1cia?></label> </td>
                </tr>
                <tr class="tform">
                    <td> <label style="font-size: 24px; color:green;"><?php echo '2ª Cia Fuz: '.'-------------'.$contagem2cia?></label> </td>
                </tr>
                <tr class="tform">
                    <td> <label style="font-size: 24px;"><?php echo 'TOTAL'.'------------------ '.($contagem2cia+$contagem1cia+$contagemccap+$contagemesqd+$contagemem)?></label> </td>
                </tr>

            </table>
        </div>





        <?php
    }
}