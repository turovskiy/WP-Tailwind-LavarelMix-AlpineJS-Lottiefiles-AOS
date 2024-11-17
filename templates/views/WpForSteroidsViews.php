
<?php
$class = $args['class'] ?? '';
$id = $args['id'] ?? '';
$title = $args['title'] ?? '';
$text = $args['text'] ?? '';
?>
<div class="WpForSteroidsViews<?= $class ?>" id="<?= $id ?>">

	<?php if ( $title ): ?>
		<h2 data-aos="fade-up-right" 
		    class="pt-8 
		           text-2xl 
				   font-extrabold 
				   text-blue-600 
				   sm:text-3xl"
				   >

				   <?= $title ?>
				
				</h2>

	<?php endif; ?>

	<?php if ( $text ): ?>
		<p data-aos="fade-left"  
		    class="mt-4 
		          text-lg 
				  leading-6 
				  font-extrabold 
				  text-indigo-600"
				  >

				  <?= $text ?>
				
				</p>

	<?php endif; ?>



</div>