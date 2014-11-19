<?php

class AlbumModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
    * Return all albums
    */
    public function getAllAlbums(){
        $sql = "SELECT * FROM album";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    public function getAlbum($id){
        $id = $id;

        $sql = "SELECT * FROM album WHERE id = $id limit 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();


    }

    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    public function removeAlbum($id_album){
                $id = $id;

        $sql = "SELECT * FROM album WHERE id = $id limit 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();

    }

    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    public function emptyAlbum($id_album){
                $id = $id;

        $sql = "SELECT * FROM album WHERE id = $id limit 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();

    }

    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    public function addAlbum($id_album, $name, $description){
        $id = $id_album;
        $name = $name;
        $description = $description;


        $sql = "INSERT INTO album (id, name, description) VALUES(NULL,'".$name."','".$description."',$imgEnavant)";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();

    }

    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    public function addImageAlbum($id_image,$id_album){
                $id = $id;

        $sql = "SELECT * FROM album WHERE id = $id limit 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();

    }

    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    public function removeImageAlbum($id_image,$id_album){
                $id = $id;

        $sql = "SELECT * FROM album WHERE id = $id limit 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();

    }

    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    public function getImageByAlbum($album){
                $id = $id;

        $sql = "SELECT * FROM album WHERE id = $id limit 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();

    }

    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    public function getOtherAlbumImg($albumId){
                $id = $id;

        $sql = "SELECT * FROM album WHERE id = $id limit 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();

    }

    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    public function getIdsImgAlbum($idAlbum){
                $id = $id;



        $sql = "SELECT idImg FROM imgAlbum WHERE idAlbum='$idAlbum'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();

    }

    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    public function getIdsAlbumImg($idImg){
                $id = $id;

                			return $this->db->getIdAlbumImg("note",$idImg);


        $sql = "SELECT idAlbum FROM imgAlbum WHERE idImg='$idImg'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();

    }

    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    public function addAlbums(){
                $id = $id;

        $sql = "SELECT * FROM album WHERE id = $id limit 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();

    }

}



######################################
		/**
		 * Retourne un album La premiere image d'un Album
		 * @param $Albumid Entier identfiant de l'album'
		 */
		function getFirstImgTrie($album_id){
			return $this->db->requeteRechercheSimple("SELECT * FROM image WHERE id IN (SELECT image_id FROM appartient_album WHERE album_id=$album_id ) ORDER BY id  LIMIT 1 ","Image");
		}
		function getNextImgTrie($album_id,$img_id){
			return $this->db->requeteRechercheSimple("SELECT * FROM image WHERE id IN (SELECT image_id FROM appartient_album WHERE album_id=$album_id AND image_id>$img_id ) ORDER BY id  LIMIT 1 ","Image");
		}
		function getPrevImgTrie($album_id,$img_id){
			return $this->db->requeteRechercheSimple("SELECT * FROM image WHERE id IN (SELECT image_id FROM appartient_album WHERE album_id=$album_id AND image_id<$img_id ) ORDER BY id  LIMIT 1 ","Image");
		}
		function getLastAlbum() {
		return  $this->db->requeteRechercheSimple("SELECT * FROM album ORDER BY id DESC LIMIT 1","Album");
		}
		/**
		 * Supprime un album
		 */
		function removeAlbum($id_album){
			 $this->db->requeteSimple("DELETE FROM appartient_album WHERE album_id = $id_album");
			 $this->db->requeteSimple("DELETE FROM album WHERE id = $id_album");
		}
		/**
		 * Vide un album
		 */
		function emptyAlbum($id_album){
			$this->db->requeteSimple("UPDATE album set img_enavant_id=NULL WHERE id='$id_album'");
			$this->db->requeteSimple("DELETE FROM appartient_album WHERE album_id = $id_album");
		}
		function addAlbum($imgEnavant,$name,$description){
						 if ($imgEnavant==""){
						 	$imgEnavant="NULL";
						 }
			 $this->db->requeteSimple("INSERT into album (id,name,description,img_enavant_id) VALUES(NULL,'".$name."','".$description."',$imgEnavant)");
			 if ($imgEnavant!="NULL"){
			 	$this->addImageAlbum($imgEnavant, $this->getLastAlbum()->getId());
			 }
		}
		function addImageAlbum($id_image,$id_album){
			 $this->db->requeteSimple("INSERT into appartient_album (album_id,image_id) VALUES ('".$id_album."','".$id_image."')");
		}
		function removeImageAlbum($id_image,$id_album){
			 $this->db->requeteSimple("DELETE FROM appartient_album WHERE album_id = $id_album AND image_id =$id_image");
		}
		function getImages(){
			return $this->db->requeteRechercheAvancee("SELECT * FROM image","Image");
		}

		/**
		 * Retourne toutes les images d'un album'
		 */
		function getImageByAlbum($album){
			return $this->db->requeteRechercheAvancee("SELECT * FROM image  where id in (select image_id from appartient_album where album_id=".$album->id.")","Image");
		}
		function getOtherAlbumImg($albumId){
			return $this->db->requeteRechercheAvancee("SELECT * FROM image  WHERE id NOT IN (select image_id from appartient_album where album_id=".$albumId.")","Image");
		}
		/**
		 * Retourne toutes les id des images d'un album
		 */
		function getIdsImgAlbum($idAlbum){
			return $this->db->getIdImgAlbum("note",$idAlbum);
		}

		/**
		 * Retourne toutes les id des albums dont fait partie une image
		 */
		function getIdsAlbumImg($idImg){
			return $this->db->getIdAlbumImg("note",$idImg);
		}
