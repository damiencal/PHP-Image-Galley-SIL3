<br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Image name: <small><?php if (isset($image[0]->name)) echo $image[0]->name; ?></small></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div>
               <a type="button" class="btn btn-xs btn-danger" href="<?php echo URL; ?>gallery/deleteimage/<?php if (isset($image[0]->id)) echo $image[0]->id; ?>"> Delete </a>
                <a type="button" class="btn btn-xs btn-default" href="<?php echo URL; ?>gallery/index/<?php if (isset($image[0]->id)) echo $image[0]->id; ?>"> Previous </a>
                <a type="button" class="btn btn-xs btn-default" href="<?php echo URL; ?>gallery/index/<?php if (isset($image[0]->id)) echo $image[0]->id; ?>"> Next </a>
            </div>
            <img class="img-responsive" src="<?php echo URL; ?><?php if (isset($image[0]->path)) echo $image[0]->path; ?>" alt="<?php if (isset($image[0]->name)) echo $image[0]->name; ?>">
        </div>
        <div class="col-md-4">
            <form class="form-horizontal" action="<?php echo URL; ?>gallery/updateimage/<?php if (isset($image[0]->id)) echo $image[0]->id; ?>" method="POST">
                <fieldset>
                    <legend>Image Description</legend>
                    <div class="form-group">
                        <label for="textArea">Comment</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" name="comment" value="" rows="3" id="textArea"><?php if (isset($image[0]->comment)) echo $image[0]->comment; ?></textarea>
                            <span class="help-block">Leave a comment for the image.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10">
                            <select class="form-control" id="select" name="category">
                                <?php foreach ($categories as $categories) { ?>
                                <option><?php if (isset($image[0]->category)) echo $image[0]->category; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10">
                            <div class="btn-group" role="group" name="vote">
                                <button type="button" class="btn btn-default active">Unlike</button>
                                <button type="button" class="btn btn-default">Like</button>
                            </div>
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
            <h1 class="page-header">Image Gallery</h1>
        </div>
            <?php foreach ($images as $images) { ?>
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <a class="thumbnail" href="<?php echo URL; ?>gallery/index/<?php if (isset($images->id)) echo $images->id; ?>">
                    <img class="img-responsive" src="<?php echo URL; ?><?php if (isset($images->path)) echo $images->path; ?>" alt="<?php if (isset($images->name)) echo $images->name; ?>">
                    </a>
                </div>
            <?php } ?>
</div>
</div>
