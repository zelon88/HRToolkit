<?php

// This file contains the configuration data for the DocumentControl Server application.
// Make sure to fill out the information below 100% accuratly BEFORE you attempt to run
// any DocumentControl Server application scripts. Severe filesystem damage could result.

// BE SURE TO FILL OUT ALL INFORMATION ACCURATELY !!!
// PRESERVE ALL SYNTAX AND FORMATTING !!!
// SERIOUS FILESYSTEM DAMAGE COULD RESULT FROM INCORRECT DATABASE OR DIRECTORY INFO !!!

// / ------------------------------
// / Admin Login Information ...
  $AdmLogin = 'Justin';
  $AdmPass = 'password';
  $UniqueServerName = 'D620-Server';
// / ------------------------------

// / ------------------------------  
// / Security Information ... 
  
  // / DocumentControl Server can run on a local machine or on a network as a server to
  // / serve clients over http using standard web browsers. When running locally it is 
  // / advised to install DocumentControl in a location that IS NOT hosted. If you do not
  // / plan on running an online, externally controllable DocumentControl Server set the online
  // / setting below to '0' and ignore the rest of the 'Security' settings. DocumentControl will
  // / automatically deny access or authorization to external or internal IP's other than the
  // / localhost machine. 

  // / If you are an administrator or home power-user you may want to run DocumentControl in a 
  // / server environment. If you want to make the DocumentControl admin panel accesible, or if 
  // / you want to execute DocumentControl scripts from  from outside your home network change
  // / the 'Online' setting to '1' and continue to specify the remaining  'Security Settings'.

  // / If 'Online' setting is '1' DocumnentControl Server will allow network 
  // / users to perform certain tasks and also allow remote admin access from local 
  // / or remote networks (depending on individual network architecture). 
  // / If '1', DocumentControl folder MUST be on a hosted /var/www/html folder or 
  // / equivilent network accesible location.
  $Online = '1';  
  // / Internal IP Address.
  $InternalIP = '192.168.1.7';
  // / External IPv4 Address.
  $ExternalIP = '71.184.255.43';
  // / Externally or internally accesible domain.
  $URL = '';
  // / Scan for viruses during directory scan. Use 1 for true or leave blank for false. 
   // / (ClamAV MUST be installed on the localhost!!!).
  $VirusScan = '1';
// / ------------------------------

// / Database Information ...
// / ------------------------------
// / MSSQL Database Information ...
  // / Enable MSSQL Support ... 
  // / !!! DO NOT ENABLE SUPPORT FOR MULTIPLE DATABASE TYPES AT ONCE !!!
  $ENABLE_MSSQL = '1';
  // / MSSQL Credentials ...
  $DBName = 'test';
  $DBPass = 'test';
  $DBUser = 'root';
  // / The ServerName should be the name of the Windows Server running MSSQL.
  $ServerName = 'ServerName';
  $UserAccount = 'ITPersonsName';
// / ------------------------------ 
// / !!! DO NOT ENABLE SUPPORT FOR MULTIPLE DATABASES AT ONCE !!!
 // / !!! DO NOT ENABLE SUPPORT FOR MULTIPLE DATABASES AT ONCE !!!
  // / !!! DO NOT ENABLE SUPPORT FOR MULTIPLE DATABASES AT ONCE !!!
 // / !!! DO NOT ENABLE SUPPORT FOR MULTIPLE DATABASES AT ONCE !!! 
// / !!! DO NOT ENABLE SUPPORT FOR MULTIPLE DATABASES AT ONCE !!!  
// / ------------------------------ 
// / MySQL Database Information ...
  // / Enable MySQL Support ...
  // / !!! DO NOT ENABLE SUPPORT FOR MULTIPLE DATABASE TYPES AT ONCE !!!
  $ENABLE_MYSQL = '0';
  // / MySQL Credentials ...
  $DBName = 'test';
  $DBPass = 'test';
  $DBUser = 'root';
  // / If your database is hosted on a separate server fill in the information below. 
  // / For DBAdr use the internal or external IP or URL for the DB. Leave blank for localhost.
  // / For DBPort you may specify a port or leave blank for default.
  $DBAdr = '';
  $DBPort = '';
// / ------------------------------ 

// / ------------------------------ 
// / Directory locations ...
// / Windows machines use format 'C:/users/User/Desktop/TestDir'.
// / Linux machines use format '/home/justin/Desktop/TestDir'.
  // / Directory where DocumentControl was installed. (NO SLASH AFTER DIRECTORY!!!)
  $InstLoc = '/var/www/html/HRProprietary/DocumentControl';
  // / Directory to be scanned for file dumps (NO SLASH AFTER DIRECTORY!!!) ...  
  $InputLoc = '/home/justin/Desktop/TestDir/input';
  // / Root directory for organized output files (NO SLASH AFTER DIRECTORY!!!) ...
  $OutputLoc = '/home/justin/Desktop/TestDir/output';
  // / If you want DocumentControl to create and manage a synced copy of your 
   // / Output Location, set AutoBackups below to '1', 
  $AutoBackup = '1';
  // / If you have enabled Auto Backups (set AutoBackups to '1'), select a root directory
   // / for organized backup files (NO SLASH AFTER DIRECTORY!!! Leave blank for none.) ...
  $BackupLoc = '/home/justin/Desktop/TestDir/BACKUP';
  // / If you have enabled Auto Backups (set AutoBackups to '1'), select a root directory
   // / for organized backup files (NO SLASH AFTER DIRECTORY!!! Leave blank for none.) ...
  $ActionLoc = '/home/justin/Desktop/TestDir/ActionItems';
// / ------------------------------ 
// / ------------------------------ 
// / Characters ...
  // / The SepChars are the character used within filename that tells DocumentControl 
   // / how to separate information.
   // / INSepChar is applied to input files. OUTSepChar is applied to output files.
  $INSepChar = '-';
  $OUTSepChar = '_';
// / ------------------------------ 

// / ------------------------------ 
// / Prefixes ... 
  // / SO# Prefix (LEAVE BLANK IF SO# IS ONLY NUMERIC!!!) ...
  $CPOPre = 'cpo';
  // / FAI Report Prefix (LEAVE BLANK IF FAI# IS ONLY NUMERIC!!!) ...
  $FAIPre = 'fai';
  // / SO# Prefix (LEAVE BLANK IF SO# IS ONLY NUMERIC!!!) ...
  $SOPre = 'so';
  // / WO# Prefix (LEAVE BLANK IF WO# IS ONLY NUMERIC!!!) ...
  $WOPre = 'wo';
  // / PO# Prefix (LEAVE BLANK IF PO# IS ONLY NUMERIC!!!) ...
  $POPre = '';
  // / InspectionReport Prefix (LEAVE BLANK IF IR# IS ONLY NUMERIC!!!) ...
  $InspPre = 'ir';
  // / CertPackage Prefix (LEAVE BLANK IF CERT# IS ONLY NUMERIC!!!) ...
  $CERTPre = 'cert';
  // / Print Prefix (LEAVE BLANK IF PrintID IS ONLY NUMERIC!!!) ...
  $PrintPre = 'pr';
// / ------------------------------ 

// / ------------------------------   
// / Suffixes ... 
  // / SO# Suffix (LEAVE BLANK IF SO# IS ONLY NUMERIC!!!) ...
  $SOSuf = '';
  // / WO# Suffix (LEAVE BLANK IF WO# IS ONLY NUMERIC!!!) ...
  $WOSuf = '';
  // / PO# Suffix (LEAVE BLANK IF PO# IS ONLY NUMERIC!!!) ...
  $POSuf = '';
  // / InspectionReport suffix (LEAVE BLANK IF IR# IS ONLY NUMERIC!!!) ...
  $InspSuf = '';
  // / CertPackage Suffix (LEAVE BLANK IF CERT# IS ONLY NUMERIC!!!) ...
  $CERTSuf = '';
  // / FAI Report Suffix (LEAVE BLANK IF FAI# IS ONLY NUMERIC!!!) ...
  $FAISuf = '';
  // / Print Suffix (LEAVE BLANK IF PrintID IS ONLY NUMERIC!!!) ...
  $PrintSuf = '';
// / ------------------------------ 

// / ------------------------------ 
// / FIRST Incremental Character Count ...
  // / The digit count of the first incremental numerical identifier within each ... 
   // / SO# Incremental Digit Count (ONLY NUMERIC!!!) ...
   $SOC1 = '5';
   // / WO# Incremental Digit Count (ONLY NUMERIC!!! Leave blank for auto) ...
   $WOC1 = '5';
   // / PO# Incremental Digit Count (ONLY NUMERIC!!! Leave blank for auto) ...
   $POC1 = '5';  
   // / Print Incremental Digit Count (ONLY NUMERIC!!! Leave blank for auto.) ...
   $PrC1 = '';
// / ------------------------------ 

// / ------------------------------    
 // / SECOND Incremental Character Count ...
  // / The digit count of the second incremental numerical identifier within each ... 
   // / SO# Incremental Digit Count (ONLY NUMERIC!!! Leave blank for none.) ...
   $SOC2 = '';
   // / WO# Incremental Digit Count (ONLY NUMERIC!!! Leave blank for none.) ...
   $WOC2 = '';
   // / PO# Incremental Digit Count (ONLY NUMERIC!!!Leave blank for none.) ...
   $POC2 = ''; 
   // / Print Incremental Digit Count (ONLY NUMERIC!!!Leave blank for none.) ...
   $PrC2 = '';
// / ------------------------------ 

