<?php
/**
 * Description of ImagenPost
 * Esta clase guarda temporalmente el id de un post, el titulo y la imagen adjunta al post
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class ImagenPost {
    private $id;
    private $titulo;
    private $imagen;
    
    public function __construct($id,$titulo,$imagen) {
        $this->id=$id;
        $this->titulo = $titulo;
        $this->imagen = $imagen;
    }   
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }
        
    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getImagen() {
        return $this->imagen;
    }


}

?>
