<?php

namespace App\Helper;

class LayoutHelper {
    public static function setBreadcrumbs(array $configs){

        foreach($configs as $key => $config){
            if(!$key == count( $configs ) - 1){
                $class = 'breadcrumb-item';
            } else {
                $class = 'breadcrumb-item active';
            }
            $breadcrumbs[] = [
                'name' => $config['name'],
                'link' => $config['link'] ?? 'javascript:void(0)',
                'class' => $class
            ];
        }

        return $breadcrumbs;
    }
}
