<?php

class Dias extends TPage
{
 
    public function __construct()
    {
        parent::__construct();
        
            TPage::include_css('app/resources/quantitativo.css');
         
            try{
                
            TTransaction::open('fiscalizacao');
            
            $repository = new TRepository('Viajem');
            
            // CAPTURANDO USUARIO
            $user= SystemUser::newFromLogin(TSession::getValue('login'));
            
            $criteria = new TCriteria;
            
            //$order    = isset($param['order']) ? $param['order'] : 'ida';
           // $criteria->setProperty('order', $order);
            $criteria->add(new TFilter('nome','=',$user->name));
            $categories = $repository->load($criteria);
           // $this->datagrid->clear();

            if ($categories)
            {
                $total=0;
                $dias =0;
                foreach ($categories as $category)
                {
                     $category->inicioLeave.'<br>';
                     $category->terminoLeave.'<br>';
                     $ida= $category->inicioLeave;
                     $chegada= $category->terminoLeave;
                     
                     $diferenca = strtotime($chegada) - strtotime($ida);
                     
                     $dias = round(( $diferenca / (60 * 60 * 24)) + 1); //
                   
                   
                   $total = $total + $dias;
                   
                    //$total.'<br>';
                }
                echo " <h2>Olá <b>". $category->postograd ." - ". $category->guerra.". </b> O total de dias lançados no Sistema até o momento são <font style='color:red'> ".$total."dias. </h2>";
            }
        
            TTransaction::close();
            
    } catch(Exception $e){
        new \Adianti\Widget\Dialog\TMessage('Algum erro plotado', $e->getMessage());
    }

    
    }
    
 }
