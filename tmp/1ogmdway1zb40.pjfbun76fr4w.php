
<?php echo $this->render('header.html',$this->mime,get_defined_vars()); ?>

<div id="content">
<div class="ch-container">
    <div class="row">
		<?php echo $this->render($view,$this->mime,get_defined_vars()); ?>
    </div>
</div>
</div>
		<?php echo $this->render('footer.html',$this->mime,get_defined_vars()); ?>