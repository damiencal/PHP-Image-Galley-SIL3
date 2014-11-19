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
        $album = $album_model->getAllAlbums();

        // load another model, perform an action, pass the returned data to a variable
        $stats_model = $this->loadModel('AlbumModel');
        $amount_of_pics = $stats_model->getAmountOfPictures();
        // load views.
        require 'application/views/_templates/header.php';
        require 'application/views/album/index.php';
        require 'application/views/_templates/footer.php';
    }
    /**
     * ACTION: addAlbum
     * This method handles what happens when you move to http://yourproject/songs/addalbum
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
            $album_model->addAlbum($_POST["album_id"], $_POST["name"]);
        }

        // where to go after song has been added
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
    public function deleteAlbum($album_id)
    {

        // if we have an id of a song that should be deleted
        if (isset($album_id)) {
            // load model, perform an action on the model
            $album_model = $this->loadModel('AlbumModel');
            $album_model->deleteAlbum($album_id);
        }

        // where to go after song has been deleted
        header('location: ' . URL . 'album/index');
    }

}
