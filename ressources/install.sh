#!/bin/bash
touch /tmp/compilation_openCv_in_progress
echo 0 > /tmp/compilation_openCv_in_progress
echo "*****************************************************************************************************"
echo "*                                Installing additional libraries                                    *"
echo "*****************************************************************************************************"
sudo apt-get -qy update
sudo apt-get -qy upgrade
echo 10 > /tmp/compilation_openCv_in_progress
sudo rm -R /usr/local/src/openCv/
sudo mkdir /usr/local/src/openCv/
sudo chmod -R 777 /usr/local/src/openCv/
sudo apt-get -qy install libtool
echo 20 > /tmp/compilation_openCv_in_progress
echo "*****************************************************************************************************"
echo "*                                            Compile OpenCV:                                        *"
echo "*****************************************************************************************************"
sudo apt-get install -qy libopencv-dev python-opencv
echo 50 > /tmp/compilation_openCv_in_progress
echo "*****************************************************************************************************"
echo "*                                        Compile OpenCV-for-PHP:                                    *"
echo "*****************************************************************************************************"
cd /usr/local/src/openCv/
git clone https://github.com/mgdm/OpenCV-for-PHP.git
cd OpenCV-for-PHP
sudo phpize
./configure 
echo 60 > /tmp/compilation_openCv_in_progress
make
echo 70 > /tmp/compilation_openCv_in_progress
make test
echo 80 > /tmp/compilation_openCv_in_progress
sudo chmod -R 777 /usr/local/src/openCv/
sudo make install
echo 100 > /tmp/compilation_openCv_in_progress
echo "*****************************************************************************************************"
echo "*                                            Fin de l'installation                                      *"
echo "*****************************************************************************************************"
rm /tmp/compilation_openCv_in_progress
