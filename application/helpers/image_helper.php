<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('img_to_base64')) {
    function img_to_base64($path) {
        $fullpath = FCPATH . ltrim($path, '/');
        if (file_exists($fullpath)) {
            $type = pathinfo($fullpath, PATHINFO_EXTENSION);
            $data = file_get_contents($fullpath);
            return 'data:image/' . $type . ';base64,' . base64_encode($data);
        }
        return '';
    }
}