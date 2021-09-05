#!/bin/bash

#colors
red=`tput setaf 1`
green=`tput setaf 2`
yellow=`tput setaf 3`
blue=`tput setaf 4`
magenta=`tput setaf 5`
reset=`tput sgr0`

read -p "Enter domain name : " DOM

if [ -d ~/Desktop/ ]
then
  echo " "
else
  mkdir ~/Desktop
fi

if [ -d ~/Desktop/$DOM ]
then
  echo " "
else
  mkdir ~/Desktop/$DOM

fi

if [ -d ~/Desktop/$DOM/Visual_Recon ]
then
  echo " "
else
  mkdir ~/Desktop/$DOM/Visual_Recon

fi


echo "${red}
 =================================================
|   ____  _____  ____ ___  _   _ _                |
|  |  _ \|___ / / ___/ _ \| \ | (_)_______ _ __   |
|  | |_) | |_ \| |  | | | |  \| | |_  / _ \ '__|  |
|  |  _ < ___) | |__| |_| | |\  | |/ /  __/ |     |
|  |_| \_\____/ \____\___/|_| \_|_/___\___|_|     |
|                                                 |
 ================== Alone-Breecher ===============
${reset}"
echo "${blue} [+] Starting Visual Recon ${reset}"
echo " "

#screenshotting
echo "${yellow} ---------------------------------- xxxxxxxx ---------------------------------- ${reset}"
echo " "
if [ -f /usr/local/bin/aquatone ]
then
  echo "${magenta} [+] Running Aquatone for screenshotting alive subdomains${reset}"
  cat ~/Desktop/$DOM/Subdomains/all-alive-subs.txt | aquatone -http-timeout 10000 -scan-timeout 300 -ports xlarge -out ~/Desktop/$DOM/Visual_Recon
else
  echo "${blue} [+] Installing Aquatone ${reset}"
  go get github.com/michenriksen/aquatone
  echo "${magenta} [+] Running Aquatone for screenshotting alive subdomains${reset}"
  cat ~/Desktop/$DOM/Subdomains/all-alive-subs.txt.txt | aquatone -http-timeout 10000 -scan-timeout 300 -ports xlarge -out ~/Desktop/$DOM/Visual_Recon
fi

echo "${yellow} ---------------------------------- xxxxxxxx ---------------------------------- ${reset}"
echo ""
echo "${blue} [+] Successfully saved the results"
echo ""
echo "${yellow} ---------------------------------- xxxxxxxx ---------------------------------- ${reset}"
echo ""
echo "${red} [+] Thank you for using R3C0Nizer${reset}"
echo ""
echo "${yellow} ---------------------------------- xxxxxxxx ---------------------------------- ${reset}"
