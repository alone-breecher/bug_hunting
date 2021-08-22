#! /bin/bash

read -p "enter the path to sub domains: " domains

if [ -f /usr/local/bin/Eyewitness/python/Eyewitness.py ] 
then
 echo "${magenta} [+] Already installed Eyewitness ${reset}"
else
 echo "${blue} [+] Installing Eyewitness ${reset}"
 cd /usr/local/bin
 git clone https://github.com/FortyNorthSecurity/EyeWitness
fi
echo " "

python3 /usr/local/bin/EyeWitness/Python/EyeWitness.py -f $domains --web
