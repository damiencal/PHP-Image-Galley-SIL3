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
