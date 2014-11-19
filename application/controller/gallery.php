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

    /**
     * ACTION: addImage
     * This method handles what happens when you move to http://yourproject/songs/addalbum
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a album" form on album/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to album/index via the last line: header(...)
     */
    public function addImage()
    {
        $path = "uploads/";
        $valid_formats = array("jpg","jpeg", "png", "gif", "bmp");

        // if we have POST data to create a new Album
        if (isset($_POST["submit_add_image"])) {
            // load model, perform an action on the model
            $image_model = $this->loadModel('GalleryModel');
            $image_model->addImage($_POST["image_id"], $_POST["name"]);
        }

        // where to go after song has been added
        header('location: ' . URL . 'gallery/index');
    }



}



if(isset($_FILES['image'])) {
            echo "1";
            $name = $_FILES['image']['name'];
            $size = $_FILES['image']['size'];


if(strlen($name))
    {
    list($txt, $ext) = explode(".", $name);
if(in_array($ext,$valid_formats))
    {
if($size<(2048*2048))
    {
        $actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
        $tmp = $_FILES['image']['tmp_name'];

if(move_uploaded_file($tmp, $path.$actual_image_name))
    {

        mysql_query("UPDATE tutor SET avatar='$actual_image_name' WHERE userName='Isuru'");
        echo "Hari";
    }else
        echo die(mysql_error());

    }else

        echo "exceed the file size";

    }else
        echo "Not a valid format";


    }else
        echo "no file is selected";


        }



#################

class UploadFile {

		function __construct() {
			$this->imageDAO = new ImageDAO();
		}

		/**
		 *permet de mettre l'image courante sur la premiere image
		 */
		function index(){
			global $imgId,$size,$data,$nbImg;
			$data = new data();


			$imgId = 1;
			$size = 480;
			$nbImg = 1;

			if(isset($_GET['success'])){
				$data->success= $_GET['success'];
				switch ( $data->success ) {
					case 1:
						$data->msgErreur="Une image de même nom existe déjà.";
						break;
					case 2:
						$data->msgErreur="Le fichier est corrompu.";
						break;
					case 3:
						$data->msgErreur="Le fichier n'est pas au bon Format ou trop gros.";
						break;
					case 4:
						$data->msgErreur="Le dossier de destination n'a pu être crée.";
						break;
					default:
						break;
					}
				}
			$data->content = "viewUploadFile.php";
			$data->categories = $this->getImageDAO()->getCategories();
			require_once("view/mainView.php");
		}

		function uploadImg() {
			$allowedExts = array("jpg", "jpeg", "gif", "png", "bmp");
			$extension = end(explode(".", $_FILES["file"]["name"]));
			if ((($_FILES["file"]["type"] == "image/gif")
					|| ($_FILES["file"]["type"] == "image/jpeg")
					|| ($_FILES["file"]["type"] == "image/png")
					|| ($_FILES["file"]["type"] == "image/pjpeg")
					|| ($_FILES["file"]["type"] == "image/bmp"))
					&& ($_FILES["file"]["size"] < 2000000)
					&& in_array($extension, $allowedExts))
			{
				if ($_FILES["file"]["error"] > 0)
				{
					$success=2;
					$location = "Location: index.php?controller=uploadFile&action=index&success=$success";
					header($location);
				}
				else
				{
					$urlPath = '../'.$this->getImageDAO()->getPath()."/jons/upload/";
					if (file_exists($urlPath.$_FILES["file"]["name"]))
					{
						$success=1;
						$location = "Location: index.php?controller=uploadFile&action=index&success=$success";
						header($location);
					}
					else
					{
						if (!is_dir($urlPath)) {
							if(!mkdir($urlPath, 0755, true)) {
								$success=4;
								$location = "Location: index.php?controller=uploadFile&action=index&success=$success";
								header($location);
							}
						}
						move_uploaded_file($_FILES["file"]["tmp_name"],
								$urlPath.$_FILES["file"]["name"]);
						$img = new Image();
						$img->setPath("jons/upload/" . $_FILES["file"]["name"]);
						if (!isset($_POST["category2"]) || $_POST["category2"]=="" || $_POST["category2"]==NULL){
							$img->setCategory(addslashes($_POST["category"]));
						}else{
							$img->setCategory(addslashes($_POST["category2"]));
						}
						$img->setComment(addslashes($_POST["comment"]));
						$imgId = $this->getImageDAO()->createImg($img);
						$location = "Location: index.php?controller=photo&action=next&imgId=$imgId&size=&categorie=";
						header($location);
					}
				}
			}
			else
			{
				$success=3;
				$location = "Location: index.php?controller=uploadFile&action=index&success=$success";
				header($location);
			}
		}

		/**
		 * return ImageDAO
		 */
		function getImageDAO(){
			return $this->imageDAO;
		}
	}


############








class Photo {

		protected $imageDAO;
		protected $minSize =100;
		protected $maxSize =2000;
		protected $data;
		function __construct() {
			// Ouvre le blog
			$this->imageDAO = new ImageDAO();

		}

		/**
		 * Recupere les parametres de manière globale
		 * Pour toutes les actions de ce contrôleur
		 */
		protected function getParam() {
			// Recupère un éventuel no de départ
			global $imgId,$albumId,$size,$data,$nbImg,$categorie;
			if (isset($_GET["imgId"]) && $_GET["imgId"]!="" && $_GET["imgId"]>0) {
				$imgId = $_GET["imgId"];
			} else {
				$imgId = 1;
			}

			// Recupere le mode delete de l'interface
			if (isset($_GET["size"]) && $_GET["size"]!="") {
				$size = $_GET["size"];
				if($size>=$this->maxSize ){
					$size =$this->maxSize;
				}else if($size<=$this->minSize){
					$size =$this->minSize;
				}
			} else {
				# sinon place une valeur de taille par défaut
				$size = 480;
			}
			// Récupère le nombre d'images à afficher
			if (isset($_GET["nbImg"])) {
				$nbImg = $_GET["nbImg"];
			} else {
				# sinon débute avec 2 images
				$nbImg = 1;
			}
			// Récupère la categorie à afficher
			if (isset($_GET["categorie"])) {
				$categorie = $_GET["categorie"];
			} else {
				# sinon débute avec 2 images
				$categorie = NULL;
			}
			$data = new data();
		}

		//////////////////////// LISTE DES ACTIONS DE CE CONTROLEUR/////////////////////////////

		/**
		 * initialisation du controleur
		 */
		function index(){
			$this->first();
		}

		/**
		 *initialisation de la page
		 */
		function configureSlideShow(){
			global $albumId,$imgId,$size,$data,$nbImg,$categorie;
			// Pre-calcule les images
			$newImg = $this->getImageDAO()->getImage(1);
			$newImgId=$newImg->getId();

			$randomImg = $this->getImageDAO()->getRandomImage();
			$randomImgId = $randomImg->getId();

			$newSize=480;
			$data->styles["#slideShow"]["width"]= ($size+130)."px";
			$data->styles["#next,#prev"]["height"]= ($size/3)."px";



			// pre-calcul de l'image précedente
			$data->prevImg = $this->getImageDAO()->getPrevImage($data->img);
			// pre-calcul de l'image suivante
			$data->nextImg = $this->getImageDAO()->getNextImage($data->img);

			# Mise en place des outils
			$data->tools['First']="index.php?controller=photo&action=first&imgId=$newImgId&size=$newSize&categorie=$categorie";
			# Pre-calcule une image au hasard
			$data->tools['Random']="index.php?controller=photo&action=random&imgId=$randomImgId&size=$size&categorie=$categorie";
			# Pour afficher plus d'image passe à une autre page
			if($categorie!=null && $nbImg==$this->getImageDAO()->getNbImageCategory($categorie)){
				$data->styles["#More"]["display"]= "none";
			}else{
				$nbImg =$nbImg +1;
				$data->tools['More']="index.php?controller=photoMatrix&action=more&imgId=$imgId&size=$size&nbImg=$nbImg&categorie=$categorie";
			}
			// Demande à calculer un zoom sur l'image
			$data->tools['Zoom +']="index.php?controller=photo&action=zoom&imgId=$imgId&size=".($size*1.25)."&categorie=$categorie";
			// Demande à calculer un zoom sur l'image
			$data->tools['Zoom -']="index.php?controller=photo&action=zoom&imgId=$imgId&size=".($size*0.75)."&categorie=$categorie";
			$data->toolsimg['First']="first.png";
			$data->toolsimg['Random']="random.png";
			$data->toolsimg['More']="add.png";
			$data->toolsimg['Less']="less.png";
			$data->toolsimg['Zoom +']="zoom+.png";
			$data->toolsimg['Zoom -']="zoom-.png";

			$data->albums = $this->getImageDAO()->getAlbums();
			$data->categories = $this->getImageDAO()->getCategories();
			$data->select = $this->getImageDAO()->getImage($imgId);
			$data->note = $this->getImageDAO()->getNote($imgId);
			$data->categorie = $categorie;
		}

		/**
		 *permet de mettre l'image courante sur la premiere image
		 */
		function first(){
			global $imgId,$size,$data,$nbImg,$categorie;
			$this->getParam();

			$data->content = "viewPhoto.php";
			$data->cssfiles = array("photo.css");
			$imgId = 1;
			$newImg = $this->getImageDAO()->getImage($imgId);
			$categorieImg = $newImg->getCategory();
			while ($categorieImg!=$categorie && $categorie!=NULL){
				$newImg = $this->getImageDAO()->getNextImage($newImg);
				$categorieImg = $newImg->getCategory();
			}
			// Construit l'image courante
			$imgId = $newImg->getId();
			$data->img = $newImg;
			$this->configureSlideShow();
			require_once("view/mainView.php");
		}

		/**
		 *permet de mettre l'image courante sur une image aléatoire
		 */
		function random(){
			global $imgId,$size,$data,$nbImg,$categorie;
			$this->getParam();

			$data->content = "viewPhoto.php";
			$data->cssfiles = array("photo.css");
			$newImg = $this->getImageDAO()->getImage($imgId);
			$categorieImg = $newImg->getCategory();
			$random = rand(0,1) ;
			if ($random==0){
				while ($categorieImg!=$categorie && $categorie!=NULL){
				$newImg = $this->getImageDAO()->getPrevImage($newImg);
				$categorieImg = $newImg->getCategory();
				}
			}else{
				while ($categorieImg!=$categorie && $categorie!=NULL){
					$newImg = $this->getImageDAO()->getNextImage($newImg);
					$categorieImg = $newImg->getCategory();
				}
			}
			// Construit l'image courante
			$imgId = $newImg->getId();
			$data->img = $newImg;
			$this->configureSlideShow();
			require_once("view/mainView.php");
		}

		/**
		 *permet de mettre l'image courante sur l'image precedente
		 */
		function prec(){
			global $imgId,$size,$data,$nbImg,$categorie;
			$this->getParam();

			$data->content = "viewPhoto.php";
			$data->cssfiles = array("photo.css");
			$newImg = $this->getImageDAO()->getImage($imgId);
			$categorieImg = $newImg->getCategory();
			while ($categorieImg!=$categorie && $categorie!=NULL){
				$newImg = $this->getImageDAO()->getPrevImage($newImg);
				$categorieImg = $newImg->getCategory();
			}
			// Construit l'image courante
			$imgId = $newImg->getId();
			$data->img = $newImg;
			$this->configureSlideShow();
			require_once("view/mainView.php");

		}

		/**
		 *permet de mettre l'image courante sur l'image suivante
		 */
		function next(){
			global $imgId,$size,$data,$nbImg,$categorie;
			$this->getParam();

			$data->content = "viewPhoto.php";
			$data->cssfiles = array("photo.css");
			$newImg = $this->getImageDAO()->getImage($imgId);
			$categorieImg = $newImg->getCategory();
			while ($categorieImg!=$categorie && $categorie!=NULL){
				$newImg = $this->getImageDAO()->getNextImage($newImg);
				$categorieImg = $newImg->getCategory();
			}
			// Construit l'image courante
			$imgId = $newImg->getId();
			$data->img = $newImg;
			$this->configureSlideShow();
			require_once("view/mainView.php");

		}

		/**
		 *permet de zoomer sur l'image courante
		 */
		function zoom(){
			$this->next();
		}

		/**
		 * return ImageDAO
		 */
		function getImageDAO(){
			return $this->imageDAO;
		}

		/**
		 *permet de mettre a jour les infos de l'image courante puis l'affiche
		 */
		function updatePhoto(){
			global $imgId,$size,$data,$nbImg,$categorie;
			$this->getParam();

			$data->content = "viewPhoto.php";
			$data->cssfiles = array("photo.css");
			$img = $this->getImageDAO()->getImage($imgId);
			if (!isset($_POST["category2"]) || $_POST["category2"]=="" || $_POST["category2"]==NULL){
				$img->setCategory(addslashes($_POST["category"]));
			}else{
				$img->setCategory(addslashes($_POST["category2"]));
			}
			$img->setComment(addslashes($_POST["comment"]));
			$this->getImageDAO()->updateImg($img);
			// Construit l'image courante
			$data->img = $img;
			$this->configureSlideShow();
			require_once("view/mainView.php");
		}

		/**
		 *permet de mettre a jour les infos de l'image sur les notes de l'image
		 */
		function updateNote(){
			global $imgId,$size,$data,$nbImg,$categorie;
			$this->getParam();

			$data->content = "viewPhoto.php";
			$data->cssfiles = array("photo.css");
			$this->getImageDAO()->updateNote($_GET["val"],$imgId);
			// Construit l'image courante
			$data->img = $this->getImageDAO()->getImage($imgId);
			$this->configureSlideShow();
			require_once("view/mainView.php");
		}

		/**
		 *permet de filtrer les photos selon la categorie sélectionné
		 */
		function filterPhoto(){
			global $albumId,$imgId,$size,$data,$nbImg,$categorie;
			$this->getParam();
			$categorie = $_POST["category"];

			$data->content = "viewPhoto.php";
			$data->cssfiles = array("photo.css");


			$imgId = 1;

			$newImg = $this->getImageDAO()->getImage($imgId);
			$categorieImg = $newImg->getCategory();
			while ($categorieImg!=$categorie && $newImg->getId()<=$this->getImageDAO()->count() && $categorie!=null){
				$newImg = $this->getImageDAO()->getNextImage($newImg);
				$categorieImg = $newImg->getCategory();
			}
			// Construit l'image courante
			$imgId = $newImg->getId();
			$data->img = $newImg;
			$this->configureSlideShow();
			require_once("view/mainView.php");
		}
	}



###################

/**
	 * Classe du controleur PhotoMatrix
	 */
	class PhotoMatrix {

		protected $imageDAO;
		protected $minSize =100;
		protected $maxSize =2000;
		protected $data;

		function __construct() {
			// Ouvre le blog
			$this->imageDAO = new ImageDAO();

		}

		/**
		 * Recupere les parametres de manière globale
		 * Pour toutes les actions de ce contrôleur
		 */
		protected function getParam() {
			// Recupère un éventuel no de départ
			global $imgId,$size,$nbImg,$categorie,$data;
			if (isset($_GET["imgId"]) && $_GET["imgId"]!="" && $_GET["imgId"]>0) {
				$imgId = $_GET["imgId"];
			} else {
				$imgId = 1;
			}
			// Recupere le mode delete de l'interface
			if (isset($_GET["size"]) && $_GET["size"]!="") {
				$size = $_GET["size"];
				if($size>=$this->maxSize ){
					$size =$this->maxSize;
				}else if($size<=$this->minSize){
					$size =$this->minSize;
				}
			} else {
				# sinon place une valeur de taille par défaut
				$size = 480;
			}
			// Récupère le nombre d'images à afficher
			if (isset($_GET["nbImg"])) {
				$nbImg = $_GET["nbImg"];
			} else {
				# sinon débute avec 2 images
				$nbImg = 1;
			}
			// Récupère la categorie à afficher
			if (isset($_GET["categorie"])) {
				$categorie = $_GET["categorie"];
			} else {
				# sinon débute avec 2 images
				$categorie = NULL;
			}
			$data = new data();
		}

		//////////////////////// LISTE DES ACTIONS DE CE CONTROLEUR/////////////////////////////

		/**
		 * initialisation du controleur
		 */
		function index(){
			$this->first();
		}

		/**
		 *initialisation de la page
		 */
		function configureSlideShow(){
			global $imgId,$size,$nbImg,$data,$categorie;


			// Pre-calcule la première image
			$newImg = $this->getImageDAO()->getImage(1);
			$randomImg = $this->getImageDAO()->getRandomImage();
			$randomImgId = $randomImg->getId();


			// pre-calcul de l'image précedente
			$prevImg = $this->getImageDAO()->getPrevImage($this->getImageDAO()->getImage($imgId))->getId();
			// pre-calcul de l'image suivante
			$nextImg = $this->getImageDAO()->getNextImage($this->getImageDAO()->getImage($imgId))->getId();

			# Mise en place des outils
			# Change l'etat pour indiquer que cette image est la nouvelle
			$newImgId=$newImg->getId();
			$newSize=480;
			$newNbImg=1;
			$data->tools['Prev']="index.php?controller=photoMatrix&action=prec&imgId=$prevImg&size=$size&nbImg=$nbImg&categorie=$categorie";
			$data->tools['First']="index.php?controller=photoMatrix&action=first&imgId=$newImgId&size=$newSize&nbImg=$nbImg&categorie=$categorie";
			# Pre-calcule une image au hasard
			$data->tools['Random']="index.php?controller=photoMatrix&action=random&imgId=$randomImgId&size=$size&nbImg=$nbImg&categorie=$categorie";
			# Pour afficher plus d'image passe à une autre page
			if($categorie!=null && $nbImg==$this->getImageDAO()->getNbImageCategory($categorie)){
							$data->styles["#More"]["display"]= "none";
			}else{
				if ($nbImg<127){
					$nbImgMore =$nbImg +1;
				}else{
					$nbImgMore =$nbImg;
				}
				$data->tools['More']="index.php?controller=photoMatrix&action=more&imgId=$imgId&size=$size&nbImg=$nbImgMore&categorie=$categorie";
			}
			# Pour afficher moins d'image passe à une autre page
			if ($nbImg>2){
				$nbImgLess=$nbImg-1;
				$data->tools['Less']="index.php?controller=photoMatrix&action=less&imgId=$imgId&size=$size&nbImg=$nbImgLess&categorie=$categorie";
			}elseif ($nbImg==2){
				$nbImgLess=$nbImg-1;
				$data->tools['Less']="index.php?controller=photo&action=prec&imgId=$imgId&size=&nbImg=$nbImgLess&categorie=$categorie";
			}

			// Demande à calculer un zoom sur l'image
			$data->tools['Zoom +']="index.php?controller=photo&action=zoom&imgId=$imgId&size=".($size*1.25)."&categorie=$categorie";
			// Demande à calculer un zoom sur l'image
			$data->tools['Zoom -']="index.php?controller=photo&action=zoom&imgId=$imgId&size=".($size*0.75)."&categorie=$categorie";
			$data->tools['Next']="index.php?controller=photoMatrix&action=next&imgId=$nextImg&size=$size&nbImg=$nbImg&categorie=$categorie";

			$data->toolsimg['Prev']="prev.png";
			$data->toolsimg['First']="first.png";
			$data->toolsimg['Random']="random.png";
			$data->toolsimg['More']="add.png";
			$data->toolsimg['Less']="less.png";
			$data->toolsimg['Zoom +']="zoom+.png";
			$data->toolsimg['Zoom -']="zoom-.png";
			$data->toolsimg['Next']="next.png";
			$data->categories = $this->getImageDAO()->getCategories();
			$data->categorie = $categorie;
		}

		/**
		 *permet d'ajouter une nouvelle image
		 */
		function first(){
			global $imgId,$size,$nbImg,$data,$categorie;
			$this->getParam();
			$data->content = "view/viewPhotoMatrix.php";
			$data->cssfiles = array("photoMatrix.css");
			$size=480 / sqrt($nbImg);
			// Construit l'image courante
			$list=array();
			$imgId=1;
			$newImg = $this->getImageDAO()->getImage($imgId);
			$categorieImg = $newImg->getCategory();
			for($i=0;$i<$nbImg;$i++){
				while ($categorieImg!=$categorie && $categorie!=NULL){
					$newImg = $this->getImageDAO()->getNextImage($newImg);
					$categorieImg = $newImg->getCategory();
				}
				$list[$i] = $newImg;
				$newImg = $this->getImageDAO()->getNextImage($newImg);
				$categorieImg = $newImg->getCategory();
			}
			// Construit l'image courante
			$imgId = $list[0]->getId();
			$data->list = $list;
			$data->img = $newImg;

			$this->configureSlideShow();
			require_once("view/mainView.php");
		}

		/**
		 *permet d'ajouter une nouvelle image
		 */
		function more(){
			global $imgId,$size,$nbImg,$data,$categorie;
			$this->getParam();
			$data->content = "view/viewPhotoMatrix.php";
			$data->cssfiles = array("photoMatrix.css");
			$size=480 / sqrt($nbImg);
			// Construit l'image courante
			$list=array();
			$newImg = $this->getImageDAO()->getImage($imgId);
			$categorieImg = $newImg->getCategory();
			for($i=0;$i<$nbImg;$i++){
				while ($categorieImg!=$categorie && $categorie!=NULL){
					$newImg = $this->getImageDAO()->getNextImage($newImg);
					$categorieImg = $newImg->getCategory();
				}
				$list[$i] = $newImg;
				$newImg = $this->getImageDAO()->getNextImage($newImg);
				$categorieImg = $newImg->getCategory();
			}
			// Construit l'image courante
			$imgId = $list[0]->getId();
			$data->list = $list;
			$data->img = $newImg;

			$this->configureSlideShow();
			require_once("view/mainView.php");
		}

		/**
		 *permet de retirer une image
		 */
		function less(){
			global $imgId,$size,$nbImg,$data,$categorie;
			$this->getParam();
			$data->content = "view/viewPhotoMatrix.php";
			$data->cssfiles = array("photoMatrix.css");
			$size=480 / sqrt($nbImg);
			// Construit l'image courante
			$list=array();
			$newImg = $this->getImageDAO()->getImage($imgId);
			$categorieImg = $newImg->getCategory();
			for($i=0;$i<$nbImg;$i++){
				while ($categorieImg!=$categorie && $categorie!=NULL){
					$newImg = $this->getImageDAO()->getNextImage($newImg);
					$categorieImg = $newImg->getCategory();
				}
				$list[$i] = $newImg;
				$newImg = $this->getImageDAO()->getNextImage($newImg);
				$categorieImg = $newImg->getCategory();
			}
			// Construit l'image courante
			$imgId = $list[0]->getId();
			$data->list = $list;
			$data->img = $newImg;

			$this->configureSlideShow();
			require_once("view/mainView.php");
		}

		/**
		 *permet de mettre les images courantes sur une image aléatoire
		 */
		function random(){
			global $imgId,$size,$nbImg,$data,$categorie;
			$this->getParam();
			$data->content = "view/viewPhotoMatrix.php";
			$data->cssfiles = array("photoMatrix.css");
			$size=480 / sqrt($nbImg);
			// Construit l'image courante
			$list=array();
			$newImg = $this->getImageDAO()->getImage($imgId);
			$categorieImg = $newImg->getCategory();
			for($i=0;$i<$nbImg;$i++){
				$random = rand(0,1) ;
				if ($random==0){
					while ($categorieImg!=$categorie && $categorie!=NULL){
						$newImg = $this->getImageDAO()->getPrevImage($newImg);
						$categorieImg = $newImg->getCategory();
					}
				}else{
					while ($categorieImg!=$categorie && $categorie!=NULL){
						$newImg = $this->getImageDAO()->getNextImage($newImg);
						$categorieImg = $newImg->getCategory();
					}
				}
				$list[$i] = $newImg;
				$newImg = $this->getImageDAO()->getRandomImage();
				$categorieImg = $newImg->getCategory();
			}
			// Construit l'image courante
			$imgId = $list[0]->getId();
			$data->list = $list;
			$data->img = $newImg;

			$this->configureSlideShow();
			require_once("view/mainView.php");
		}

		/**
		 *permet de mettre les images courante sur les images precedentes
		 */
		function prec(){
			global $imgId,$size,$nbImg,$data,$categorie;
			$this->getParam();
			$data->content = "view/viewPhotoMatrix.php";
			$data->cssfiles = array("photoMatrix.css");
			$size=480 / sqrt($nbImg);
			// Construit l'image courante
			$list=array();
			$newImg = $this->getImageDAO()->getImage($imgId);
			$categorieImg = $newImg->getCategory();
			for($i=0;$i<$nbImg;$i++){
				while ($categorieImg!=$categorie && $categorie!=NULL){
					$newImg = $this->getImageDAO()->getPrevImage($newImg);
					$categorieImg = $newImg->getCategory();
				}
				$list[$i] = $newImg;
				$newImg = $this->getImageDAO()->getPrevImage($newImg);
				$categorieImg = $newImg->getCategory();
			}
			// Construit l'image courante
			$imgId = $list[0]->getId();
			$data->list = $list;
			$data->img = $newImg;

			$this->configureSlideShow();
			require_once("view/mainView.php");

		}

		/**
		 *permet de mettre les images courante sur les images suivantes
		 */
		function next(){
			global $imgId,$size,$nbImg,$data,$categorie;
			$this->getParam();
			$data->content = "view/viewPhotoMatrix.php";
			$data->cssfiles = array("photoMatrix.css");
			$size=480 / sqrt($nbImg);
			// Construit l'image courante
			$list=array();
			$newImg = $this->getImageDAO()->getImage($imgId);
			$categorieImg = $newImg->getCategory();
			for($i=0;$i<$nbImg;$i++){
				while ($categorieImg!=$categorie && $categorie!=NULL){
					$newImg = $this->getImageDAO()->getNextImage($newImg);
					$categorieImg = $newImg->getCategory();
				}
				$list[$i] = $newImg;
				$newImg = $this->getImageDAO()->getNextImage($newImg);
				$categorieImg = $newImg->getCategory();
			}
			// Construit l'image courante
			$imgId = $list[0]->getId();
			$data->list = $list;
			$data->img = $newImg;

			$this->configureSlideShow();
			require_once("view/mainView.php");

		}

		/**
		 *permet de zoomer sur l'image courante
		 */
		function zoom(){
			$this->next();
		}

		/**
		 * return ImageDAO
		 */
		function getImageDAO(){
			return $this->imageDAO;
		}

		/**
		 *permet de filtrer les photos selon la categorie sélectionné
		 */
		function filterPhotoMatrix(){
			global $imgId,$size,$data,$nbImg,$categorie;
			$this->getParam();
			$data->content = "viewPhotoMatrix.php";
			$data->cssfiles = array("photoMatrix.css");
			$categorie = $_POST["category"];
			$list=array();
			$imgId = 1;
			$newImg = $this->getImageDAO()->getImage($imgId);
			$categorieImg = $newImg->getCategory();
			for($i=0;$i<$nbImg;$i++){
				while ($categorieImg!=$categorie && $newImg->getId()<=$this->getImageDAO()->count() && $categorie!=null){
					$newImg = $this->getImageDAO()->getImage($newImg->getId()+1);
					$categorieImg = $newImg->getCategory();
				}
				$list[$i] = $newImg;
				$newImg = $this->getImageDAO()->getImage($newImg->getId()+1);
				$categorieImg = $newImg->getCategory();
			}
			// Construit l'image courante
			$imgId = $list[0]->getId();
			$data->list = $list;
			$data->img = $newImg;
			$this->configureSlideShow();
			require_once("view/mainView.php");
		}

	}
