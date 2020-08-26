<?php

require_once '../../resources/system/db_config.php';
require_once '../../resources/services/configuration_service.php';

function wp_post($wp_post_author,$wp_post_content,$wp_post_title,$wp_post_name)
{
    $wp_db_host = getWPDbHost(); // Database Host
    $wp_db_user = getWPDbUser(); //  Database User
    $wp_db_password = getWPDbPassword();  //  Database Password
    $wp_db_name = getWPDbName(); // Database Name

    $wp_connection = mysqli_connect($wp_db_host, $wp_db_user, $wp_db_password, $wp_db_name);
    mysqli_query($wp_connection, "set names utf8");

    $wp_blog_url = getWPURL();
    $wp_post_date = date('Y-m-d H:i:s');
    $wp_post_date_gmt = date('Y-m-d H:i:s');
    $wp_post_modified = date('Y-m-d H:i:s');
    $wp_post_modified_gmt = date('Y-m-d H:i:s');
    $url_name = $wp_post_name;
    $url_name = str_replace(" ", "-", $url_name);
    $wp_guid = $wp_blog_url . date('Y/m/d') . '/' . urlencode($url_name) . '/';


    mysqli_query($wp_connection, "
INSERT INTO `wp_posts` (
`post_author`,
`post_date`,
`post_date_gmt`,
`post_content`,
`post_title`,
`post_name`,
`post_modified`,
`post_modified_gmt`,
 `guid`) VALUES (
 '$wp_post_author',
 '$wp_post_date',
 '$wp_post_date_gmt',
 '$wp_post_content',
 '$wp_post_title',
 '".urlencode($url_name)."',
 '$wp_post_modified',
 '$wp_post_modified_gmt',
 '$wp_guid')
", MYSQLI_ASSOC);
}