<?php
$class = $args['class'] ?? '';
$id = $args['id'] ?? '';
$title = $args['title'] ?? '';
$stepNum = $args['stepNum'] ?? '';
$h2 = $args['h2'] ?? '';
$p = $args['p'] ?? '';
$ico = $args['ico'] ??'';
?>

<section class="text-gray-900 body-font">
<!-- container -->
  <div class="container px-5 py-24 mx-auto flex flex-wrap">
    <!-- step1 -->
    <div class="flex relative pb-20 sm:items-center md:w-2/3 mx-auto">
      <!-- step1 > stepline -->
      <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
         <!-- step1 > stepline-color-->
        <div class="h-full w-1 bg-gray-200 pointer-events-none">
          </div>
          <!-- /step1 > stepline-color-->
      </div>
       <!-- /step1 > stepline -->
       <!-- step1 > step-num -->
      <div class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center bg-blue-500 text-white relative z-10 title-font font-medium text-sm">
      
      <?php $stepNum ?>

        </div>
        <!-- /step1 > step-num -->
        <!-- step1 > step-content -->
      <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
        <!-- step1 > step-content > icon -->
        <div class="flex-shrink-0 w-24 h-24 bg-blue-100 text-blue-500 rounded-full inline-flex items-center justify-center">
        <?php $ico ?>
        </div>
        <!-- /step1 > step-content > icon --> 
        <!-- step1 > step-content > text -->
        <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
          <!-- step1 > step-content > text > h2 -->
          <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">

              <?php $h2 ?>

            </h2>
            <!-- /step1 > step-content > text > h2 -->
            <!-- step1 > step-content > text > p -->
          <p class="leading-relaxed">
          <?php $p ?>
          </p>
            <!-- /step1 > step-content > text > p -->
        </div>
        <!-- /step1 > step-content > text -->
      </div>
        <!-- /step1 > step-content -->
      </div>
    <!-- /step1 -->
    
  </div>
<!-- /container -->
</section>