<?php

class Model
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
		 * Return image from an ID
		 */

    public function getAmountOfImages() {

        $sql = "SELECT COUNT(id) AS amount_of_images FROM image";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetch()->amount_of_images;
    }

    public function getCategories() {

        $sql = "SELECT DISTINCT category FROM image ORDER BY category";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetchAll();
    }



//
//	/**
//	 * Retourne les id des images pour un idAlbum donné
//	 */
//	function getIdImgAlbum($classeName,$idAlbum) {
//		return $this->requeteRechercheAvancee("SELECT idImg FROM imgAlbum WHERE idAlbum='$idAlbum'",$classeName);
//	}


}
