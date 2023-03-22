<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row mb-3">
    <div class="col-md-6">
    </div>
    <div class="col-md-6">
      <a href="<?php echo URLROOT; ?>/distributors/add" class="btn btn-primary">
       I need help
      </a>
    </div>
  </div>
  <div class="list-group">
  <?php foreach($data['distributors'] as $distributors) : ?>
    <a href="<?php echo URLROOT; ?>/distributors/show/<?php echo $distributors->id; ?>" class="list-group-item list-group-item-action"><?php echo $distributors->name?></a>
  <?php endforeach; ?>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>