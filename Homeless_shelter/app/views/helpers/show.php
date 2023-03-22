<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/distributors" class="btn btn-light">Back</a>
<br>
<h1><?php echo $data['distributor']->name; ?></h1>
<p><?php echo $data ['distributor']->email; ?></p>
<?php 
    if($data['distributor']->number != ''){?>
      <p>Team: <?php echo $data['distributor']->number; ?></p>
    <?php } ?>
<hr>
<a href="<?php echo URLROOT; ?>/distributors/edit/<?php echo $data['distributor']->id; ?>" class="btn btn-dark">Edit</a>

  <div class="d-flex justify-content-end">
  <form class="ms-auto" action="<?php echo URLROOT; ?>/distributors/delete/<?php echo $data['distributor']->id; ?>" method="post">
    <input type="submit" value="Delete" class="btn btn-danger">
  </form>
    </div>


<?php require APPROOT . '/views/inc/footer.php'; ?>