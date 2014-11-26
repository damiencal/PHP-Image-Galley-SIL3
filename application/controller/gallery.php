<?php

/**
 * Class Gallery
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
    public function index($id)
    {
        // load a model, perform an action, pass the returned data to a variable
        $gallery_model = $this->loadModel('Model');
        $amount_of_images = $gallery_model->getAmountOfImages();
        $categories = $gallery_model->getCategories();



        // load a model, perform an action, pass the returned data to a variable
        $gallery_model = $this->loadModel('GalleryModel');

        if (isset($id)) {
            $image = $gallery_model->getImage($id);
        } else {
            $id =2;
            $image = $gallery_model->getImage($id);
               }

        // load a model, perform an action, pass the returned data to a variable
        $images = $gallery_model->getAllImages();

        // load views. within the views we can echo out $songs and $amount_of_songs easily
        require 'application/views/_templates/header.php';
        require 'application/views/gallery/index.php';
        require 'application/views/_templates/footer.php';
    }

    /**
     * ACTION: getImage
     * This method handles what happens when you move to http://yourproject/gallery/getimage
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a album" form on album/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to album/index via the last line: header(...)
     */
    public function getImage($id)
    {

        // redirect after image has been added
        header('location: ' . URL . 'gallery/index');
    }


    /**
     * ACTION: addImage
     * This method handles what happens when you move to http://yourproject/gallery/addimage
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a album" form on album/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to album/index via the last line: header(...)
     */
    public function addImage()
    {
        // if we have POST data to create a new Album
        if (isset($_POST["submit_add_image"])) {
            // load model, perform an action on the model
            $image_model = $this->loadModel('GalleryModel');
            $image_model->addImage($_POST["name"], $_POST["path"], $_POST["category"]);
        }

        // redirect after image has been added
        header('location: ' . URL . 'gallery/index');
    }

    /**
     * ACTION: updateImage
     * This method handles what happens when you move to http://yourproject/gallery/updateimage/*
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a album" form on album/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to album/index via the last line: header(...)
     */
    public function updateImage()
    {
        // if we have POST data to update an image
        if (isset($_POST["submit_update_image"])) {
            // load model, perform an action on the model
            $image_model = $this->loadModel('GalleryModel');
            $image_model->updateImage($_POST["id"], $_POST["category"], $_POST["comment"], $_POST["vote"]);
        }

        // redirect after image has been added
        header('location: ' . URL . 'gallery/index');
    }

    /**
     * ACTION: deleteImage
     * This method handles what happens when you move to http://yourproject/gallery/deleteimage/*
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a album" form on album/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to album/index via the last line: header(...)
     */
    public function deleteImage($id)
    {
        $id = $id;
        // load model, perform an action on the model
        $image_model = $this->loadModel('GalleryModel');
        $image_model->deleteImage($id);

        // redirect after image has been added
        header('location: ' . URL . 'gallery/index');
    }

    /**
     * ACTION: deleteImage
     * This method handles what happens when you move to http://yourproject/gallery/deleteimage/*
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a album" form on album/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to album/index via the last line: header(...)
     */
    public function getRandomImage()
    {
        $id = rand(1, 9);

        // load model, perform an action on the model
        $gallery_model = $this->loadModel('GalleryModel');
        $image = $gallery_model->getImage($id);

        // redirect after image has been added
        header('location: ' . URL . 'gallery/index/'. $image[0]->id);
    }


}


//
//
//		# Retourne l'image suivante d'une image
//		function getNextImage(image $img) {
//			$id = $img->getId();
//			if ($id < $this->size()) {
//				$img = $this->getImage($id+1);
//			}
//			return $img;
//		}
//
//
//
//
//		function uploadImg() {
//			$allowedExts = array("jpg", "jpeg", "gif", "png", "bmp");
//			$extension = end(explode(".", $_FILES["file"]["name"]));
//			if ((($_FILES["file"]["type"] == "image/gif")
//					|| ($_FILES["file"]["type"] == "image/jpeg")
//					|| ($_FILES["file"]["type"] == "image/png")
//					|| ($_FILES["file"]["type"] == "image/pjpeg")
//					|| ($_FILES["file"]["type"] == "image/bmp"))
//					&& ($_FILES["file"]["size"] < 2000000)
//					&& in_array($extension, $allowedExts))
//			{
//				if ($_FILES["file"]["error"] > 0)
//				{
//					$success=2;
//					$location = "Location: index.php?controller=uploadFile&action=index&success=$success";
//					header($location);
//				}
//				else
//				{
//					$urlPath = '../'.$this->getImageDAO()->getPath()."/jons/upload/";
//					if (file_exists($urlPath.$_FILES["file"]["name"]))
//					{
//						$success=1;
//						$location = "Location: index.php?controller=uploadFile&action=index&success=$success";
//						header($location);
//					}
//					else
//					{
//						if (!is_dir($urlPath)) {
//							if(!mkdir($urlPath, 0755, true)) {
//								$success=4;
//								$location = "Location: index.php?controller=uploadFile&action=index&success=$success";
//								header($location);
//							}
//						}
//						move_uploaded_file($_FILES["file"]["tmp_name"],
//								$urlPath.$_FILES["file"]["name"]);
//						$img = new Image();
//						$img->setPath("jons/upload/" . $_FILES["file"]["name"]);
//						if (!isset($_POST["category2"]) || $_POST["category2"]=="" || $_POST["category2"]==NULL){
//							$img->setCategory(addslashes($_POST["category"]));
//						}else{
//							$img->setCategory(addslashes($_POST["category2"]));
//						}
//						$img->setComment(addslashes($_POST["comment"]));
//						$imgId = $this->getImageDAO()->createImg($img);
//						$location = "Location: index.php?controller=photo&action=next&imgId=$imgId&size=&categorie=";
//						header($location);
//					}
//				}
//			}
//			else
//			{
//				$success=3;
//				$location = "Location: index.php?controller=uploadFile&action=index&success=$success";
//				header($location);
//			}
//		}
//
//
//
//
//
//
//
//class Photo {
//
//		protected $imageDAO;
//		protected $minSize =100;
//		protected $maxSize =2000;
//		protected $data;
//		function __construct() {
//			// Ouvre le blog
//			$this->imageDAO = new ImageDAO();
//
//		}
//
//		/**
//		 * Recupere les parametres de manière globale
//		 * Pour toutes les actions de ce contrôleur
//		 */
//		protected function getParam() {
//			// Recupère un éventuel no de départ
//			global $imgId,$albumId,$size,$data,$nbImg,$categorie;
//			if (isset($_GET["imgId"]) && $_GET["imgId"]!="" && $_GET["imgId"]>0) {
//				$imgId = $_GET["imgId"];
//			} else {
//				$imgId = 1;
//			}
//
//			// Recupere le mode delete de l'interface
//			if (isset($_GET["size"]) && $_GET["size"]!="") {
//				$size = $_GET["size"];
//				if($size>=$this->maxSize ){
//					$size =$this->maxSize;
//				}else if($size<=$this->minSize){
//					$size =$this->minSize;
//				}
//			} else {
//				# sinon place une valeur de taille par défaut
//				$size = 480;
//			}
//			// Récupère le nombre d'images à afficher
//			if (isset($_GET["nbImg"])) {
//				$nbImg = $_GET["nbImg"];
//			} else {
//				# sinon débute avec 2 images
//				$nbImg = 1;
//			}
//			// Récupère la categorie à afficher
//			if (isset($_GET["categorie"])) {
//				$categorie = $_GET["categorie"];
//			} else {
//				# sinon débute avec 2 images
//				$categorie = NULL;
//			}
//			$data = new data();
//		}
//
//
//
//		/**
//		 *permet de mettre l'image courante sur la premiere image
//		 */
//		function first(){
//			global $imgId,$size,$data,$nbImg,$categorie;
//			$this->getParam();
//
//			$data->content = "viewPhoto.php";
//			$data->cssfiles = array("photo.css");
//			$imgId = 1;
//			$newImg = $this->getImageDAO()->getImage($imgId);
//			$categorieImg = $newImg->getCategory();
//			while ($categorieImg!=$categorie && $categorie!=NULL){
//				$newImg = $this->getImageDAO()->getNextImage($newImg);
//				$categorieImg = $newImg->getCategory();
//			}
//			// Construit l'image courante
//			$imgId = $newImg->getId();
//			$data->img = $newImg;
//			$this->configureSlideShow();
//			require_once("view/mainView.php");
//		}
//
//		/**
//		 *permet de mettre l'image courante sur une image aléatoire
//		 */
//		function random(){
//			global $imgId,$size,$data,$nbImg,$categorie;
//			$this->getParam();
//
//			$data->content = "viewPhoto.php";
//			$data->cssfiles = array("photo.css");
//			$newImg = $this->getImageDAO()->getImage($imgId);
//			$categorieImg = $newImg->getCategory();
//			$random = rand(0,1) ;
//			if ($random==0){
//				while ($categorieImg!=$categorie && $categorie!=NULL){
//				$newImg = $this->getImageDAO()->getPrevImage($newImg);
//				$categorieImg = $newImg->getCategory();
//				}
//			}else{
//				while ($categorieImg!=$categorie && $categorie!=NULL){
//					$newImg = $this->getImageDAO()->getNextImage($newImg);
//					$categorieImg = $newImg->getCategory();
//				}
//			}
//			// Construit l'image courante
//			$imgId = $newImg->getId();
//			$data->img = $newImg;
//			$this->configureSlideShow();
//			require_once("view/mainView.php");
//		}
//
//		/**
//		 *permet de mettre l'image courante sur l'image precedente
//		 */
//		function prec(){
//			global $imgId,$size,$data,$nbImg,$categorie;
//			$this->getParam();
//
//			$data->content = "viewPhoto.php";
//			$data->cssfiles = array("photo.css");
//			$newImg = $this->getImageDAO()->getImage($imgId);
//			$categorieImg = $newImg->getCategory();
//			while ($categorieImg!=$categorie && $categorie!=NULL){
//				$newImg = $this->getImageDAO()->getPrevImage($newImg);
//				$categorieImg = $newImg->getCategory();
//			}
//			// Construit l'image courante
//			$imgId = $newImg->getId();
//			$data->img = $newImg;
//			$this->configureSlideShow();
//			require_once("view/mainView.php");
//
//		}
//
//		/**
//		 *permet de mettre l'image courante sur l'image suivante
//		 */
//		function next(){
//			global $imgId,$size,$data,$nbImg,$categorie;
//			$this->getParam();
//
//			$data->content = "viewPhoto.php";
//			$data->cssfiles = array("photo.css");
//			$newImg = $this->getImageDAO()->getImage($imgId);
//			$categorieImg = $newImg->getCategory();
//			while ($categorieImg!=$categorie && $categorie!=NULL){
//				$newImg = $this->getImageDAO()->getNextImage($newImg);
//				$categorieImg = $newImg->getCategory();
//			}
//			// Construit l'image courante
//			$imgId = $newImg->getId();
//			$data->img = $newImg;
//			$this->configureSlideShow();
//			require_once("view/mainView.php");
//
//		}
//
//
//
//
//		/**
//		 *permet de mettre a jour les infos de l'image sur les notes de l'image
//		 */
//		function updateNote(){
//			global $imgId,$size,$data,$nbImg,$categorie;
//			$this->getParam();
//
//			$data->content = "viewPhoto.php";
//			$data->cssfiles = array("photo.css");
//			$this->getImageDAO()->updateNote($_GET["val"],$imgId);
//			// Construit l'image courante
//			$data->img = $this->getImageDAO()->getImage($imgId);
//			$this->configureSlideShow();
//			require_once("view/mainView.php");
//		}
//
//		/**
//		 *permet de filtrer les photos selon la categorie sélectionné
//		 */
//		function filterPhoto(){
//			global $albumId,$imgId,$size,$data,$nbImg,$categorie;
//			$this->getParam();
//			$categorie = $_POST["category"];
//
//			$data->content = "viewPhoto.php";
//			$data->cssfiles = array("photo.css");
//
//
//			$imgId = 1;
//
//			$newImg = $this->getImageDAO()->getImage($imgId);
//			$categorieImg = $newImg->getCategory();
//			while ($categorieImg!=$categorie && $newImg->getId()<=$this->getImageDAO()->count() && $categorie!=null){
//				$newImg = $this->getImageDAO()->getNextImage($newImg);
//				$categorieImg = $newImg->getCategory();
//			}
//			// Construit l'image courante
//			$imgId = $newImg->getId();
//			$data->img = $newImg;
//			$this->configureSlideShow();
//			require_once("view/mainView.php");
//		}
//	}
//
//
//
//###################
//
///**
//	 * Classe du controleur PhotoMatrix
//	 */
//	class PhotoMatrix {
//
//		protected $imageDAO;
//		protected $minSize =100;
//		protected $maxSize =2000;
//		protected $data;
//
//		function __construct() {
//			// Ouvre le blog
//			$this->imageDAO = new ImageDAO();
//
//		}
//
//		/**
//		 * Recupere les parametres de manière globale
//		 * Pour toutes les actions de ce contrôleur
//		 */
//		protected function getParam() {
//			// Recupère un éventuel no de départ
//			global $imgId,$size,$nbImg,$categorie,$data;
//			if (isset($_GET["imgId"]) && $_GET["imgId"]!="" && $_GET["imgId"]>0) {
//				$imgId = $_GET["imgId"];
//			} else {
//				$imgId = 1;
//			}
//			// Recupere le mode delete de l'interface
//			if (isset($_GET["size"]) && $_GET["size"]!="") {
//				$size = $_GET["size"];
//				if($size>=$this->maxSize ){
//					$size =$this->maxSize;
//				}else if($size<=$this->minSize){
//					$size =$this->minSize;
//				}
//			} else {
//				# sinon place une valeur de taille par défaut
//				$size = 480;
//			}
//			// Récupère le nombre d'images à afficher
//			if (isset($_GET["nbImg"])) {
//				$nbImg = $_GET["nbImg"];
//			} else {
//				# sinon débute avec 2 images
//				$nbImg = 1;
//			}
//			// Récupère la categorie à afficher
//			if (isset($_GET["categorie"])) {
//				$categorie = $_GET["categorie"];
//			} else {
//				# sinon débute avec 2 images
//				$categorie = NULL;
//			}
//			$data = new data();
//		}
//
//		//////////////////////// LISTE DES ACTIONS DE CE CONTROLEUR/////////////////////////////
//
//		/**
//		 * initialisation du controleur
//		 */
//		function index(){
//			$this->first();
//		}
//
//		/**
//		 *initialisation de la page
//		 */
//		function configureSlideShow(){
//			global $imgId,$size,$nbImg,$data,$categorie;
//
//
//			// Pre-calcule la première image
//			$newImg = $this->getImageDAO()->getImage(1);
//			$randomImg = $this->getImageDAO()->getRandomImage();
//			$randomImgId = $randomImg->getId();
//
//
//			// pre-calcul de l'image précedente
//			$prevImg = $this->getImageDAO()->getPrevImage($this->getImageDAO()->getImage($imgId))->getId();
//			// pre-calcul de l'image suivante
//			$nextImg = $this->getImageDAO()->getNextImage($this->getImageDAO()->getImage($imgId))->getId();
//
//			# Mise en place des outils
//			# Change l'etat pour indiquer que cette image est la nouvelle
//			$newImgId=$newImg->getId();
//			$newSize=480;
//			$newNbImg=1;
//			$data->tools['Prev']="index.php?controller=photoMatrix&action=prec&imgId=$prevImg&size=$size&nbImg=$nbImg&categorie=$categorie";
//			$data->tools['First']="index.php?controller=photoMatrix&action=first&imgId=$newImgId&size=$newSize&nbImg=$nbImg&categorie=$categorie";
//			# Pre-calcule une image au hasard
//			$data->tools['Random']="index.php?controller=photoMatrix&action=random&imgId=$randomImgId&size=$size&nbImg=$nbImg&categorie=$categorie";
//			# Pour afficher plus d'image passe à une autre page
//			if($categorie!=null && $nbImg==$this->getImageDAO()->getNbImageCategory($categorie)){
//							$data->styles["#More"]["display"]= "none";
//			}else{
//				if ($nbImg<127){
//					$nbImgMore =$nbImg +1;
//				}else{
//					$nbImgMore =$nbImg;
//				}
//				$data->tools['More']="index.php?controller=photoMatrix&action=more&imgId=$imgId&size=$size&nbImg=$nbImgMore&categorie=$categorie";
//			}
//			# Pour afficher moins d'image passe à une autre page
//			if ($nbImg>2){
//				$nbImgLess=$nbImg-1;
//				$data->tools['Less']="index.php?controller=photoMatrix&action=less&imgId=$imgId&size=$size&nbImg=$nbImgLess&categorie=$categorie";
//			}elseif ($nbImg==2){
//				$nbImgLess=$nbImg-1;
//				$data->tools['Less']="index.php?controller=photo&action=prec&imgId=$imgId&size=&nbImg=$nbImgLess&categorie=$categorie";
//			}
//
//			// Demande à calculer un zoom sur l'image
//			$data->tools['Zoom +']="index.php?controller=photo&action=zoom&imgId=$imgId&size=".($size*1.25)."&categorie=$categorie";
//			// Demande à calculer un zoom sur l'image
//			$data->tools['Zoom -']="index.php?controller=photo&action=zoom&imgId=$imgId&size=".($size*0.75)."&categorie=$categorie";
//			$data->tools['Next']="index.php?controller=photoMatrix&action=next&imgId=$nextImg&size=$size&nbImg=$nbImg&categorie=$categorie";
//
//			$data->toolsimg['Prev']="prev.png";
//			$data->toolsimg['First']="first.png";
//			$data->toolsimg['Random']="random.png";
//			$data->toolsimg['More']="add.png";
//			$data->toolsimg['Less']="less.png";
//			$data->toolsimg['Zoom +']="zoom+.png";
//			$data->toolsimg['Zoom -']="zoom-.png";
//			$data->toolsimg['Next']="next.png";
//			$data->categories = $this->getImageDAO()->getCategories();
//			$data->categorie = $categorie;
//		}
//
//		/**
//		 *permet d'ajouter une nouvelle image
//		 */
//		function first(){
//			global $imgId,$size,$nbImg,$data,$categorie;
//			$this->getParam();
//			$data->content = "view/viewPhotoMatrix.php";
//			$data->cssfiles = array("photoMatrix.css");
//			$size=480 / sqrt($nbImg);
//			// Construit l'image courante
//			$list=array();
//			$imgId=1;
//			$newImg = $this->getImageDAO()->getImage($imgId);
//			$categorieImg = $newImg->getCategory();
//			for($i=0;$i<$nbImg;$i++){
//				while ($categorieImg!=$categorie && $categorie!=NULL){
//					$newImg = $this->getImageDAO()->getNextImage($newImg);
//					$categorieImg = $newImg->getCategory();
//				}
//				$list[$i] = $newImg;
//				$newImg = $this->getImageDAO()->getNextImage($newImg);
//				$categorieImg = $newImg->getCategory();
//			}
//			// Construit l'image courante
//			$imgId = $list[0]->getId();
//			$data->list = $list;
//			$data->img = $newImg;
//
//			$this->configureSlideShow();
//			require_once("view/mainView.php");
//		}
//
//		/**
//		 *permet d'ajouter une nouvelle image
//		 */
//		function more(){
//			global $imgId,$size,$nbImg,$data,$categorie;
//			$this->getParam();
//			$data->content = "view/viewPhotoMatrix.php";
//			$data->cssfiles = array("photoMatrix.css");
//			$size=480 / sqrt($nbImg);
//			// Construit l'image courante
//			$list=array();
//			$newImg = $this->getImageDAO()->getImage($imgId);
//			$categorieImg = $newImg->getCategory();
//			for($i=0;$i<$nbImg;$i++){
//				while ($categorieImg!=$categorie && $categorie!=NULL){
//					$newImg = $this->getImageDAO()->getNextImage($newImg);
//					$categorieImg = $newImg->getCategory();
//				}
//				$list[$i] = $newImg;
//				$newImg = $this->getImageDAO()->getNextImage($newImg);
//				$categorieImg = $newImg->getCategory();
//			}
//			// Construit l'image courante
//			$imgId = $list[0]->getId();
//			$data->list = $list;
//			$data->img = $newImg;
//
//			$this->configureSlideShow();
//			require_once("view/mainView.php");
//		}
//
//		/**
//		 *permet de retirer une image
//		 */
//		function less(){
//			global $imgId,$size,$nbImg,$data,$categorie;
//			$this->getParam();
//			$data->content = "view/viewPhotoMatrix.php";
//			$data->cssfiles = array("photoMatrix.css");
//			$size=480 / sqrt($nbImg);
//			// Construit l'image courante
//			$list=array();
//			$newImg = $this->getImageDAO()->getImage($imgId);
//			$categorieImg = $newImg->getCategory();
//			for($i=0;$i<$nbImg;$i++){
//				while ($categorieImg!=$categorie && $categorie!=NULL){
//					$newImg = $this->getImageDAO()->getNextImage($newImg);
//					$categorieImg = $newImg->getCategory();
//				}
//				$list[$i] = $newImg;
//				$newImg = $this->getImageDAO()->getNextImage($newImg);
//				$categorieImg = $newImg->getCategory();
//			}
//			// Construit l'image courante
//			$imgId = $list[0]->getId();
//			$data->list = $list;
//			$data->img = $newImg;
//
//			$this->configureSlideShow();
//			require_once("view/mainView.php");
//		}
//
//		/**
//		 *permet de mettre les images courantes sur une image aléatoire
//		 */
//		function random(){
//			global $imgId,$size,$nbImg,$data,$categorie;
//			$this->getParam();
//			$data->content = "view/viewPhotoMatrix.php";
//			$data->cssfiles = array("photoMatrix.css");
//			$size=480 / sqrt($nbImg);
//			// Construit l'image courante
//			$list=array();
//			$newImg = $this->getImageDAO()->getImage($imgId);
//			$categorieImg = $newImg->getCategory();
//			for($i=0;$i<$nbImg;$i++){
//				$random = rand(0,1) ;
//				if ($random==0){
//					while ($categorieImg!=$categorie && $categorie!=NULL){
//						$newImg = $this->getImageDAO()->getPrevImage($newImg);
//						$categorieImg = $newImg->getCategory();
//					}
//				}else{
//					while ($categorieImg!=$categorie && $categorie!=NULL){
//						$newImg = $this->getImageDAO()->getNextImage($newImg);
//						$categorieImg = $newImg->getCategory();
//					}
//				}
//				$list[$i] = $newImg;
//				$newImg = $this->getImageDAO()->getRandomImage();
//				$categorieImg = $newImg->getCategory();
//			}
//			// Construit l'image courante
//			$imgId = $list[0]->getId();
//			$data->list = $list;
//			$data->img = $newImg;
//
//			$this->configureSlideShow();
//			require_once("view/mainView.php");
//		}
//
//
//
//		/**
//		 *permet de mettre les images courante sur les images suivantes
//		 */
//		function next(){
//			global $imgId,$size,$nbImg,$data,$categorie;
//			$this->getParam();
//			$data->content = "view/viewPhotoMatrix.php";
//			$data->cssfiles = array("photoMatrix.css");
//			$size=480 / sqrt($nbImg);
//			// Construit l'image courante
//			$list=array();
//			$newImg = $this->getImageDAO()->getImage($imgId);
//			$categorieImg = $newImg->getCategory();
//			for($i=0;$i<$nbImg;$i++){
//				while ($categorieImg!=$categorie && $categorie!=NULL){
//					$newImg = $this->getImageDAO()->getNextImage($newImg);
//					$categorieImg = $newImg->getCategory();
//				}
//				$list[$i] = $newImg;
//				$newImg = $this->getImageDAO()->getNextImage($newImg);
//				$categorieImg = $newImg->getCategory();
//			}
//			// Construit l'image courante
//			$imgId = $list[0]->getId();
//			$data->list = $list;
//			$data->img = $newImg;
//
//			$this->configureSlideShow();
//			require_once("view/mainView.php");
//
//		}
