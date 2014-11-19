<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Gallery extends Controller
{
    /**
     * PAGE: gallery
     * This method handles what happens when you move to http://yourproject/gallery/index
     */
    public function index()
    {

		# Retourne une image au hazard
		function getRandomImage() {
			return $this->getImage(rand(1,$this->size()));
		}

		# Retourne l'objet de la premiere image
		function getFirstImage() {
			return $this->getImage(1);
		}

		# Retourne l'image suivante d'une image
		function getNextImage(image $img) {
			$id = $img->getId();
			if ($id < $this->size()) {
				$img = $this->getImage($id+1);
			}
			return $img;
		}

		# Retourne l'image précédente d'une image
		function getPrevImage(image $img) {
			$id = $img->getId();
			if ($id > 1) {
				$img = $this->getImage($id-1);
			}
			return $img;
		}

		# saute en avant ou en arrière de $nb images
		# Retourne la nouvelle image
		function jumpToImage(image $img, $nb) {
			$id = $img->getId();
			if (($id+$nb) > 0 && ($id+$nb) < $this->size()) {
				$img = $this->getImage($id+$nb);
			}
			return $img;
		}

		# Retourne la liste des images consécutives à partir d'une image
		function getImageList(image $img, $nb) {
			# Verifie que le nombre d'image est non nul
			if (!$nb > 0) {
				debug_print_backtrace();
				trigger_error("Erreur dans ImageDAO.getImageList: nombre d'images nul");
			}
			$id = $img->getId();
			$max = $id+$nb;
			while ($id < $this->size() && $id < $max) {
				$res[] = $this->getImage($id);
				$id++;
			}
			return $res;
		}
        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/_templates/header.php';
        require 'application/views/gallery/index.php';
        require 'application/views/_templates/footer.php';
    }
}
