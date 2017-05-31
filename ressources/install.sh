#!/bin/bash
touch /tmp/compilation_openCv_in_progress
echo 0 > /tmp/compilation_openCv_in_progress
echo "*****************************************************************************************************"
echo "*                                Installing additional libraries                                    *"
echo "*****************************************************************************************************"
sudo apt-get -y --force-yes update
sudo apt-get -y --force-yes upgrade
echo 10 > /tmp/compilation_openCv_in_progress
sudo apt-get install -y --force-yes autoconf automake libtool
sudo apt-get install -y --force-yes pkg-config
sudo apt-get install -y --force-yes git
sudo apt-get install -y --force-yes git-core
sudo apt-get install -y --force-yes cmake
sudo apt-get install -y --force-yes libopencv-dev
echo 40 > /tmp/compilation_openCv_in_progress
mkdir /usr/local/src/openCv/
mkdir /etc/openCv/
cd /usr/local/src/openCv/
echo "*****************************************************************************************************"
echo "*                                            Compile OpenCV-for-PHP:                                      *"
echo "*****************************************************************************************************"
git clone https://github.com/ProGM/OpenCV-for-PHP.git
cd OpenCV-for-PHP
phpize
./configure && make
make test
sudo make install
echo 100 > /tmp/compilation_openCv_in_progress
echo "*****************************************************************************************************"
echo "*                                            Fin de l'installation                                      *"
echo "*****************************************************************************************************"
rm /tmp/compilation_openCv_in_progress
