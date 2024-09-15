<?php 

class Model_LibraryAcl extends Zend_Acl {
    public function __construct(){
        $this->add(new Zend_Acl_Resource('book')) ;
        //tout ce qui est effectuer dans book est disponible dans le edit 
        $this->add(new Zend_Acl_Resource('edit'), 'book') ;
        $this->add(new Zend_Acl_Resource('add'), 'book') ;

        $this->add(new Zend_Acl_Resource('books')) ;
        $this->add(new Zend_Acl_Resource('list'), 'books') ;

        //A partir de cette ligne je defini qui peut avoir acces a ces ressources 

        $this->addRole(new Zend_Acl_Role('user')) ;
        //Ici on dit admin qui herite de user 
        $this->addRole(new Zend_Acl_Role('admin'),'user') ;

            // Ici je defini qui a accès à quoi 
            // Pour permettre a ce que ces droits soit disponible dans toute l'application il faut créer un plugin 
        $this->allow('user', 'books', 'list') ;
        $this->allow('admin', 'book', 'edit') ;
        $this->allow('admin', 'book', 'add') ;
    }
}