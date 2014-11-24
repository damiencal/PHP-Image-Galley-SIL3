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










    /**
	 * Retourne un element à partir de son Id
	 */
	function findById($classeName, $id) {
		return $this->requeteRechercheSimple("SELECT * FROM $classeName WHERE id = $id limit 1",$classeName);
	}

//	/**
//	 * Retourne le nombre d'éléments d'une table
//	 */
//	function doCount($tableName,$where="") {
//		$result = null;
//		try {
//			$sth = $this->db->query("SELECT count(*) FROM $tableName ".$where);
//			$result = $sth->fetch();
//			$result = $result[0];
//
//			return $result;
//	}

//
//	/**
//	 * Retourne toutes les categories existantes
//	 */
//	function getCategories($classeName) {
//		return $this->requeteRechercheAvancee("SELECT DISTINCT category FROM image ORDER BY category",$classeName);
//	}
//
//
//
//	/**
//	 * Retourne les id des images pour un idAlbum donné
//	 */
//	function getIdImgAlbum($classeName,$idAlbum) {
//		return $this->requeteRechercheAvancee("SELECT idImg FROM imgAlbum WHERE idAlbum='$idAlbum'",$classeName);
//	}


}
