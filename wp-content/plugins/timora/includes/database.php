<?php


function create_timora_booking_table()
{
    include_once ABSPATH . "wp-admin/includes/upgrade.php";

    global $wpdb;

    $table_name = $wpdb->prefix . "timora_bookings";

    $charset_collate = $wpdb->get_charset_collate();

    $sql_query = "
        CREATE TABLE $table_name (
            id BIGINT (20) UNSIGNED NOT NULL AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL,
            surname VARCHAR(100) NOT NULL,
            phone VARCHAR(50) NOT NULL,
            email VARCHAR(150) NOT NULL,
            booking_date DATE NOT NULL,
            booking_time TIME NOT NULL,
            notes TEXT,
            service_id BIGINT (20) UNSIGNED NOT NULL,
            created_at DATETIME NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;
    ";

    dbDelta($sql_query);
}
