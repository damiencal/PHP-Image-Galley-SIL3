<?php

class GalleryModel
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
     * Return all images
     */
    public function getAllImages(){
        $sql = "SELECT * FROM image";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Return image from an ID
     */

    public function getImage($id){
        $id = strip_tags($id);

        $sql = "SELECT * FROM image WHERE id = :id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        return $query->fetchAll();
    }

     /**
      * Return random image
      */

    public function getRandomImage() {
        $id=rand(1,$this->count()-1);

        return $this->getImage($id);
    }

    /**
    * Return first image
    */
    public function getFirstImage() {
        return $this->getImage(1);
    }

    /**
     * Return last image
     */
    public function getLastImage() {

        $sql = "SELECT id FROM image ORDER BY id DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

	/**
     * Add a image to database
     * @param string $name Name
     * @param string $path Path
     * @param string $category Category
     * @param string $comment Comment
     */
    public function addImage($name, $path, $category, $comment) {
        $name = strip_tags($name);
        $path = strip_tags($path);
        $category = strip_tags($category);
        $comment = strip_tags($comment);

        $sql = "INSERT INTO image (name, path, category, comment) VALUES (:name, :path, :category, :comment)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':name' => $name, ':path' => $path, ':category' => $category, ':comment' => $comment));

        return $query->fetchAll();
    }

    /**
     * Update an image from database
     * @param string $name Name
     * @param string $path Path
     * @param string $category Category
     * @param string $comment Comment
     */
	public function updateImage($id, $category, $comment, $vote) {
        $id = strip_tags($id);
        $category = strip_tags($category);
        $comment = strip_tags($comment);
        $vote = strip_tags($vote);

        $sql = "UPDATE image SET category= :category, comment= :comment, vote= :vote WHERE id= :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':category' => $category, ':comment' => $comment, ':vote' => $vote, ':id' => $id);

        $query->execute($parameters);
    }

    /**
     * Delete an image from database
     * @param var $id ID
     */
    public function deleteImage($id){
        $id = strip_tags($id);

        $sql = "DELETE FROM image WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));

    }

}
