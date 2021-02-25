#!/bin/sh
git cat-file blob HEAD:readme.md | markdown > /home/pi/Git/retail-assistant/README.html
