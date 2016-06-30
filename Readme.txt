HRToolkit Readme

------------------------------
INTRO

The HRToolkit was made entirely by Justin Grimes for the purpose of operating the HonestRepair Cloud on an 
entirely in-house network of servers. To that end, much of this sofware was designed and used by HonestRepair
as a learning project for it's creator and as a free public service offering 3GB of space to anyone. Justin has since
moved on to other projects, but feels that is important to share what he has learned with the larger programming,
networking, cloud, and enthusiast community. 

The HonestRepair Cloud lasted for most of 2015 and quickly grew to include over half-a-dozen servers including custom Cloud 
servers, Minecraft servers, reverse-proxy servers, and plain-'ol web servers. At it's peak the HRCloud boasted over 400 users
worldwide. 

Unfortunately, being a one-man hobbyist with a full-time job, Justin couldn't maintain the network to make it realize it's full 
potential. In early 2016, after changing jobs for the better Justin could no longer afford the time and constant pressure to 
upkeep the network, and chose instead to impact the Cloud industry by sharing the (albeit primitive) lessons he has learned 
with the open-source community.  

Please enjoy the HRToolkit!  :)


You can contact the author of this toolkit via email to zelon88@gmail.com.

Contributions can be sent via PayPal to HonestRepair8@Gmail.com

------------------------------
LEGAL - END USER LICENSE AGREEMENT (You must agree before using this software)

Under no circumstances will Justin Grimes or HonestRepair be responsible or liable for the results or consequences of
using or implementing any of the code or software contained in the HRToolkit. This software comes with no warranty,
expressed or implied. 

This open-source software is protected by the GNU GPLv3 license agreement. 

By using this software you agree to be bound by the terms contained within the "GNU_GPL_v3.txt" text file included 
with this distribution of HRToolkit.

By modifying, re-producing, copying, distributing or otherwise utilizing this software you agree to be bound by the
terms contained within the "GNU_GPL_v3.txt" text file included with this distribution of HRToolkit.

By using this software in a commercialized deployment you agree to make the source code for ANY implementation of the
HRToolkit inconspicuously available, with a copy of this "Readme.txt" text file, credit to Justin Grimes, and a copy of the 
included "GNU_GPL_v3.txt" text file included. 

------------------------------
DESCRIPTION OF THIS SOFTWARE

The HRToolkit was designed to make the functions expected by a Cloud user more modular and deployable. As a result, each
web application within the HRToolkit will need to be installed on a qualifying server, but will not (always) require other modules
to perform it's basic function. Each module, however, does have it's own unique requirements. Check the "Readme.txt"file
containted within each module directory for specific module requirements. 

With modification each module can be dissected and included in other applications to perform their functions in an automated 
fashion or as part of other scripts or web applications. 

It is possible to deploy modules on separate servers and connect them via reverse proxy to create a modular, scalar, redundant, and 
in some cases load-balanced Cloud network. Combined with WordPress and the WPCloud Plugin by Marco Milesi one could easily
setup a modular Cloud network at home from scratch within hours.

------------------------------
SYSTEM REQUIREMENTS

OS: Linux
Hardware: Raspberry Pi Model B+ or higher. Any x86 or x64 CPU w/512MB of RAM.
Web Server: Apache2 or Nginx.
Database: Varies, check module "Reame.txt" file.
PHP: PHP Version 5.7.
PHP.ini Settings: FILE_UPLOADS ENABLED, MAX_UPLOAD 3000MB or higher, MAX_RAM 384MB or higher, MAX_INPUT_VARS 10000, 
     All timeouts doubled.
PHP Modules: All of them.
Other Requirements: Javascript.
3rd Party Requirements:
     To scan files with HRScan or any other modules your server will need to have ClamAV Anti-Virus installed.
     To convert document files with HRConvert your server will need to have LibreOffice, Unoconv, and Python installed.
     To convert image files with HRConvert your server will need to have ImageMagick installed.
     To convert Rar files with HRConvert your server will need to have Rar and Unrar installed.
     To convert zip files with HRConvert your server will need to have Unzip installed.
     To convert all other archive and disk image formats with HRConvert your server will need to have 7zipper installed.
     To convert audio files with HRConvert your server will need to have FFMPEG installed.
     To Encrypt/Decrypt and/or Encode/Decode with HRLocker your server will need to have OpenSSL installed.

------------------------------
INSTALLATION INSTRUCTIONS

1) On a server which meets the "SYSTEM REQUIREMENTS" listed above, create a directory called "HRProprietary" in the root web directory.
2) Copy the desired module from the HRToolkit into the "HRProprietary" folder located in your root web directory.
3) Make sure that the owner of the "HRProprietary" directory, as well as all subdirectories, is set to "www-data".
4) Make sure that the permission level of the "HRProprietary" directory, as well as all subdirectories is set to "0755".
5) Open, execute, or access the appropriate "index.php" file for the module you intend to run. Check the module's "Reame.txt" text file to 
     verify the proper index file to use for each module. 