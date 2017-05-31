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
sudo apt-get install -y --force-yes libopencv_video
sudo apt-get install -y --force-yes libcv-dev
sudo apt-get install -y --force-yes libcv2.4
sudo apt-get install -y --force-yes libcvaux-dev
sudo apt-get install -y --force-yes libcvaux2.4
sudo apt-get install -y --force-yes libhighgui-dev
sudo apt-get install -y --force-yes libhighgui2.4
sudo apt-get install -y --force-yes libopencv-calib3d-dev
sudo apt-get install -y --force-yes libopencv-calib3d2.4
sudo apt-get install -y --force-yes libopencv-contrib-dev
sudo apt-get install -y --force-yes libopencv-contrib2.4
sudo apt-get install -y --force-yes libopencv-core-dev
sudo apt-get install -y --force-yes libopencv-core2.4
sudo apt-get install -y --force-yes libopencv-dev
sudo apt-get install -y --force-yes libopencv-features2d-dev
sudo apt-get install -y --force-yes libopencv-features2d2.4
sudo apt-get install -y --force-yes libopencv-flann-dev
sudo apt-get install -y --force-yes libopencv-flann2.4
sudo apt-get install -y --force-yes libopencv-gpu-dev
sudo apt-get install -y --force-yes libopencv-gpu2.4
sudo apt-get install -y --force-yes libopencv-highgui-dev
sudo apt-get install -y --force-yes libopencv-highgui2.4
sudo apt-get install -y --force-yes libopencv-imgproc-dev
sudo apt-get install -y --force-yes libopencv-imgproc2.4
sudo apt-get install -y --force-yes libopencv-legacy-dev
sudo apt-get install -y --force-yes libopencv-legacy2.4
sudo apt-get install -y --force-yes libopencv-ml-dev
sudo apt-get install -y --force-yes libopencv-ml2.4
sudo apt-get install -y --force-yes libopencv-objdetect-dev
sudo apt-get install -y --force-yes libopencv-objdetect2.4
sudo apt-get install -y --force-yes libopencv-ocl-dev
sudo apt-get install -y --force-yes libopencv-ocl2.4
sudo apt-get install -y --force-yes libopencv-photo-dev
sudo apt-get install -y --force-yes libopencv-photo2.4
sudo apt-get install -y --force-yes libopencv-stitching-dev
sudo apt-get install -y --force-yes libopencv-stitching2.4
sudo apt-get install -y --force-yes libopencv-superres-dev
sudo apt-get install -y --force-yes libopencv-superres2.4
sudo apt-get install -y --force-yes libopencv-ts-dev
sudo apt-get install -y --force-yes libopencv-ts2.4
sudo apt-get install -y --force-yes libopencv-video-dev
sudo apt-get install -y --force-yes libopencv-video2.4
sudo apt-get install -y --force-yes libopencv-videostab-dev
sudo apt-get install -y --force-yes libopencv-videostab2.4
sudo apt-get install -y --force-yes libopencv2.4-java
sudo apt-get install -y --force-yes libopencv2.4-jni
sudo apt-get install -y --force-yes opencv-data
sudo apt-get install -y --force-yes opencv-doc
sudo apt-get install -y --force-yes python-opencv
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
