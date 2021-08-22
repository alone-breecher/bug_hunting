#!/bin/bash

#colors
red=`tput setaf 1`
green=`tput setaf 2`
yellow=`tput setaf 3`
blue=`tput setaf 4`
magenta=`tput setaf 5`
reset=`tput sgr0`

read -p "Enter the Domain name : " DOM

if [ -d ~/Desktop ]
then
  echo " "
else
  mkdir ~/Desktop 
fi

if [ -d ~/Desktop/tools ]
then
  echo " "
else
  mkdir ~/Desktop/tools 
fi

if [ -d ~/Desktop/$DOM ]
then
  echo " "
else
  mkdir ~/Desktop/$DOM 
fi

if [ -d ~/Desktop/$DOM/Subdomains ]
then
  echo " "
else
  mkdir ~/Desktop/$DOM/Subdomains 
fi

${reset}"
echo "${blue} [+] Started Subdomain Enumeration ${reset}"
echo " "

#assefinder

if [ -f /usr/bin/assetfinder ]
then
  echo "${magenta} [+] Running Assetfinder for subdomain enumeration${reset}"
  assetfinder -subs-only $DOM  >> ~/Desktop/$DOM/Subdomains/assetfinder.txt 
else
  echo "${blue} [+] Installing Assetfinder ${reset}"
  go get -u github.com/tomnomnom/assetfinder
  echo "${magenta} [+] Running Assetfinder for subdomain enumeration${reset}"
  assetfinder -subs-only $DOM  >> ~/Desktop/$DOM/Subdomains/assetfinder.txt
fi
echo " "
echo "${blue} [+] Succesfully saved as assetfinder.txt  ${reset}"
echo " "

#amass
if [ -f /usr/bin/amass ]
then
  echo "${magenta} [+] Running Amass for subdomain enumeration${reset}"
  amass enum --passive -d $DOM > ~/Desktop/$DOM/Subdomains/amass.txt
else
  echo "${blue} [+] Installing Amass ${reset}"
  echo "${blue} [+] This may take few minutes hang tight... ${reset}"
  go get -u github.com/OWASP/Amass/...
  echo "${magenta} [+] Running Amass for subdomain enumeration${reset}"
  amass enum --passive -d $DOM > ~/Desktop/$DOM/Subdomains/amass.txt
fi
echo " "
echo "${blue} [+] Succesfully saved as amass.txt  ${reset}"
echo " "

#subfinder

if [ -f /usr/bin/subfinder ]
then
  echo "${magenta} [+] Running Subfinder for subdomain enumeration${reset}"
  subfinder -d $DOM -o ~/Desktop/$DOM/Subdomains/subfinder.txt 
else
  echo "${blue} [+] Installing Subfinder ${reset}"
  go get -u -v github.com/projectdiscovery/subfinder/v2/cmd/subfinder
  echo "${magenta} [+] Running Subfinder for subdomain enumeration${reset}"
  subfinder -d $DOM -o ~/Desktop/$DOM/Subdomains/subfinder.txt
fi
echo " "
echo "${blue} [+] Succesfully saved as subfinder.txt  ${reset}"
echo " "

#Sublister
if [ -d /usr/bin/sublist3r ]
then
  echo "${magenta} [+] Running Sublist3r for subdomain enumeration${reset}"
  python sublist3r -d $DOM -t 10 -v -o ~/Desktop/$DOM/Subdomains/sublist3r.txt > /dev/null
else
  echo "${blue} [+] Installing Sublist3r ${reset}"
  echo "${magenta} [+] Running Sublist3r for subdomain enumeration${reset}"
  git clone https://github.com/aboul3la/Sublist3r.git ~/Desktop/tools/Sublist3r/
  python ~/Desktop/tools/Sublist3r/sublist3r.py -d $DOM -t 10 -v -o ~/Desktop/$DOM/Subdomains/sublist3r.txt > /dev/null
fi
echo " "
echo "${blue} [+] Succesfully saved as sublist3r.txt  ${reset}"
echo " "

#uniquesubdomains

echo "${magenta} [+] Fetching unique domains ${reset}"
echo " "
cat ~/Desktop/$DOM/Subdomains/*.txt | sort -u >> ~/Desktop/$DOM/Subdomains/unique.txt
echo "${blue} [+] Succesfully saved as unique.txt ${reset}"
echo " "

#sorting alive subdomains

if [ -f /usr/local/bin/httpx ]
then

  cat ~/Desktop/$DOM/Subdomains/unique.txt | httpx >> ~/Desktop/$DOM/Subdomains/all-alive-subs.txt
  cat ~/Desktop/$DOM/Subdomains/all-alive-subs.txt | sed 's/http\(.?*\)*:\/\///g' | sort -u > ~/Desktop/$DOM/Subdomains/protoless-all-alive-subs.txt
else

  go get -u github.com/projectdiscovery/httpx/cmd/httpx

  cat ~/Desktop/$DOM/Subdomains/unique.txt | httpx >> ~/Desktop/$DOM/Subdomains/all-alive-subs.txt
  cat ~/Desktop/$DOM/Subdomains/all-alive-subs.txt | sed 's/http\(.?*\)*:\/\///g' | sort -u > ~/Desktop/$DOM/Subdomains/protoless-all-alive-subs.txt
fi