#!/bin/bash

# Update and upgrade system
apt-get update && apt-get -y upgrade

# Install Java
apt install -y openjdk-8-jdk

# Install Jenkins
wget -q -O - https://pkg.jenkins.io/debian-stable/jenkins.io.key | apt-key add -
sh -c 'echo deb https://pkg.jenkins.io/debian-stable binary/ > \
    /etc/apt/sources.list.d/jenkins.list'
apt-get update
apt-get install -y jenkins

# Add Jenkins on startup
systemctl enable jenkins
