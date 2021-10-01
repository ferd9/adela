<?php

/** proyect adela
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    public $name;
    public $id;
    private $model;
    private $idAlbmPerfil=-1;
    
    
    public function __construct($username,$password,$esregistro=false)
	{
            //$this->model = new Usuario();            
            $this->model = Usuario::model()->find("email = '".$username."'");
            if($this->model != null)
            {                
                if($this->model->verifyPassword($password))
                {                                                
                    $this->username = $username;
                    $this->setReferData($this->model->idusuario,$this->model->nombre." ".$this->model->apellidos);

                    if($esregistro)
                    {
                        $alb = new Album();
                        $this->idAlbmPerfil=$alb->albumImagnesPerfil($this->model->idusuario);
                        $this->setIdAlbumCookie($this->idAlbmPerfil);
                        $lf = Bitacora::model()->find('idusuario='.$this->model->idusuario." order by fecha desc");
                        $bitacora = new Bitacora();
                        if($lf != null)
                            $bitacora->setUserFecha($this->model->idusuario, $lf->fecha);
                        else
                            $bitacora->setUserFecha($this->model->idusuario, time());
                        
                        if($bitacora->validate())
                            $bitacora->save(); 
                    } 
                    $this->errorCode = self::ERROR_NONE;
                }else
                    $this->errorCode = self::ERROR_PASSWORD_INVALID; 
            }else{
                $this->errorCode = self::ERROR_USERNAME_INVALID; 
            }             
	}
	
	public function authenticate()
	{
		return !$this->errorCode;
	}
        
        /* public function isRegister()
        {
            $this->esRegister = true;
        }*/
        //establece id y name del webuser
        private function setReferData($uid,$name)
        {
            $this->id=$uid; 
            //$this->name = array();            
            $this->name = $name;
            
        }
        
        public function getId()
	{
		return $this->id;
	}        
       
        public function getName()
        {
            return $this->name;
        }
        
        private function setIdAlbumCookie($idalbum)
        {
            Cookie::set('idalbum', $idalbum);
        }
        
}