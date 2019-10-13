<div class="module widget-handle mobile-toggle right visible-sm visible-xs">
    <i class="ti-menu"></i>
</div>
<div class="module-group right">
    <div class="module left">
        <ul class="menu">  
        <?php if ( has_nav_menu( 'menu-1' ) ) { ?>                  
        <?php  
            wp_nav_menu(
                array(  
                    'theme_location' => 'menu-1',
                    'menu' => 'Main Navigation', 
                    'container_id' => 'daowa-main-menu', 
                    'walker' => new CSS_Menu_Maker_Walker()
                )
            ); 
        ?>
         <?php } elseif( has_nav_menu( 'social' ) ) { ?>
            <?php get_template_part( 'template-parts/header/sitenav', 'social' ); ?>
         <?php } ?>
        </ul>
    </div>
</div>
<!--end of module group-->




