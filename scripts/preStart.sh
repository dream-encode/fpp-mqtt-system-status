#!/bin/bash
# Called right before FPP starts playback.

PLUGIN_DIR="/home/fpp/media/plugins/fpp-mqtt-system-status"
SETTINGS_FILE="$PLUGIN_DIR/settings.json"

if [ ! -f "$SETTINGS_FILE" ]; then
    echo "No settings.json found, skipping MQTT startup"
    exit 0
fi

BROKER=$(jq -r '.broker' $SETTINGS_FILE)
PORT=$(jq -r '.port' $SETTINGS_FILE)
USER=$(jq -r '.username' $SETTINGS_FILE)
PASS=$(jq -r '.password' $SETTINGS_FILE)
TOPIC=$(jq -r '.topic' $SETTINGS_FILE)
INTERVAL=$(jq -r '.interval' $SETTINGS_FILE)

pkill -f mqtt_status_publisher.py 2>/dev/null

/usr/bin/python3 $PLUGIN_DIR/scripts/mqtt_status_publisher.py "$BROKER" "$PORT" "$USER" "$PASS" "$TOPIC" "$INTERVAL" &
