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

	}

    /**
     * Update an image from database
     * @param string $path Path
     * @param string $category Category
     * @param string $comment Comment
     */
	public function updateImage($id, $name, $path, $category, $comment) {
        $id = strip_tags($id);
        $name = strip_tags($name);
        $path = strip_tags($path);
        $category = strip_tags($category);
        $comment = strip_tags($comment);

        $sql = "UPDATE image SET name= :name, path= :path, category= :category, comment= :comment WHERE id= :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':name' => $name, ':path' => $path, ':category' => $category, ':comment' => $comment, ':id' => $id);

        $query->execute($parameters);
    }

    /**
     * Delete an image from database
     * @param string $path Path
     * @param string $category Category
     * @param string $comment Comment
     */
    public function deleteImage($id){
        $id = strip_tags($id);

        $sql = "DELETE FROM image WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));


		}

}




###############


		/**
		 * Retourne l'image précédente d'une image

		function getPrevImage(image $img) {
			$id = $img->getId();
			if ($id > 1) {
				$img = $this->getImage($id-1);
			}else{
				$img = $this->getImage($this->count());

			}
			return $img;
		}

		/**
		 * saute en avant ou en arrière de $nb images
		 * Retourne la nouvelle image

		function jumpToImage(image $img,$nb) {
			    $id = $img->getId() + $nb;
			    if($id<=0){
			    }else if($id>=$this->count()){
			    }else{
			      $img = $this->getImage($id);
			    }
			    return $img;
			  }

		/**
		 * Retourne la liste des images consécutives à partir d'une image

		function getImageList(image $img,$nb) {
			# Verifie que le nombre d'image est non nul
			if (!$nb > 0) {
				debug_print_backtrace();
				trigger_error("Erreur dans ImageDAO.getImageList: nombre d'images nul");
			}
			$id = $img->getId();
			$max = $id+$nb;
			$res = array();
			while ($id < $this->count() && $id < $max) {
				$res[] = $this->getImage($id);
				$id++;
			}
			return $res;
		}



		/**
		 * Recupere toutes les categories d'image en base

		function getCategories() {
			$categories = array();
			$tab = $this->db->getCategories("image");
			foreach($tab as $cat=>$val){
				$categories[] = $val->getCategory();
			}
			return $categories;
		}

		/**
		 * Recupere le nombre d'image pour une categorie donné

		function getNbImageCategory($category) {
			return $this->db->doCount("image","WHERE category = '$category'");
		}
 */
