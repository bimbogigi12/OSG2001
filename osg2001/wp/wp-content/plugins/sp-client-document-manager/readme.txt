=== Plugin Name ===
Contributors: smartypants
Donate link: http://smartypantsplugins.com/donate/
Tags: Document Management,Project Management,File Sharing,FTP Manager,document manager,project management,file manager
Requires at least: 5.0
Tested up to: 5.5
Stable tag: 3.8.5

Project, Document & File  Management. A Remote file sharing to manage, share, track, group, distribute any type of document or media file.

== Description ==

[youtube https://www.youtube.com/watch?v=am3bNfkm-gA]

**Project, Document and File Management plugin **

Project & Document management plugin, Remote file sharing, maintain and control unlimited number of documents, records, files, media, videos and images. You can create unlimited folders and sub folders to share, organize, manage client, student & supplier documents and accounts, control individual documents, and select specific file sharing of documents all in an easy to manage online process.

The plugin demonstrates how a you can remotely share with clients, sales organization, vendors.  With a straight-forward layout, access to template modifications and easy to manage features; WordPress users can add and modify project/document folders.

Try the project & document management plugin that thousands of Companies and Organizations trust! free forum support as a community user or upgrade to our premium user and submit tickets, call us on skype! We are constantly developing this exciting plugin enhancing the features and taking on custom development work to modify the plugin for your needs! 

**Works with WordPress Multi Site!**




We now have an extensive documentation library
http://learn.smartypantsplugins.com/

Need support? Click here
http://support.smartypantsplugins.com/
 
**[We also now offer a premium version; please check out our website for more information](http://smartypantsplugins.com/sp-client-document-manager/)**

**[You can try a 30 day trial of the premium along with all the addons here](http://www.documanaged.com/register/)**

**[Click here to create your own hosted demo](http://documanaged.com "Click here to try out a demo")**


**Community Version Features**

* Remotely manage you documents and media
* Unlimited nesting of folders
* Upload and manage files with No Limits!
* Secure documents under login for each user
* Zip files in archive
* Localization support for many languages
* Advanced email editor to customize all emails
* Wordpress capabilities and roles integration to limit who can do what
* Administrators can add files to users
* SSL Support
* Require login to download files
* Each user has their own file repository
* File size based off server php.ini
* Unlimited files for users!
* Import local files! Now with support for unlimited files and folders
* Add links a file
* Embed youtube and other media as a file
* Recycle bin with file retention dates

** What do you get when upgrading? Check out this video! **

[youtube https://www.youtube.com/watch?v=Co-X4g7WRmk]

**Premium features (requires addons)**
To activate the below features you need addons, check out our product builder to see what you need!
http://smartypantsplugins.com/product-builder/ 

* Amazon s3 Integration available as an addon!
* AES file encryption at rest encryption secures documents even when the server has been compromised.
* Woo Commerce intergration
* Remove branding
* Custom file list templates
* Enhanced multi uploader using plupload allows you to upload unlimited files with any file size regardless of your php.ini settings. We use an advanced file chunking method to upload files!
* File Tagging for better searching
* Additional form fields
* Group user files together
* Category system for files
* Thumbnail mode to view files in a windows format
* Add vendors so files can be sent regularly
* Advanced shortcodes
* Save files as a draft for later publishing
* Add file revisions to a file
* Limit file types
* Create thumbnails from PDFs, PSDs and other popular formats
* File retention times for autopruning files
* Limit file types based on extension and mime type
* Add files from Dropbox, Google Drive, One Drive
* Group management with user roles, BuddyPress Groups or baked groups.
* Download logs and reports based on file usage
* Commenting and file discussion on files with notification system
* Google shortlinks for files
* Batch manage files, copy, delete, archive, download files
* Bootstrap powered Dashboad
* Add reminders and tasks to a file
* Add tasks to the dashboard area
* Upload and view videos inside the file viewer
* Text message integration to Plivio and Twillio for notifications
* Build custom forms to submit data using our hand made form builder, allow users to go back and edit that data and compile all the data into a pdf. Sign Documents using our built in signature tool!
* Export data to csv
* Link remotely to an external file rather then uploading a file
* Many more features, too many to list here! Lots of settings to configure the document manager the way you need! Check out a hosted demo to see everything!!

**Industries Served**

* Healthcare, Banking & Finance, Legal, Education ,Consulting, Research firms Government, Architecture, Printers, Photographers, Manufacturing, Chemical, Distributors, Web Developers, Virtual offices, Media to name a few
 

**Client / Customers / Users**

* Users upload files and Documents online to their own personal page
* Users can create or add to existing projects / folders

**Administrator Side Features**

* Complete control on who can access specific files
* Turn off ability for Users to upload documents instantly.
* Notification via email when a client uploads a file
* Add files and documents to client page and projects
* Download file archive of a user
* Custom Naming of files
* Create multiple upload locations
* 50 latest uploads on main plugin page
* Force downloads of file 
* Delete confirmation with custom notification
* Thank you confirmation with custom notification
* Add WordPress users, staff, supplier's, vendors, sub-contractors or partner's so you can distribute the files to other people
* Attach file or send the file as a link
* Projects allow you or the users to create projects to store files in
* Allow the user to create projects
* Ability to add files to any user
* Download all the files of a project in a single zip file
* Add multiple admin emails to receive files
* Advanced admin file manager
* Assign custom capabilities to WordPress user roles
* File Logging
 
**Categories**

* Add Categories
* Manage Categories allow an admin to designate categories for the user to select, for example a print company could use categories as statuses (Mockup, Draft and Final)


**Folders**

* Allow a user to create folders
* Collaborate with other users with groups
* Assign a file or files to a project
* Manage Folders
	
**Users **

* User can view all categories set by admin

Full Support Available through email or Skype. 
Add-on packs available for more features!


**Current Languages**

* English
* French
* German
* Italian
* Polish
* Spanish

**Demo**

[youtube https://www.youtube.com/watch?v=AZS6KyGqsRw]


== Installation ==

Advanced documentation: http://learn.smartypantsplugins.com/

* Upload the plugin to your plugins folder
* Activate the plugin
* Create a new page and enter the shortcode [sp-client-document-manager]  
* Go to the plugin admin page and click settings to configure the plugin  (VERY IMPORTANT!)  
* If you're using the premium version please upload the zip archive in the settings area. 
 
= Short Codes = 
x = configurable area


**[sp-client-document-manager uid="x"]** 

*uid = user id of a user will display that users files

This shortcode displays the uploader
 
**[cdm-link file="x" date="1" real="1"]**
* This links to a specific file

* file = required, this is the file id. You can find the file id in admin under files or by clicking on a file. The ID is listed next to the date.
* date = (set to 1) optional, show the date of a file
* real = (set to 1) optional, generate the real url for the file, the link tags are not generated and only the url is returned. This is good for custom links and image url's

examples:

* [cdm-link file="53" date="1"]
* Will generate a link with the file name and date

'< img src="[cdm-link file="53" real="1"]" width="100">'

Will generate a full url for use in an image

**[cdm-project project="x" date="1" order="x" direction="x" limit="x" ]**

This shortlink will display a unordered list of files, it is a basic html ul so you can use css to display it however you want.

* project = required, this is the project id which you can get in admin under the projects tab.
* date = optional, put's the date of the file next to the file name
* order = (name,date,id,file) optional, use one of the fields to order the list by
* direction  = (asc,desc) optional, Only to be used with order, use asc for ascending order or desc for decending order
* limit = optional, use to limit the amount of results shown.

examples:

* [cdm-project project="1" date="1" ]
* [cdm-project project="1" date="1" order="name" direction="asc" limit="10" ]

= User Role Capabilities = 
If you use "User Role Editor" plugin and want to assign CDM capabilities to another role then please use the following custom captabilities. All are automatically set for administrator

* sp_cdm = You need this role to view the plugin, this is a very minimal role. You can view files, edit and delete.
* sp_cdm_settings = edit settings as well as enable any premium plugin features (in the future we will break premium features into their own roles, just getting started here)
* sp_cdm_vendors = Show vendors tab
* sp_cdm_projects = Show projects tab
* sp_cdm_uploader = Use the uploader (add files)

**[cdm_public_view]**

This is a shortcode for premium members only, it displays the file list to the public. This shortcode lists all the files from all users.

= Premium Users = 

*Premium users must have free + premium version installed. The premium extends the free version.

== Frequently Asked Questions ==

= How come I'm getting a 404 error? =

This could be one of two reasons, either you did not install theme my login or you're running wordpress in a directory in which you can go to settings and set the directory for wordpress.

= Why am I just getting a spinning circle and no content on my uploader? = 

This is usually because you are using a theme that converts new lines into paragraphs. To fix this wrap the short code in raw tags. Example: [raw][sp-client-document-manager] [/raw]

= Is there a conflict with another plugin? =

Sometimes plugins have conflicts, if you are experiencing any abnormal problems there could be a javascript error. Please download and install firebug to find the issue.

= I get an imagemagick error when creating thumbnails of pdf and psd's = 

Imagemagick is a 3rd party plugin you are responsible for, it needs to be downloaded and installed on your server but more importantly, it needs to be compiled into php. Your server admin should be able to handle that, we do not support imagemagick installations.

= I'm using the premium version but not seeing the client document uploader tab in wordpress =

Premium users must have free + premium version installed. The premium extends the free version. Once you install the free version you will see the tab, from there put in your serial code.
= Do you offer capabilities for user roles? = 

* sp_cdm = You need this role to view the plugin, this is a very minimal role. You can view files, edit and delete.
* sp_cdm_settings = edit settings as well as enable any premium plugin features (in the future we will break premium features into their own roles, just getting started here)
* sp_cdm_vendors = Show vendors tab
* sp_cdm_projects = Show projects tab
* sp_cdm_uploader = Use the uploader (add files)

= Why am I getting a permission denied error when activating the premium or trial version? = 

The premium version relies on common functions to operate, please activate the FREE version to fix this error. You must have both FREE and Premium plugins installed and activated.

== Screenshots ==

1. This is the client view
2. This is the file view which also shows the premium revision system
3. This is the admin page view
4. Admin file uploader to upload a file for a user
5. Settings page
6. Form builder to add custom forms (premium)
7. Group manager to allow multiple user manage the same files (premium)
8. Responsive menu in resolutions below 728px
9. Repsonisve file listing in resultions below 728px



== Changelog ==
= 3.7.3 =

* Remove hash tracking for modals to make compatible with divi

= 3.7.0 =

* Security updates
* moved everything to enqueues
* up to date with wp standards

= 3.7.0 =

* Security fix

= 3.4.9 =

* Update to the folder redirection function

= 3.4.7 =

* Added new function to handle array variables
* Fixed a bunch of notices using the new function
* Removed depreciated escape() for prepare()

= 3.3.9 =

* Added the ability to change the parent folder in admin
* Some design changes in the folder area
* Version up for 5.1.1

= 3.3.8 =

* Integrated the customizer to change styles

= 3.3.6 =

* Fixed bug with videos and mp3s
* Removed a bunch of notices
* Fixed bug with tab selection
* Removed old unused functions
* Conslidated the Uploader function into a single function
* Beautified the code

= 3.1.8 =

* Fixed a few bugs
* Added ability to modify date in WP settings

= 2.6.7.1 =

* Integreated a local document importer!
* Increased version compatibility
* Fixed a few bugs
* Added a few new hooks

= 2.6.5.5 = 

* Added ability to either remove files or reassign files when a user is removed
= 2.6.5.2 =

* Fixed issue with types
= 2.6.4.7 = 

* Added Custom file list templates for premium users
* New interfaces for premium Windows GUI

= 2.6.4.6 = 

* Added some filters 

= 2.6.4.5 =

* versioned up!

= 2.6.4.3 = 

* Fixed issue with revisions. Revisions no longer searchable

= 2.6.3.6 =

* Fix for manditory folders

= 2.6.2.7 =

* Unlimited sub folders and folder nesting now included with the free version!
* Fixed an issue when editing a document, the saved document would lose its folder.

= 2.6.2.6 =

* Vulernability fix thanks @Tripwire VERT

= 2.6.2.5 = 

* Fixed the admin email

= 2.6.2.4 = 

* Security fix: .htaccess file now protects upload directory on misconfigured servers. Reported by: Guy Theuws  Thanks man!
* Added the ability to disable the protection for non sensitive situations

= 2.6.2.3 = 

* Security exploit fix
* Fixed some email issues

= 2.6.1.4 =

* Security fix
* Multiple files download fix
* Added an event logger which will be implemented plugin wide coming soon.
* Fallback if no file name if given


= 2.6.0.0 = 

* Security fix DOWNLOAD

= 2.5.9.5 =

* Uploads were not inserting due to 4.4, fixed.

= 2.5.8.9 =

* Tabs now rememeber !

= 2.5.8.9 =

* Fixed the view file modal on admin

= 2.5.8.6 =

* Multiple bug fixes
* Fixed the admin uploader when using form fields
* Added quick links to the admin bar

= 2.5.8.1 =

* Fixed a bug that was crashing some installations
* Fixed a security hole in download archive 

= 2.5.7.8 =

* Added a log out button

= 2.5.7.5 =

* Changing ownership of a folder moves the supporting files and folders to the new owner

= 2.5.7.3 = 

* Security fix, please update

= 2.5.7.3 = 

* Fixed download folder archive
* Download folder archive now includes sub folders
* Archives are removed from folder twice daily

= 2.5.7.2 = 

* Fixed some bugs
* Added a bunch of new hooks

= 2.5.6.3 = 

* Bug fix from latest update

= 2.5.6 =

* Major update to the admin uploader, now uses thumbnail mode and reposonsive mode, removed redundent code.

= 2.5.5 =

* Fixed issue with font and ssl
* Fixed issue with projects not loading when notes is enabled

= 2.5.4 =

* Fixed exploit in ajax (credit: rh3792@naver.com)

= 2.5.1 =

* Important patch
* Added the ability to log who deletes files, shown under settings->user logs
* Fixed a bug where spam bots could delete files

= 2.4.4 =

*Important security fix

= 2.4.2 =

* Fix to readfile(); in downloads

= 2.4.1 =

* Mime type addition of microsoft 2013 documents

= 2.4.0 =

* Added the ability to put files in draft mode for premium
* Added the ability to set file retention times for folders.

= 2.3.9 = 

* Added the ability to link directly to the view file console from emails

= 2.3.8 =

* Fixed langugages issues, added Polish and Czech

= 2.3.6 = 

* Fixed download archive in folder view

= 2.3.3 =

* Fixed an error with admin uploader where the folder id was being saved as a cookie and loading that folder for different clients.

= 2.3.2 =

* Fixed an error where folders were being added to the wrong user when using the admin uploader
* Fixed an error which displayed files when accessing ajax files

= 2.3.1 =

* Fixed an error with files not being removed when deleting a folder

= 2.3.0 =

* Fix the deleting of files in admin area, previously was not removing file from server.

= 2.2.9 =

* Made javascript translatable by using localize script
* Removed 2 extra div ends that were breaking some designs.
* Added new terms to the translation files, if you are using a different language please update the .po file and send us the updated version to support@smartypantsplugins.com to be included in future releases

= 2.2.7 =

* Fixed a slashes issue in the email

= 2.2.4 =

* Major release - Document manager is now responsive in premium mode
* Community version also has responsive modals
* Huge code rewrites so if you are going to update premium please update all your smarty plugins or you will recieve errors

= 2.2.0 = 

* Made settings page allot nicer to look at with a tabbed interface
* Fixed Vendor Emails
* Added WP Editor to email section
* Add a custom vendor email to email section
== Upgrade Notice ==

= 2.1.9 =

* More UI enhancements
* Added capabilities to roles
* Updated instructions
* Added link to folder admin while in folder
* Bug fixes

== Upgrade Notice ==

* Added Custom file list templates for premium users
* New interfaces for premium Windows GUI