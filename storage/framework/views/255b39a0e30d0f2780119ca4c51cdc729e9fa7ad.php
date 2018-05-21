<?php if(Session::get('message')): ?>
    <div class="alert alert-<?php echo Session::get('type'); ?>">
      <?php echo Session::get('message'); ?>

    </div>
<?php endif; ?>
