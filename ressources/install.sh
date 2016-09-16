#!/bin/bash
touch /tmp/compilation_openCv_in_progress
echo 0 > /tmp/compilation_openCv_in_progress
echo "*****************************************************************************************************"
echo "*                                Installing additional libraries                                    *"
echo "*****************************************************************************************************"
sudo apt-get -y --force-yes update
sudo apt-get -y --force-yes upgrade
echo 10 > /tmp/compilation_openCv_in_progress
sudo apt-get install -y --force-yes build-essential
sudo apt-get install -y --force-yes cmake 
sudo apt-get install -y --force-yes pkg-config 
sudo apt-get install -y --force-yes libpng12-0 libpng12-dev libpng++-dev libpng3 
sudo apt-get install -y --force-yes libpnglite-dev libpngwriter0-dev libpngwriter0c2 
sudo apt-get install -y --force-yes zlib1g-dbg zlib1g zlib1g-dev 
sudo apt-get install -y --force-yes pngtools libtiff4-dev libtiff4 libtiffxx0c2 libtiff-tools 
sudo apt-get install -y --force-yes libjpeg8 libjpeg8-dev libjpeg8-dbg libjpeg-progs 
sudo apt-get install -y --force-yes ffmpeg libavcodec-dev libavcodec52 libavformat52 libavformat-dev 
sudo apt-get install -y --force-yes libgstreamer0.10-0-dbg libgstreamer0.10-0  libgstreamer0.10-dev 
sudo apt-get install -y --force-yes libxine1-ffmpeg  libxine-dev libxine1-bin 
sudo apt-get install -y --force-yes libunicap2 libunicap2-dev 
sudo apt-get install -y --force-yes libdc1394-22-dev libdc1394-22 libdc1394-utils 
sudo apt-get install -y --force-yes swig 
sudo apt-get install -y --force-yes libv4l-0 libv4l-dev 
sudo apt-get install -y --force-yes python-numpy 
sudo apt-get install -y --force-yes libpython2.6 python-dev python2.6-dev 
sudo apt-get install -y --force-yes libgtk2.0-dev pkg-config
echo 40 > /tmp/compilation_openCv_in_progress

mkdir /usr/local/src/openCv/
mkdir /etc/openCv/
cd /usr/local/src/openCv/

if [ "$(cat /etc/openCv/openCv_VERSION)" != "v2.1.0" ]
then
	echo "*****************************************************************************************************"
	echo "*                                            Compile openCv:                                      *"
	echo "*****************************************************************************************************"
	cd /usr/local/src/openCv/
	if [ -d "/usr/local/src/openCv/openCv" ]; then
		rm -R openCv
	fi
	git clone https://github.com/opencv/opencv.git
	cd opencv
	mkdir build
	cd build
	cmake ../
	echo 60 > /tmp/compilation_openCv_in_progress
	# compile the library
	make
	echo 65 > /tmp/compilation_openCv_in_progress
	# Install the binaries/libraries to your local system (prefix is /usr)
	sudo make install
	echo 70 > /tmp/compilation_openCv_in_progress
	echo "v2.1.0" > /etc/openCv/openCv_VERSION
fi
#if [ "$(cat /etc/openCv/openCvPhp_VERSION)" != "v2.1.0" ]
#then
#	echo "*****************************************************************************************************"
#	echo "*                                            Compile openCv:                                      *"
#	echo "*****************************************************************************************************"
#	cd /usr/local/src/openCv/
#	if [ -d "/usr/local/src/openCv/opencvphp" ]; then
#		rm -R opencvphp
#	fi
#	git clone https://github.com/mgdm/OpenCV-for-PHP.git
#	cd opencvphp
#	 sudo phpize && ./configure && make && make install
#	echo "v2.1.0" > /etc/openCv/openCvPhp_VERSION
#fi
#sudo chmod 777 -R /etc/openCv
echo 100 > /tmp/compilation_openCv_in_progress
echo "*****************************************************************************************************"
echo "*                                            Fin de l'installation                                      *"
echo "*****************************************************************************************************"
rm /tmp/compilation_openCv_in_progress
