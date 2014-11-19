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
	 * Permet de réaliser des requetes INSERT, DELETE et UPDATE
     * @param string $val Value
     * @param string $note Note
	 */
    public function requeteSimple($query) {
		$results = null;
		try {
			$sth = $this->db->exec($query);
			$results = $sth;

		} catch (PDOException $e) {
			die("Erreur : " . $e->getMessage());
		}
		return $results;
	}

	/**
	 * Permet de réaliser une requete SELECT qui retourne plusieurs resultats
     * @param string $val Value
     * @param string $note Note
	 */
    public function requeteRechercheAvancee($query,$classeName) {
		$results = null;
		try {
			$sth = $this->db->query($query,PDO :: FETCH_CLASS,$classeName);
			$results = $sth->fetchAll(PDO::FETCH_CLASS,$classeName);

		} catch (PDOException $e) {
			die("Erreur : " . $e->getMessage());
		}
		return $results;
	}

	/**
	 * Permet de réaliser une requete SELECT qui retourne un seul resultat
     * @param string $val Value
     * @param string $note Note
	 */
    public function requeteRechercheSimple($query,$classeName) {
		$result = null;
		try {
			$sth = $this->db->query($query,PDO :: FETCH_CLASS,$classeName);
			$result = $sth->fetch(PDO::FETCH_CLASS);
		} catch (PDOException $e) {
			die("Erreur : " . $e->getMessage());
		}
		return $result;

	}

	///////////////////////////////////////////RECHERCHE///////////////////////////////////////////////////
	/**
	 * Retourne un element à partir de son Id
     * @param string $val Value
     * @param string $note Note
	 */
	public function findById($classeName, $id) {
		return $this->requeteRechercheSimple("SELECT * FROM $classeName WHERE id = $id limit 1",$classeName);
	}

	/**
	 * Retourne le nombre d'éléments d'une table
     * @param string $val Value
     * @param string $note Note
	 */
	public function doCount($tableName,$where="") {
		$result = null;
		try {
			$sth = $this->db->query("SELECT count(*) FROM $tableName ".$where);
			$result = $sth->fetch();
			$result = $result[0];

		} catch (PDOException $e) {
			die("Erreur : " . $e->getMessage());

		}
			return $result;
	}


	/**
	 * Retourne toutes les categories existantes
     * @param string $val Value
     * @param string $note Note
	 */
	public function getCategories($classeName) {
		return $this->requeteRechercheAvancee("SELECT DISTINCT category FROM image ORDER BY category",$classeName);
	}

	/**
	 * Retourne les note à partir de l'id de son image
     * @param string $val Value
     * @param string $note Note
	 */
	public function getNoteByIdImg($classeName, $idImg) {
		return $this->requeteRechercheSimple("SELECT * FROM note WHERE idImg = $idImg limit 1",$classeName);
	}

	/**
	 * Retourne les id des images pour un idAlbum donné
     * @param string $val Value
     * @param string $note Note
	 */
	public function getIdImgAlbum($classeName,$idAlbum) {
		return $this->requeteRechercheAvancee("SELECT idImg FROM imgAlbum WHERE idAlbum='$idAlbum'",$classeName);
	}

	/**
	 * Retourne les id des albums pour un idImg donné
     * @param string $val Value
     * @param string $note Note
	 */
	public function getIdAlbumImg($classeName,$idImg) {
		return $this->requeteRechercheAvancee("SELECT idAlbum FROM imgAlbum WHERE idImg='$idImg'",$classeName);
	}

	///////////////////////////////////////////INSERTION///////////////////////////////////////////////////

	/**
	 * Permet l'insertion d'une image et de sa note, et retourne l'id de l'image
     * @param string $val Value
     * @param string $note Note
	 */
	public function insertImg($img) {
		$this->requeteSimple( "INSERT into image (path,category,comment) VALUES ('$img->path','$img->category','$img->comment')", "image");
		$id = $this->doCount("image");
		$this->requeteSimple("INSERT into note (positive,negative,idImg) VALUES (0,0,$id)");
		return $id;
	}

	/**
	 * Permet l'insertion d'une image et de sa note, et retourne l'id de l'image
     * @param string $val Value
     * @param string $note Note
	 */
	public function insertAlbum($album) {
		$this->requeteSimple( "INSERT into album (name) VALUES ('$album->name')", "album");
	}
	///////////////////////////////////////////UPDATE///////////////////////////////////////////////////

	/**
	 * Met à jour les informations d'une image
     * @param string $val Value
     * @param string $note Note
	 */
	public function updateImg($img) {
		$this->requeteSimple( "UPDATE image set path='$img->path',category='$img->category',comment='$img->comment' WHERE id='$img->id'");
	}

	/**
	 * Met à jour les notes d'une image
     * @param string $val Value
     * @param string $note Note
	 */
	public function updateNote($val, $note) {
		if($val=='POS'){
			$positive = $note->positive +1 ;
			$this->requeteSimple("UPDATE note set positive='$positive',negative='$note->negative',idImg='$note->idImg' WHERE id='$note->id'");
		}else{
			$negative = $note->negative +1 ;
			$this->requeteSimple("UPDATE note set positive='$note->positive',negative='$negative',idImg='$note->idImg' WHERE id='$note->id'");
		}
	}


    /**
     * Get all images from database
     */
    public function size()
    {
        $sql = "SELECT * FROM image";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getImage()
    {
        $sql = 'SELECT * FROM image WHERE id='.$imgId;
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }


    /**
     * Add a song to database
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     */
    public function addSong($artist, $track, $link)
    {
        // clean the input from javascript code for example
        $artist = strip_tags($artist);
        $track = strip_tags($track);
        $link = strip_tags($link);

        $sql = "INSERT INTO song (artist, track, link) VALUES (:artist, :track, :link)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':artist' => $artist, ':track' => $track, ':link' => $link));
    }

}
