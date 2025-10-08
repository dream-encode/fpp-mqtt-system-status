<?php
$pluginName = basename(__DIR__);

/**
 * Called by FPP when plugin is first loaded.
 */
function fpp_mqtt_system_status_Initialize()
{
    $settings = [
        'broker'   => ['default' => '192.168.1.10', 'description' => 'MQTT Broker Host'],
        'port'     => ['default' => '1883',          'description' => 'MQTT Port'],
        'username' => ['default' => 'fpp',           'description' => 'MQTT Username'],
        'password' => ['default' => '',              'description' => 'MQTT Password'],
        'topic'    => ['default' => 'fpp/system/status', 'description' => 'MQTT Topic'],
        'interval' => ['default' => '2',             'description' => 'Polling Interval (seconds)']
    ];
    RegisterPluginSettings($pluginName, $settings);
}

/**
 * Called by FPP when plugin starts.
 */
function fpp_mqtt_system_status_Start()
{
    $pluginName = basename(__DIR__);
    $settings = ParsePluginSettings($pluginName);
    $cmd = "/home/fpp/media/plugins/$pluginName/start.sh";
    exec("$cmd > /dev/null 2>&1 &");
}

/**
 * Called by FPP when plugin stops.
 */
function fpp_mqtt_system_status_Stop()
{
    exec("pkill -f mqtt_status_publisher.py");
}
?>
