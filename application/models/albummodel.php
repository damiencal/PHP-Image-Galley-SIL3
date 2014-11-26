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
    public function removeAlbum($id){
        $id = $id;

        $sql = "DELETE FROM album WHERE id = $id_album";
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

        $sql = "DELETE FROM appartient_album WHERE album_id = $id_album";
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

        $sql = "INSERT into appartient_album (album_id,image_id) VALUES ('".$id_album."','".$id_image."')";
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

        $sql = "ELETE FROM appartient_album WHERE album_id = $id_album AND image_id =";
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

        $sql = "SELECT * FROM image  where id in (select image_id from appartient_album where album_id=";
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

        $sql = "SELECT * FROM image  WHERE id NOT IN (select image_id from appartient_album where album_id=".$albumId."";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();

    }

    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    public function getIdsImgAlbum($id){
        $id = $id;

        $sql = "SELECT id FROM imgAlbum WHERE id= :id'";
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

        $sql = "SELECT idAlbum FROM imgAlbum WHERE idImg='$idImg'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();

    }


    /**
     * Get a album image id
     * @param string $idImg Image ID
     */
	function getIdAlbumImg($idImg) {
        $idImg = $idImg;

        $sql = "SELECT idAlbum FROM imgAlbum WHERE idImg=:idImg";
        $query = $this->db->prepare($sql);
        $parameters = array(':idImg' => $idImg);

        $query->execute($parameters);
	}



    /**
     * Add a album to database
     * @param string $name Name
     */
	function insertAlbum($album) {
        $name = strip_tags($name);

        $sql = "INSERT INTO album (name) VALUES (:name)";
        $query = $this->db->prepare($sql);
        $parameters = array(':name' => $name);

        $query->execute($parameters);
	}


}
