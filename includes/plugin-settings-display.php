<?php

function ak_add_settings_page() {
    add_options_page( 'AK Tmdb info page', 'AK Tmdb info API', 'manage_options', 'ak-plugin', 'ak_render_plugin_settings_page' );
}
add_action( 'admin_menu', 'ak_add_settings_page' );
add_action( 'admin_init', 'ak_register_settings' );
function ak_render_plugin_settings_page() {
    ?>
    <h2>Example Plugin Settings</h2>
    <form action="options.php" method="post">
        <?php 
        settings_fields( 'ak_plugin_options' );
        do_settings_sections( 'ak_plugin' ); ?>
        <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save' ); ?>" />
    </form>
    <?php
}
function ak_register_settings() {
    register_setting( 'ak_plugin_options', 'ak_plugin_options', 'ak_plugin_options_validate' );
    add_settings_section( 'api_settings', 'API Settings', 'ak_plugin_section_text', 'ak_plugin' );
    add_settings_field( 'ak_plugin_setting_api_key', 'API Key', 'ak_plugin_setting_api_key', 'ak_plugin', 'api_settings' );
}

function ak_plugin_section_text() {
    echo '<p>Here you can set all the options for using the API</p>';
}

function ak_plugin_setting_api_key() {
    $options = get_option( 'ak_plugin_options' );
    echo "<input id='ak_plugin_setting_api_key' name='ak_plugin_options[api_key]' type='text' value='" . esc_attr( $options['api_key'] ) . "' />";
}


function ak_plugin_options_validate( $input ) {
    $newinput['api_key'] = trim( $input['api_key'] );
    if ( ! preg_match( '/^[a-z0-9]{32}$/i', $newinput['api_key'] ) ) {
        $newinput['api_key'] = '';
    }

    return $newinput;
}


?>