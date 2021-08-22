
#!/bin/bash


#colors
red=`tput setaf 1`
green=`tput setaf 2`
yellow=`tput setaf 3`
blue=`tput setaf 4`
magenta=`tput setaf 5`
reset=`tput sgr0`



read -p "Enter domain name : " DOM

read -p "enter the subdomains path : " subdoamins_path


if [ -d ~/jsrecon ]
then
  echo " "
else
  mkdir ~/jsrecon
fi

if [ -d ~/jsrecon/$DOM ]
then
  echo " "
else
  mkdir ~/jsrecon/$DOM
fi

if [ -d ~/jsrecon/$DOM/Archivescan ]
then
  echo " "
else
  mkdir ~/jsrecon/$DOM/Archivescan
fi

if [ -d ~/jsrecon/$DOM/JSscan ]
then
  echo " "
else
  mkdir ~/jsrecon/$DOM/JSscan
fi

echo "${blue} [+] Started Scanning for JS files ${reset}"
echo " "


#wayback_URL
echo "${yellow} ---------------------------------- xxxxxxxx ---------------------------------- ${reset}"
echo " "
if [ -f /usr/local/bin/waybackurls ] 
then
 echo "${magenta} [+] Already installed Waybackurls ${reset}"
else
 echo "${blue} [+] Installing Waybackurls ${reset}"
 go get -u github.com/tomnomnom/waybackurls
fi
echo " "
if [ -f ~/jsrecon/$DOM/Archivescan/waybackurls.txt ]
then
 echo "${magenta} [+] Already done Waybackurls ${reset}"
else
 echo "${blue} [+] Running Waybackurls for finding archive based assets${reset}"
 cat  $subdoamins_path | waybackurls >> ~/jsrecon/$DOM/Archivescan/waybackurls.txt 
 echo "${blue} [+] Succesfully saved as waybackurls.txt ${reset}"
fi
echo " "

#Gau
echo "${yellow} ---------------------------------- xxxxxxxx ---------------------------------- ${reset}"
echo " "
if [ -f /usr/local/bin/gua ]
then
 echo "${magenta} [+] Already installed Gau ${reset}"
else
 echo "${blue} [+] Installing Gau ${reset}"
 go get -u github.com/lc/gau
fi
echo " "
if [ -f ~/jsrecon/$DOM/Archivescan/gau.txt ]
then
 echo "${magenta} [+] Already done Gau ${reset}"
else
 echo "${blue} [+] Running Gau for finding archive based assets${reset}"
 cat  $subdoamins_path | gau >> ~/jsrecon/$DOM/Archivescan/gau.txt
 echo "${blue} [+] Succesfully saved as gau.txt ${reset}"
fi
echo " "

#uniquesubdomains
echo "${yellow} ---------------------------------- xxxxxxxx ---------------------------------- ${reset}"
echo " "
if [ -f /$DOM/Archivescan/sorted.txt ]
then
 echo " "
else
 cat ~/jsrecon/$DOM/Archivescan/waybackurls.txt ~/jsrecon/$DOM/Archivescan/gau.txt | sort -u >> ~/jsrecon/$DOM/Archivescan/sorted.txt
 echo "${blue} [+] Succesfully saved as sorted.txt ${reset}"
 echo " "
fi

#Gathering Js Files
echo "${yellow} ---------------------------------- xxxxxxxx ---------------------------------- ${reset}"
echo " "
echo "${blue} [+] Checking for dependencies ${reset}"
if [ -f /usr/local/bin/httpx ]
then
  echo "${blue} [+] Installing httpx ${reset}"
  go get -u github.com/projectdiscovery/httpx/cmd/httpx
else
  echo "${magenta} [+] Already installed httpx ${reset}"
fi
if [ -f /usr/local/bin/anew ]
then
  echo "${blue} [+] Installing anew ${reset}"
  go get -u github.com/tomnomnom/anew
else
  echo "${magenta} [+] Already installed anew ${reset}"
fi
if [ -f /usr/local/bin/subjs ]
then
  echo "${blue} [+] Installing subjs ${reset}"
  go get -u github.com/lc/subjs
else
  echo "${magenta} [+] Already installed subjs ${reset}"
fi

echo " "
echo "${blue} [+] Started Gathering Live JsFiles-links ${reset}"
echo " "
cat ~/jsrecon/$DOM/Archivescan/sorted.txt | grep -iE "\.js$" | uniq | sort >> ~/jsrecon/$DOM/JSscan/mixed_jsfile_links_from_archives.txt
cat ~/jsrecon/$DOM/JSscan/mixed_jsfile_links_from_archives.txt | httpx -silent >> ~/jsrecon/$DOM/JSscan/jsfile_links_from_archives.txt
cat $subdoamins_path | httpx -silent | subjs | anew | tee -a ~/jsrecon/$DOM/JSscan/jsfile_links_from_subjs.txt
rm -rf ~/jsrecon/$DOM/JSscan/mixed_jsfile_links_from_archives.txt
cat ~/jsrecon/$DOM/JSscan/jsfile_links_from_archives.txt ~/jsrecon/$DOM/JSscan/jsfile_links_from_subjs.txt | sort -u > result.txt

##############################
#END OF JSscan
##############################

