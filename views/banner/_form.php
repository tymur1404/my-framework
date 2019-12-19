<form  method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" >
    <input type="hidden" name="_csrf" value="<?php echo getToken();?>"/>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Banner name <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input value="<?php echo $params['name'];?>" id="name" class="form-control col-md-7 col-xs-12"
                   name="name" placeholder="Banner name" required="required" type="text">
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">URL <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input value="<?php echo $params['url'];?>" type="url" id="url" name="url" required="required" placeholder="www.website.com" class="form-control col-md-7 col-xs-12">
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status <span class="required">*</span>
        </label>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <input name="status" type="checkbox" class="form-check-input"  <?php echo $params['status'] == 1 ? "checked  " : '';?>>
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="position">Position <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input value="<?php echo $params['position'];?>" type="number" id="position" name="position"
                   required="required"  class="form-control col-md-7 col-xs-12">
        </div>
    </div>
    <?php if($params['img']){?>
        <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Current image
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <img  src="/web/images/banner/<?php echo $params['img'];?>" class="tbl-banner-img" alt="<?php echo $params['img'];?>"/>

            </div>
        </div>
    <?php } ?>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img">Image <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="file"  value="Choose image" name="img" data-target="#pictureBtn"  accept="image/*" />
        </div>
    </div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="form-group">
            <div class="control-label col-md-3 col-sm-3 col-xs-12">
                <a href="/banner/list"  class="btn btn-info">Back</a>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 pt-8">
                <button id="send" type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>

    </div>

</form>