<footer>
    <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Navigate:</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href='https://github.com/damiencal/php-mvc-image-gallery'> GitHub Project</a>
                    </li>
                    <li><a href='https://github.com/damiencal/php-mvc-image-gallery/issues'> Issues</a>
                    </li>
                    <li><a href='http://opensource.org/licenses/MIT'> MIT Licence</a>
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
<script>
$('.menu li a').click(function(e) {
  var $this = $(this);
  if (!$this.hasClass('active')) {
    $this.addClass('active');
  }
  e.preventDefault();
});
</script>
    </body>
</html>
