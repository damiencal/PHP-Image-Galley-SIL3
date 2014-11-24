<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Image name: <small><?php if (isset($image[0]->name)) echo $image[0]->name; ?></small></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <img class="img-responsive" src="<?php if (isset($image[0]->path)) echo $image[0]->path; ?>" alt="">
        </div>
        <div class="col-md-4">
            <form class="form-horizontal" action="<?php echo URL; ?>gallery/updateimage" method="POST">
                <fieldset>
                    <legend>Image Description</legend>
                    <div class="form-group">
                        <label for="textArea">Comment</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" name="comment" value="" rows="3" id="textArea"></textarea>
                            <span class="help-block">Leave a comment for the image.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Category</label>
                        <div class="col-lg-10">
                            <select class="form-control" id="select">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="submit_update_image" value="Submit">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Related images</h3>
        </div>
        <div class="col-sm-3 col-xs-6">
            <a href="#">
                <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
            </a>
        </div>
        <div class="col-sm-3 col-xs-6">
            <a href="#">
                <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
            </a>
        </div>
        <div class="col-sm-3 col-xs-6">
            <a href="#">
                <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
            </a>
        </div>
        <div class="col-sm-3 col-xs-6">
            <a href="#">
                <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
            </a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Image Gallery</h1>
        </div>
            <?php foreach ($images as $images) { ?>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="gallery/getimage/<?php if (isset($images->id)) echo $images->id; ?>">
                    <img class="img-responsive" src="<?php echo URL; ?><?php if (isset($images->path)) echo $images->path; ?>" alt="<?php if (isset($images->name)) echo $images->name; ?>">
                    </a>
                </div>
            <?php } ?>
</div>
</div>
