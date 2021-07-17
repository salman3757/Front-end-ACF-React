<?php

function generateHTML($id){


  // Using Post-ID value from index.js file's Attributes, Query the Database for post 
  
  $post= new WP_Query(array(
    'post_type'=>'block',
    'p'=>$id
  ));

  while($post->have_posts()){
    $post->the_post();

    // Get Values of Custom Fields

    $headerText=get_field('header_text');
    $headerImage=get_field('header_image')['url'];
    $tileColor=get_field('tile_color');

    $title=get_field('title');
    $text=get_field('text');
    $textBlockAlignment=get_field('text_block_alignment');
    $backgroundImage=get_field('background_image')['url'];

    $margin=($textBlockAlignment=='Left'? 20:320 );

ob_start();
    ?> 
    
       <div style="background-color:<?php echo $tileColor; ?>; border:2px solid black; height:40rem; width:38.1rem">
               <div style="display:flex; height:7rem; background-color:<?php echo $tileColor; ?>; border-bottom:2px solid black">
                   <h4 style="position:absolute; margin-left:10px; margin-top:66px ; color:white"><?php echo $headerText ; ?> </h4><div style="position:absolute; margin-left:450px; margin-top:35px">
                    <img src="<?php echo $headerImage; ?>" height=70px width=100px /></div>
                </div>
                      <div style="display:flex;  background-image:url(<?php echo $backgroundImage; ?>) ;  overflow:hidden; height:32.8rem">
                      <div    style=" padding:5px; padding-left:8px; overflow-y:scroll; overflow-x:hidden;  margin-left: <?php echo $margin; ?>px ; margin-top:28px; border:2px solid white; border-radius:10px; background:rgba(255,255,255,0.8);  color:#222; width:17rem; height:25rem; font-size:0.9rem">
                      <h4><?php echo $title; ?></h4>
                      <br>    
                      <p>
                        <?php echo $text; ?>
                      </p>
                      </div>
               </div>
      </div> 
       
      
      <?php

      wp_reset_postdata();
      return ob_get_clean();

  }
}