<div class="modal fade" id="upload_modal" >
    <form action="<?php echo URL; ?>gallery/addimage" method="POST">
    <div class="modal-header">
        <h2>Upload Images</h2>
    </div>
    <div class="modal-body">
        <input class="file" id="inputImage" type="file" multiple="true">
    </div>
    <div class="modal-footer">
        <input type="submit" name="submit_add_image" value="Submit" />
<!--        <a href="gallery/add" class="btn" data-dismiss="modal">Close</a>-->
    </div>
    </form>
</div>
<footer class="footer">
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
                <ul class="nav navbar-nav">
                    <li><a target="_blank" href='https://github.com/damiencal/PHP-Image-Galley-SIL3'> GitHub Project</a>
                    </li>
                    <li><a target="_blank" href='https://github.com/damiencal/PHP-Image-Galley-SIL3/issues'> Issues</a>
                    </li>
                    <li><a target="_blank" href='http://opensource.org/licenses/MIT'> MIT Licence</a>
                    </li>
                    <li><button type="button" class="btn btn-default btn-sm navbar-btn" href="#upload_modal" data-toggle="modal">Add Images</button>
                    </li>

                </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><button type="button" class="btn btn-default btn-sm navbar-btn" href="home/about">Images : <?php echo $amount_of_images; ?></button>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    </footer>
        <!-- JavaScript -->
        <script src="<?php echo URL; ?>public/js/application.min.js"></script>
    </body>
</html>
