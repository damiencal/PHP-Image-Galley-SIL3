<?php

/**
 * Class Album
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Album extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/album/index (which is the default page)
     */
    public function index()
    {
        // load a model, perform an action, pass the returned data to a variable
        $album_model = $this->loadModel('AlbumModel');
        $albums = $album_model->getAllAlbums();

        // load views.
        require 'application/views/_templates/header.php';
        require 'application/views/album/index.php';
        require 'application/views/_templates/footer.php';
    }
    /**
     * ACTION: addAlbum
     * This method handles what happens when you move to http://yourproject/albums/addalbum
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a album" form on album/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to album/index via the last line: header(...)
     */
    public function addAlbum()
    {
        // if we have POST data to create a new Album
        if (isset($_POST["submit_add_album"])) {
            // load model, perform an action on the model
            $album_model = $this->loadModel('AlbumModel');
            $album_model->addAlbum($_POST["id"], $_POST["name"]);
        }

        // where to go after album has been added
        header('location: ' . URL . 'album/index');
    }

    /**
     * ACTION: deleteAlbum
     * This method handles what happens when you move to http://yourproject/album/deletealbum
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "delete a album" button on album/index
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to album/index via the last line: header(...)
     * @param int $album_id
     */
    public function deleteAlbum($id)
    {

        // if we have an id of a album that should be deleted
        if (isset($id)) {
            // load model, perform an action on the model
            $album_model = $this->loadModel('AlbumModel');
            $album_model->deleteAlbum($id);
        }

        // where to go after album has been deleted
        header('location: ' . URL . 'album/index');
    }

}


		/**
		 * Recupere les parametres de manière globale
		 * Pour toutes les actions de ce contrôleur
		 */
/*
 function getParam() {
			// Recupère un éventuel no de départ
		global $imgId,$size,$nbImg,$albumId,$data;
			if (isset($_GET["imgId"]) && $_GET["imgId"]!="" && $_GET["imgId"]>0) {
				$imgId = $_GET["imgId"];
			} else {
				$imgId = 1;
			}

			if (isset($_GET["albumId"]) && $_GET["albumId"]!="" && $_GET["albumId"]>0) {
				$albumId = $_GET["albumId"];
			} else {
				$albumId = 1;
			}
			$data = new data();

		}

		//////////////////////////// LISTE DES ACTIONS DE CE CONTROLEUR/////////////////////////


		 * Action page index(par défaut)

			global $imgId,$size,$data,$nbImg;
			$this->getParam();
			$data->albums = $this->imageDAO->getAlbums();
			$data->cssfiles = array("gallery.css");
			$data->content = "viewGallery.php";
			$data->images = $this->getImageDAO()->getImages();



			// Selectionne et charge la vue
			require_once("view/mainView.php");


	function afficher(){
		global $imgId,$size,$data,$nbImg,$albumId;
		$this->getParam();
		$data->album = $this->getImageDAO()->getAlbum($albumId);
		$data->cssfiles = array("gallery.css");
		$data->content = "viewGalleryImages.php";
		$data->otherImages = $this->getImageDAO()->getOtherAlbumImg($albumId);
		require_once("view/mainView.php");

	}
	function removeAlbum(){
		global $data,$albumId;
		$this->getParam();
		$this->getImageDAO()->removeAlbum($albumId);
		$this->index();
	}
	function removeImage(){
		global $imgId,$data,$albumId;
		$this->getParam();
		$this->getImageDAO()->removeImageAlbum($imgId,$albumId);
		$this->afficher();
	}
	function emptyAlbum(){
		global $data,$albumId;
		$this->getParam();
		$this->getImageDAO()->emptyAlbum($albumId);
		$this->afficher();
	}
	function addImage(){
		global $data,$albumId;
		$imgId = $_POST['imageAdd'];

		$this->getParam();
		$this->getImageDAO()->addImageAlbum($imgId,$albumId);
		$this->afficher();
	}
	function addAlbum(){
		global $data,$albumId;
		$imgEnavant = $_POST['id_imageEnAvant'];
		$name = $_POST['name'];
		$description = $_POST['description'];

		$this->getParam();
		$this->getImageDAO()->addAlbum($imgEnavant,$name,$description);
		$this->index();
	}	/**
	* return ImageDAO

	function getImageDAO(){
			return $this->imageDAO;
	}
*/
