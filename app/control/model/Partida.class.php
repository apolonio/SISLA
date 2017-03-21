<?php


class Partida extends Adianti\Database\TRecord {
    
    const TABLENAME='system_partida';
    const PRIMARYKEY ='id';
    
    private $mil;
    
     public function get_mil()
    {
        if(empty($this->mil)){
            $this->mil = new Militar($this->nome);
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