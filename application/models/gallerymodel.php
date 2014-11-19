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

		/////////////////////////////////////////////////IMAGE////////////////////////////////////////////

		/**
		 * Returns all image IDs
		 */

    public function getImage($id){
        $sql = "SELECT * FROM image WHERE id = $id limit 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
        }

		/**
		 * Retourne une image au hasard
		 */
    public function getRandomImage() {
		      $id=rand(1,$this->count()-1);
		      return $this->getImage($id);
		}

		/**
		 * Retourne l'objet de la premiere image
		 */
		function getFirstImage() {
			return $this->getImage(1);
		}

		/**
		 * Retourne l'image suivante d'une image
		 */
		function getNextImage(image $img) {
			$id = $img->getId();
			if ($id < $this->count()) {
				$img = $this->getImage($id+1);
			}else{
				$img = $this->getImage(1);

			}
			return $img;
		}

		/**
		 * Retourne l'image précédente d'une image
		 */
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
		 */
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
		 */
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
		 * Ajouter une nouvelle image
		 */
		function createImg($img) {
			return $this->db->insertImg($img);
		}

		/**
		 * Met à jour une image
		 */
		function updateImg($img) {
			return $this->db->updateImg("image", $img);
		}

		/**
		 * Recupere toutes les categories d'image en base
		 */
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
		 */
		function getNbImageCategory($category) {
			return $this->db->doCount("image","WHERE category = '$category'");
		}
		function getLastImage() {
		return requeteRechercheSimple("SELECT id FROM image ORDER BY id DESC LIMIT 1","Image");
		}
		/**
		 * Supprime une image
		 */
		function removeImage($id_image){
			 $this->db->requeteSimple("DELETE FROM image WHERE id = $id_image");
		}


}
