<?php

class AuthenticateController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
        $authAdapter = $this->getAuthAdapter() ;

        $username = 'john' ;
        $password = 'pass1' ;

        $authAdapter->setIdentity($username)
                    ->setCredential($password) ;

        $auth = Zend_Auth::getInstance() ;
      $result =  $auth->authenticate($authAdapter) ;

      if($result->isValid()){
        //on prend les information de colonne de la base de donnée et on 
        $identity = $authAdapter->getResultRowObject() ;
       //on le stocke dans une donné persistante
        $authStorage =  $auth->getStorage() ;
        $authStorage->write($identity) ;

        //une fois les informations enregistrer on redirige l'utilisateur vers une autre page 
        $this->_redirect('index/index') ;
             
      }else{
            echo 'is not valid' ;
      }

    }

    public function logoutAction()
    {
        // action body
    }

    private function getAuthAdapter() {
        $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter()) ;
        $authAdapter->setTableName('users')
                    ->setIdentityColumn('username')
                    ->setCredentialColumn('password') ;

        return $authAdapter ;
    }


}





