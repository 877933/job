<?php
/*
  Template Name: Blank Page
 */

get_template_part('backend/theme-components/cs-header/header', 'blank');
?>
<div class="main-section">
    <section class="page-section">
        <!-- Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <!-- Col Md 12 -->
                <div class="col-md-12">
                    <div class="col-md-12">
                        <?php
                        if (have_posts()) {
                            while (have_posts()) {
                                the_post();
                                the_content();
                            } // end while
                        } // end if
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>