wp-modul3r
==========
A plugin for theme developers. Page may consist of many sections / modules. To make each module editable for admin user this plugin will help a lot.
Yes, you may choose ACF plugin to add extra field to page / post. This plugin isn't a alternative. This will change the way you things. Simple and easy!.

1. Install wp-modul3r plugin
2. After install necessary tables will be created by default
3. Define module structure from "Add new structure"
4. Then create module for a page based on that defined structure
5. Once module has been created you may fecth data by calling -
```
w3r_get_module('your_module_theme_key', 'page_id_or_page_slug')
```
6. If you want to fetch all modules of a page
```
w3r_get_modules('page_id_or_page_slug')
```
7. Enjoy!