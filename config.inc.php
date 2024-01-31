<?php
/* Servers configuration */
$i = 0;

/* The first server */
$i++;
/* Authentication type */
$cfg['Servers'][$i]['auth_type'] = 'cookie'; // can be 'cookie', 'config', or 'http'
/* Server parameters */
$cfg['Servers'][$i]['host'] = 'localhost'; // MySQL hostname or IP address
$cfg['Servers'][$i]['user'] = 'your_username'; // MySQL user
$cfg['Servers'][$i]['password'] = 'your_password'; // MySQL password (only needed with 'config' auth_type)
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['AllowNoPassword'] = false;

/* Directories for saving/loading files from server */
$cfg['UploadDir'] = '';
$cfg['SaveDir'] = '';

/* You can add more server configurations as needed */
?>
