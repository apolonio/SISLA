<?php
/** 
 * Teste
 * @copyright (c) 2016, Apolonio S. S. Junior ICRIACOES Sistemas Web!s - 2ºSgt Santiago
 * @email apolocomputacao@gmail.com
 */
class WelcomeView extends TPage
{
    /**
     * Class constructor
     * Creates the page
     */
    function __construct()
    {
        parent::__construct();
        
        TPage::include_css('app/resources/styles.css');
        $html1 = new THtmlRenderer('app/resources/welcome.html');
        $html2 = new THtmlRenderer('app/resources/bemvindo.html');

        // replace the main section variables
        $html1->enableSection('main', array());
        $html2->enableSection('main', array());
        
        $panel1 = new TPanelGroup('Welcome!');
        $panel1->add($html1);
        
        $panel2 = new TPanelGroup('Bem-vindo!');
        $panel2->add($html2);
        
        // add the template to the page
        parent::add( TVBox::pack($panel1, $panel2) );
    }
}
