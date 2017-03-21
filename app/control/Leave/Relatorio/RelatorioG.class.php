<?php

class RelatorioG extends TPage

{
 
    public function __construct()
    {
        parent::__construct();
        
          //  TPage::include_css('app/resources/quantitativo.css');
         
            try{
                
            TTransaction::open('fiscalizacao');
          
                $conn = TTransaction::get();

                          $categories = $conn->query("SELECT * FROM system_viajem where su = 'EM/Btl F Paz' ORDER BY guerra  ");

  ?> 
<div aling="center"><h2><font style="color:blue; size:36px;">  <b>SISLA -</b> CONTROLE DE DIAS</font></h2></div>
    <table border="2px" bgcolor="#CCC" style="border:1px solid #B7B7B7; width: 90%;"> 
             <thead align='center' bgcolor="#CCC" style="color: blue;">
            <td>P/G</td>
            <td>NOME</td>
            <td>SU</td>
            <td>FRAÇÃO</td>
            <td>INICIO</td>
            <td>TERMINO</td>
             <td>SITUACAO</td>
             <td>DESTINO</td>
             <td>DIAS</td>    
              
        </thead>
      
      
      <?php
            if ($categories)
            {
                $total=0;
                $dias =0;
                foreach ($categories as $category)
                {
                    if($category['su'] == 'EM/Btl F Paz'):
                     
                     $ida= $category['inicioLeave'];
                     $chegada= $category['terminoLeave'];
                     $diferenca = strtotime($chegada) - strtotime($ida);
                     $dias = round(( $diferenca / (60 * 60 * 24)) + 1); //
                     //$total = $dias++;
                 
                ?>
                  
                        <tr style="font-size:12px;">    
                             
                         <?php  echo '<td align="center" style="width: 50px;">'.$category['postograd'].'</td>'.
                                     '<td align="center" style="width: 200px;">'.$category['guerra'].'</td>'.
                                     '<td align="center" style="width: 50px;">'.$category['su'].'</td>'.
                                     '<td align="center" style="width: 50px;">'.$category['subunidade'].'</td>'.
                                     '<td align="center" style="width: 50px;">'.$category['ida'].'</td>'.
                                     '<td align="center" style="width: 50px;">'.$category['chegada'].'</td>'.
				     '<td align="center" style="width: 50px;">'.$category['situacao'].'</td>'.
				     '<td align="center" style="width: 50px;">'.$category['destino'].'</td>'.
                                     '<td align="center" style="width: 20px;">'.$dias.'</td>'; ?> 
                        </tr>                  
                 
                      <?php
                    endif;
                }
                  ?>   </table> <?php
               // echo " <h1>Olá <b>". $category->postograd ." - ". $category->guerra.". </b> O total de dias lançados no Sistema até o momento são <font style='color:red'> ".$total." </font>dias. </h1>";
            }
        
            TTransaction::close();
            
    } catch(Exception $e){
        new \Adianti\Widget\Dialog\TMessage('Algum erro plotado', $e->getMessage());
    }

    
    }
    
 }
