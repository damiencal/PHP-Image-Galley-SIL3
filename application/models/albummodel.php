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
     *
     */
    public function getAlbum($id_album){
        $id = strip_tags($id_album);

        $sql = "SELECT * FROM album WHERE id = :id limit 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        return $query->fetchAll();


    }

    /**

     */
    public function removeAlbum($id_album){
        $id = strip_tags($id_album);

        $sql = "DELETE FROM album WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

    }

    /**

     */
    public function emptyAlbum($id_album){
        $id = strip_tags($id_album);

        $sql = "DELETE FROM appartient_album WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

    }

    /**

     */
    public function addAlbum($name, $description){
        $name = strip_tags($name);
        $description = strip_tags($description);


        $sql = "INSERT INTO album (id, name, description) VALUES(NULL, :name, :description)";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':name' => $name, ':description' => $description);

        $query->execute($parameters);

        return $query->fetchAll();

    }

    /**

     */
    public function addImageAlbum($id_image,$id_album){
        $id_image = strip_tags($id_image);
        $id_album = strip_tags($id_album);

        $sql = "INSERT into appartient_album (album_id,image_id) VALUES (:album_id, :id_image)";
        $query = $this->db->prepare($sql);
        $parameters = array(':album_id' => $album_id, ':id_image' => $id_image);

        $query->execute($parameters);

        return $query->fetchAll();

    }

    /**

     */
    public function removeImageAlbum($album_id,$image_id){
        $album_id = strip_tags($album_id);
        $image_id = strip_tags($image_id);

        $sql = "ELETE FROM partof_album WHERE album_id = :album_id AND image_id = :image_id";
        $query = $this->db->prepare($sql);
         $parameters = array(':album_id' => $album_id, ':image_id' => $image_id);

        $query->execute($parameters);


    }

    /**

     */
    public function getImageByAlbum($album_id, $image_id){
        $album_id = strip_tags($album_id);
        $image_id = strip_tags($image_id);

        $sql = "SELECT * FROM image  where id in (select :image_id from partof_album where album_id= :album_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':image_id' => $image_id, ':album_id' => $album_id);

        $query->execute($parameters);

        return $query->fetchAll();

    }

    /**

     */
    public function getOtherAlbumImg($albumId){
        $album_id = strip_tags($albumId);

        $sql = "SELECT * FROM image  WHERE id NOT IN (select image_id from partof_album where album_id= :album_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':album_id' => $album_id);

        $query->execute($parameters);

        return $query->fetchAll();

    }

    /**

     */
    public function getIdsImgAlbum($id){
        $id = strip_tags($id);

        $sql = "SELECT id FROM imgAlbum WHERE id= :id'";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        return $query->fetchAll();

    }

    /**

     */
    public function getIdsAlbumImg($id){
        $id = strip_tags($id);

        $sql = "SELECT idAlbum FROM imgAlbum WHERE id= :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        return $query->fetchAll();

    }


    /**
     * Get a album image id
     * @param string $idImg Image ID
     */
	function getIdAlbumImg($id) {
        $id = strip_tags($id);

        $sql = "SELECT idAlbum FROM imgAlbum WHERE id=:id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        return $query->fetchAll();
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
