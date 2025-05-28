#!/bin/bash

#Do useful things

set -m
unitd --no-daemon &
curl -X PUT --data-binary @/config.json --unix-socket /var/run/control.unit.sock http://localhost/config/
fg %1