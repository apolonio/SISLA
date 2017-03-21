<?php


class Voo extends Adianti\Database\TRecord {
    
    const TABLENAME='system_voo';
    const PRIMARYKEY ='id';
    
    private $mil;
    
     public function get_mil()
    {
        if(empty($this->mil)){
            $this->mil = new Militar($this->idMilitar);
        }
        return $this->mil;
    }
     public function get_mil_nome()
    {
        if(empty($this->mil)){
            $this->mil = new Militar($this->nome);
        }
        return $this->mil;
    }
}
