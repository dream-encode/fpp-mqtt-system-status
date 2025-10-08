#!/bin/bash
PLUGIN_DIR="/home/fpp/media/plugins/MQTTSystemStatus"
SETTINGS_JSON="$PLUGIN_DIR/settings.json"

BROKER=$(jq -r '.broker' $SETTINGS_JSON)
PORT=$(jq -r '.port' $SETTINGS_JSON)
USER=$(jq -r '.username' $SETTINGS_JSON)
PASS=$(jq -r '.password' $SETTINGS_JSON)
TOPIC=$(jq -r '.topic' $SETTINGS_JSON)
INTERVAL=$(jq -r '.interval' $SETTINGS_JSON)

/usr/bin/python3 $PLUGIN_DIR/mqtt_status_publisher.py "$BROKER" "$PORT" "$USER" "$PASS" "$TOPIC" "$INTERVAL" &
