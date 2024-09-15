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
        // Pour mettre le form dans notre controller 
       if(Zend_Auth::getInstance()->hasIdentity()){
              $this->_redirect('index/index') ;
       }
       $request = $this->getRequest() ;
       $form = new Form_LoginForm() ;
       if($request->isPost()){
           if($form->isValid($this->_request->getPost())){
            $authAdapter = $this->getAuthAdapter() ;

            $username = $form->getValue('username') ;
            $password = $form->getValue('password') ;
    
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
                $this->view->errorMessage = 'Username or Password is incorect' ;
          }
              
           }
       }
       
       $this->view->form = $form ;
      

    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity() ;
        $this->_redirect('index/index') ;
    }


    private function getAuthAdapter() {
        $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter()) ;
        $authAdapter->setTableName('users')
                    ->setIdentityColumn('username')
                    ->setCredentialColumn('password') ;

        return $authAdapter ;
    }


}





