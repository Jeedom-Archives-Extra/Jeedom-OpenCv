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
sudo apt-get install -y --force-yes build-essential
sudo apt-get install -y --force-yes cmake git libgtk2.0-dev pkg-config libavcodec-dev libavformat-dev libswscale-dev
sudo apt-get install -y --force-yes python-dev python-numpy libtbb2 libtbb-dev libjpeg-dev libpng-dev libtiff-dev libjasper-dev libdc1394-22-dev
echo 40 > /tmp/compilation_openCv_in_progress
sudo rm -R /usr/local/src/openCv/
sudo mkdir /usr/local/src/openCv/
echo "*****************************************************************************************************"
echo "*                                            Compile OpenCV:                                        *"
echo "*****************************************************************************************************"
cd /usr/local/src/openCv/
git clone https://github.com/opencv/opencv.git
cd opencv
mkdir release
cd release
cmake
make
sudo make install
echo "*****************************************************************************************************"
echo "*                                        Compile OpenCV-for-PHP:                                    *"
echo "*****************************************************************************************************"
cd /usr/local/src/openCv/
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
