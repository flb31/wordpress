<?php

function meta_boxes_demo( $meta_boxes ) {
    $id = Conf::POSTYPE_DEMO;
    $prefix = Conf::PREFIX_DEMO;
    $text =  Conf::$POST_TYPES[Conf::POSTYPE_DEMO]['singular_label'];
    
    $meta_boxes[] = array(
        'id'         => $id,
        'title'      => __( 'Módulo ' . $text, Conf::TEXT_DOMAIN ),
        'post_types' => array( $id ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            
            array(
                'name'  => __( 'Logo', Conf::TEXT_DOMAIN ),
                'id'    => $prefix . 'logo',
                'mime_type' => array('image/png', 'image/jpeg'),
                'type'  => 'image_advanced',
                'clone' => false,
            ),
            array(
                'name' => __( 'Descripción', Conf::TEXT_DOMAIN ),
                'id'   => $prefix . 'description',
                'type' => 'wysiwyg',
                'clone' => false
            ),
        ),
    );

    return $meta_boxes;
}

