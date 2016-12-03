<?php
$var_arrays = array('cs_page_option');
$cs_options_array_global_vars = CS_JOBCAREER_GLOBALS()->globalizing($var_arrays);
extract($cs_options_array_global_vars);

jobcareer_include_file(ABSPATH . '/wp-admin/includes/file.php');

// Demos
$jobcareer_demo = jobcareer_get_demo_content('jobcareer.json');
$nextjob_demo = jobcareer_get_demo_content('nextjob.json');
$jobstack_demo = jobcareer_get_demo_content('jobstack.json');
$recruiter_demo = jobcareer_get_demo_content('recruiter.json');
$jobdoor_demo = jobcareer_get_demo_content('jobdoor.json');

$cs_page_option[] = array();
$cs_page_option['theme_options'] = array(
    'select' => array(
        'jobcareer' => esc_html__('JobCareer', 'jobcareer'),
        'nextjob' => esc_html__('NextJob', 'jobcareer'),
        'jobstack' => esc_html__('JobStack', 'jobcareer'),
        'recruiter' => esc_html__('Recruiter', 'jobcareer'),
        'jobdoor' => esc_html__('JobDoor', 'jobcareer'),
    ),
    'jobcareer' => array(
        'name' => esc_html__('JobCareer', 'jobcareer'),
        'page_slug' => 'jobcareer',
        'theme_option' => $jobcareer_demo,
        'thumb' => 'Import-JobCareer-Data'
    ),
    'nextjob' => array(
        'name' => esc_html__('NextJob', 'jobcareer'),
        'page_slug' => 'nextjob',
        'theme_option' => $nextjob_demo,
        'thumb' => 'Import-NextJob-Data'
    ),
    'jobstack' => array(
        'name' => esc_html__('JobStack', 'jobcareer'),
        'page_slug' => 'jobstack',
        'theme_option' => $jobstack_demo,
        'thumb' => 'Import-JobStack-Data'
    ),
    'recruiter' => array(
        'name' => esc_html__('Recruiter', 'jobcareer'),
        'page_slug' => 'recruiter',
        'theme_option' => $recruiter_demo,
        'thumb' => 'Import-Recruiter-Data'
    ),
    'jobdoor' => array(
        'name' => esc_html__('JobDoor', 'jobcareer'),
        'page_slug' => 'jobdoor',
        'theme_option' => $jobdoor_demo,
        'thumb' => 'Import-JobDoor-Data'
    ),
);
