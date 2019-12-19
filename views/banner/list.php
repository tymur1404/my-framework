<?php
?>
<form action="/banner/create/" tagret="_blank">
    <input type="hidden" name="_csrf" value="<?=getToken()?>"/>
    <input type='submit'  class='btn btn-round btn-success' value='Add new'/>
</form>

<div class="col-md-8 col-sm-8 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Table of Banners </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Url</th>
              <th>Status</th>
              <th>Position</th>
              <th>Image</th>
              <th>Change position</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($params as $key=>$value){?>
                <tr>
                    <td><?= $value['id'];?></td>
                    <td><?= $value['name'];?></td>
                    <td><?= $value['url'];?></td>
                    <td><?= $value['status'];?></td>
                    <td id="index<?=$value['id']?>" class="form-label"><?= $value['position'];?></td>
                    <td><img class="tbl-banner-img" src="/web/images/banner/<?= $value['img']?>" alt="<?= $value['img']?>"></td>
                    <td>
                        <i class="fa fa-chevron-down down"></i>
                        &nbsp;
                        <i class="fa fa-chevron-up up"></i>
                    </td>
                    <td >
                        <a href="update/<?=$value['id']?>" class="btn btn-round btn-info">Update</a>
                        <input type='button' data-csrf='<?=getToken()?>' data-id='<?=$value['id']?>' class='btn btn-round btn-danger btn-delete' value='Delete'/>
                    </td>
                </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    </div>
</div>
