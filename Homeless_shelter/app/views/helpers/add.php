<?php require APPROOT . '/views/inc/header.php'; ?>
  <a href="<?php echo URLROOT; ?>/distributors" class="btn btn-light">Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Add your shelter:</h2>
    <form action="<?php echo URLROOT; ?>/distributors/add" method="post">
      <div class="form-group">
        <label for="distributor_name">Shelter name<sup>*</sup></label>
        <input type="text" name="distributor_name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name_err']; ?>">
        <span class="invalid-feedback"><?php echo $data['distributor_name']; ?></span>
      </div>
      <div class="form-group">
        <label for="distributor_number">shelter Email: <sup>*</sup></label>
        <input name="distributor_email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email_err']; ?>">
        <span class="invalid-feedback"><?php echo $data['distributor_email']; ?></span>
      </div>
      <div class="form-group">
        <label for="distributor_number">Shelter number: <sup>*</sup></label>
        <input type="text" name="distributor_number" class="form-control form-control-lg <?php echo (!empty($data['number_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['number_err']; ?>">
        <span class="invalid-feedback"><?php echo $data['distributor_number']; ?></span>
      </div>


      <input type="submit" class="btn btn-success" value="Submit">
    </form>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>