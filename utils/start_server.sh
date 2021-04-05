#!/bin/bash
source $HOME/Projects/Retail_Assistant/utils/config.sh

cd $APPDIR
tmux new -s $APPSLUG -d
tmux send-keys -t $APPSLUG 'php -S 0.0.0.0:8088' C-m
tmux split-window -v -t $APPSLUG
tmux send-keys -t $APPSLUG 'sass-watch assets/css/style.sass' C-m
tmux select-window -t $APPSLUG:1
tmux attach -t $APPSLUG
