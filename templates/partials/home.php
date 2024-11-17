<div 
    class="
	flex 
	flex-row
	items-center 
	justify-center" >

     <div class=" max-w-2xl 
	            px-4 
				py-16 
				mx-auto 
				text-center 
				sm:py-20 
				sm:px-6 
				lg:px-8 "
				> 
		<h2 class="text-5xl 
		           font-extrabold 
				   text-indigo-800 
				   sm:text-4xl"
				   >
			<p data-aos="fade-left"  class=""><?php bloginfo('name'); ?> <br>
		<?php bloginfo('description'); ?>
		</p>
		</h2>
		<div x-data="{ open: false }" >
    <button @click="open = ! open">Toggle Content</button>
    <div x-show="open">
		<section>
    <?php
	get_template_part( 'templates/views/StepsView', null, [
		'title' => 'steper!',
		'text' => '',
		'stepNum' => '1',
		'h2' => 'h2',
		'p' => 'абзац',
		'ico' => '<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-12 h-12" viewBox="0 0 24 24">
		<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
	  </svg>',


	] ) 

?></section>
</div>
</div>

	</div>
</div>





