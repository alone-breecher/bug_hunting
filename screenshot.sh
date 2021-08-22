#! /bin/bash

read -p "enter the path to sub domains: " domains

python3 ~/Desktop/bug_finders/EyeWitness/Python/EyeWitness.py -f $domains --web