<?php
if (have_rows('modules')) :
    while (have_rows('modules')) : the_row();
        if (get_row_layout() == 'module1') :
            get_template_part('template-parts/module1');
        elseif (get_row_layout() == 'module2') :
            get_template_part('template-parts/module2');

        // elseif (get_row_layout() == 'three_title_module') :
        //     get_template_part('template-parts/three-title-module');
        endif;
    endwhile;
endif;
