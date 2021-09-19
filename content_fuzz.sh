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
 


if [ -d ~/Desktop/$DOM/Content_Discovery ]
then
  echo " "
else
  mkdir ~/Desktop/$DOM/Content_Discovery
 
fi
 
 
echo "${blue} [+] Started Content Discovery Scanning ${reset}"
echo " "

#wordlist
echo "${yellow} ---------------------------------- xxxxxxxx ---------------------------------- ${reset}"
echo " "
if [ -f ~/Desktop/critical_files.txt ]
then
 echo " "
else
 echo "${blue} [+] Downloading wordlists ${reset}"
 wget https://raw.githubusercontent.com/v0re/dirb/master/wordlists/common.txt -P ~/Desktop/tools/
fi

#feroxbuster
if [ -f /usr/bin/feroxbuster ]
then
 echo "${magenta} [+] Running Feroxbuster for content discovery${reset}"
 for url in $(cat ~/Desktop/$DOM/Subdomains/all-alive-subs.txt);do
 reg=$(echo $url | sed -e 's;https\?://;;' | sed -e 's;/.*$;;')
 feroxbuster --url $url -w ~/Desktop/critical_files.txt -x php asp aspx jsp py txt conf config bak backup swp old db zip sql --depth 3 --threads 300 --output ~/Desktop/$DOM/Content_Discovery/content_discovery_result.txt
done
else
 echo "${blue} [+] Installing Feroxbuster ${reset}"
 wget https://github.com/epi052/feroxbuster/releases/download/v1.5.2/x86_64-linux-feroxbuster.zip -P ~/Desktop/tools/feroxbuster
 unzip ~/Desktop/tools/feroxbuster/x86_64-linux-feroxbuster.zip -d ~/go/bin/
 chmod 777 ~/go/bin/feroxbuster
 echo "${magenta} [+] Running Feroxbuster for content discovery${reset}"
 for url in $(cat ~/Desktop/$DOM/Subdomains/all-alive-subs.txt);do
 reg=$(echo $url | sed -e 's;https\?://;;' | sed -e 's;/.*$;;')
 feroxbuster --url $url -w ~/Desktop/critical_files.txt -x php asp aspx jsp py txt conf config bak backup swp old db zip sql --depth 3 --threads 300 --output ~/Desktop/$DOM/Content_Discovery/content_discovery_result.txt
done
fi

echo "${yellow} ---------------------------------- xxxxxxxx ---------------------------------- ${reset}"
echo " "
echo "${blue} [+] Succesfully saved as content_discovery_result.txt ${reset}"
echo " "
echo "${yellow} ---------------------------------- xxxxxxxx ---------------------------------- ${reset}"
echo " "
echo "${magenta} [+] Sorting According to Status Codes ${reset}"
cat ~/Desktop/$DOM/Content_Discovery/content_discovery_result.txt | grep 200 | awk '{print $2}' > ~/Desktop/$DOM/Content_Discovery/status_code_200.txt  
cat ~/Desktop/$DOM/Content_Discovery/content_discovery_result.txt | grep 204 | awk '{print $2}' > ~/Desktop/$DOM/Content_Discovery/status_code_204.txt
cat ~/Desktop/$DOM/Content_Discovery/content_discovery_result.txt | grep 301 | awk '{print $2}' > ~/Desktop/$DOM/Content_Discovery/status_code_301.txt
cat ~/Desktop/$DOM/Content_Discovery/content_discovery_result.txt | grep 302 | awk '{print $2}' > ~/Desktop/$DOM/Content_Discovery/status_code_302.txt
cat ~/Desktop/$DOM/Content_Discovery/content_discovery_result.txt | grep 307 | awk '{print $2}' > ~/Desktop/$DOM/Content_Discovery/status_code_307.txt
cat ~/Desktop/$DOM/Content_Discovery/content_discovery_result.txt | grep 308 | awk '{print $2}' > ~/Desktop/$DOM/Content_Discovery/status_code_308.txt
cat ~/Desktop/$DOM/Content_Discovery/content_discovery_result.txt | grep 401 | awk '{print $2}' > ~/Desktop/$DOM/Content_Discovery/status_code_401.txt
cat ~/Desktop/$DOM/Content_Discovery/content_discovery_result.txt | grep 403 | awk '{print $2}' > ~/Desktop/$DOM/Content_Discovery/status_code_403.txt
cat ~/Desktop/$DOM/Content_Discovery/content_discovery_result.txt | grep 405 | awk '{print $2}' > ~/Desktop/$DOM/Content_Discovery/status_code_405.txt
echo " "
echo "${yellow} ---------------------------------- xxxxxxxx ---------------------------------- ${reset}"
echo " "
echo "${blue} [+] Succesfully saved the results according to their status codes ${reset}"
echo " "
echo "${yellow} ---------------------------------- xxxxxxxx ---------------------------------- ${reset}"


