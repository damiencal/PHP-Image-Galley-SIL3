<div class="modal fade" id="upload_modal">
    <div class="modal-header">
        <h2>Upload Images</h2>
    </div>
    <div class="modal-body">
        <input class="file" id="inputImage" type="file" multiple="true">
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
    </div>
</div>
<footer>
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
                    <li><button type="button" class="btn btn-default btn-sm navbar-btn" href="">Images : <?php echo $amount_of_images; ?></button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    </footer>
        <!-- JavaScript -->
        <script src="<?php echo URL; ?>public/js/jquery.min.js"></script>
        <script src="<?php echo URL; ?>public/js/angularjs.min.js"></script>
        <script src="<?php echo URL; ?>public/js/bootstrap.min.js"></script>
        <script src="<?php echo URL; ?>public/js/application.js"></script>
    </body>
</html>
