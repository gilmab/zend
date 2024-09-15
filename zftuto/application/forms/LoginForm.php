<?php 

class Form_loginForm extends Zend_Form {

    public function __construct($option = null) {
            parent::__construct($option) ;

            //une fois n
            $this->setName('login') ;
            //Ici nous créons les champs 
            $username = new Zend_Form_Element_Text('username') ;
            //Ici on ajoute un label et on va le dire que c'est obligatoire 
            $username->setLabel('User name:')
                     ->setRequired() ;
                      
            $password = new Zend_Form_Element_Password('password') ;
            $password->setLabel('Password:')
                      ->setRequired(true) ;

            $login = new Zend_Form_Element_Submit('login');
            $login->setLabel('Login') ;

            $this->addElements( array($username, $password, $login)) ;
            $this->setMethod('post') ;
            $this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl().'/authenticate/login') ;

    }

}