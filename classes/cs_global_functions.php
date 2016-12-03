<?php

/**
 * File Type: Global Varibles Functions
 */
if (!class_exists('jobcareer_global_functions')) {

    class jobcareer_global_functions {

        // The single instance of the class
        protected static $_instance = null;

        public function __construct() {
            // Do something cool...
        }

        public static function instance() {
            if (is_null(self::$_instance)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function theme_options() {
            global $jobcareer_options;

            return $jobcareer_options;
        }

        public function globalizing($var_array = array()) {
            if (is_array($var_array) && sizeof($var_array) > 0) {
                $return_array = array();
                foreach ($var_array as $value) {
                    global $$value;
                    $return_array[$value] = $$value;
                }
                return $return_array;
            }
        }
        
        public function translate($index = '', $variable = '') {
            
            $trans_strings = array(
                'submit_now' => esc_html__('Submit Now', 'jobcareer'),
                'number_search_results' => sprintf(esc_html__('Search Results : %s', 'jobcareer'), $variable),
            );
            return isset($trans_strings[$index]) ? $trans_strings[$index] : '';
        }

    }

    function CS_JOBCAREER_GLOBALS() {
        return jobcareer_global_functions::instance();
    }

    $GLOBALS['jobcareer_global_functions'] = CS_JOBCAREER_GLOBALS();
}