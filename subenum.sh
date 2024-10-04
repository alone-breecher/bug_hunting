#!/bin/bash

#colors
red=`tput setaf 1`
green=`tput setaf 2`
yellow=`tput setaf 3`
blue=`tput setaf 4`
magenta=`tput setaf 5`
reset=`tput sgr0`

usage() {
    echo "Usage: $0 [-d domain] [-f filename]"
    exit 1
}

# Parse command-line options
while getopts ":d:f:" opt; do
    case $opt in
        d) DOM=$OPTARG ;;
        f) FILE=$OPTARG ;;
        *) usage ;;
    esac
done

if [ -z "$DOM" ] && [ -z "$FILE" ]; then
    usage
fi

# Function to run subdomain enumeration for a single domain
run_subdomain_enum() {
    local domain=$1
    local output_path=~/Desktop/$domain/Subdomains

    # Create the directory for the domain
    mkdir -p $output_path

    echo "${blue} [+] Started Subdomain Enumeration for $domain ${reset}"
    
    # Assetfinder
    echo "${magenta} [+] Running Assetfinder ${reset}"
    assetfinder -subs-only $domain >> $output_path/assetfinder.txt

    # Amass
    echo "${magenta} [+] Running Amass ${reset}"
    amass enum --passive -d $domain > $output_path/amass.txt

    # Subfinder
    echo "${magenta} [+] Running Subfinder ${reset}"
    subfinder -d $domain -o $output_path/subfinder.txt

    # Fetch unique domains
    echo "${magenta} [+] Fetching unique subdomains ${reset}"
    cat $output_path/*.txt | sort -u >> $output_path/unique.txt

    # Sorting alive subdomains using httpx
    echo "${magenta} [+] Running Httpx for alive subdomains ${reset}"
    cat $output_path/unique.txt | httpx -ip -cname -td -location -title -wc >> $output_path/all-alive-subs.txt
    cat $output_path/all-alive-subs.txt | sed 's/http\(.?*\)*:\/\///g' | sort -u > $output_path/more-info-all-alive-subs.txt

     # Sorting alive subdomains using httpx  with more info
    echo "${magenta} [+] Running Httpx for informations ${reset}"
    cat $output_path/unique.txt | httpx -sc - >> $output_path/all-alive-subs.txt
    
    echo "${blue} [+] Subdomain enumeration completed for $domain ${reset}"
    echo ""

    # Run Visual Recon using Aquatone
    echo "${magenta} [+] Running Visual Recon using Aquatone for $domain ${reset}"
    cat $output_path/all-alive-subs.txt | aquatone -http-timeout 10000 -scan-timeout 300 -ports xlarge -out $output_path/Visual_Recon < $output_path/all-alive-subs.txt
    echo "${blue} [+] Visual Recon completed and saved in Visual_Recon directory ${reset}"
}

# If a single domain is provided
if [ ! -z "$DOM" ]; then
    run_subdomain_enum $DOM
fi

# If a file with multiple domains is provided
if [ ! -z "$FILE" ]; then
    while IFS= read -r domain; do
        run_subdomain_enum $domain
    done < "$FILE"
fi
