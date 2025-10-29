[![Moodle Plugin CI](https://github.com/acamacho-unige/moodle-mod_pdfjsfolder/actions/workflows/moodle-plugin-ci.yml/badge.svg)](https://github.com/acamacho-unige/moodle-mod_pdfjsfolder/actions/workflows/moodle-plugin-ci.yml)
[![PHP Support](https://img.shields.io/badge/php-8.1_--_8.4-blue)](https://github.com/acamacho-unige/moodle-mod_pdfjsfolder/actions)
[![Moodle Support](https://img.shields.io/badge/Moodle-4.5--5.1-orange)](https://github.com/acamacho-unige/moodle-mod_pdfjsfolder/actions)
[![License GPL-3.0](https://img.shields.io/github/license/acamacho-unige/moodle-mod_pdfjsfolder?color=lightgrey)](https://github.com/acamacho-unige/moodle-mod_pdfjsfolder/blob/main/LICENSE)
[![GitHub contributors](https://img.shields.io/github/contributors/acamacho-unige/moodle-mod_pdfjsfolder)](https://github.com/acamacho-unige/moodle-mod_pdfjsfolder/graphs/contributors)

# PDF.js folder
---------
How PDFs are opened in browsers seem to depend on many things, like which
browser the user is using, the configuration of PDF readers and which
operating system is being used. To a smaller degree, it depends on the
settings in Moodle.

In most cases, the handling of PDFs should be left under the control of
the user but in some cases there are valid reasons to try to standardize
the experience.

PDF.js folder is a Moodle 4.5+ plugin intended to make sure that PDFs always
open in the browser (with the option of downloading), regardless of if the
user is using a desktop or mobile device.

PDF.js folder is built on [PDF.js](https://github.com/mozilla/pdf.js):

*  PDF.js is Portable Document Format (PDF) viewer that is built with HTML5.
*  PDF.js is community-driven and supported by Mozilla Labs. Our goal is to
   create a general-purpose, web standards-based platform for parsing and
   rendering PDFs.
*  PDF.js, can perform poorly on mobile devices with limited memory and processing power.
   Some PDFs are fine but others are too big, to complex, contain too many images, etc.
   Your mileage may vary.

PDF.js folder works much like the regular folder resource in Moodle, but only
files with .pdf type(s) can be uploaded.

There are a few options:

*  Should files open in the current tab/window or in a new one ?
*  Should subfolders be shown expanded or not ?
*  Should download links be displayed for each PDF ?
*  Should a warning about changes made in PDF.js not being saved/persisted when window/tab closes ?

Example screenshots
-------------------

![View](pix/screenshot-view.png?raw=true)

![Settings](pix/screenshot-settings.png?raw=true)

Installation
------------
Unzip the zip file in the `mod` folder of the Moodle directory and, if
necessary, rename the folder to "pdfjsfolder".
-- OR --
Go to Administration > Site Administration > Install add-ons to install
the "PDF.js Folder" (mod_pdfjsfolder) module directly from your Moodle
installation.

Default settings can be set by going to Administration > Site
Administration > Plugins > Activity Modules > PDF.js Folder.

Use
---
See the LICENSE file for licensing details.
