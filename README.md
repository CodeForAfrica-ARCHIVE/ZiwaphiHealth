HealthWatch
===========

A suite of web based health applications

Installation
============

Clone this repository to your working directory

<pre>
git clone git@github.com:CodeForAfrica/ZiwaphiHealth.git
</pre>

You can now navigate <your localhost>/ZiwaphiHealth/Code/public to run the app

Set Up
===========

HealthWatch uses Fusion Tables and Socrata to store the data and execute queries for the different apps. Here will walk you on the step by step for each of the appications


**Dodgy Doctors**

This application helps you check if your doctor is registered, to confirm their area of practice and to check if they have malpractice cases. The data is hosted on Fusion Tables. To set up:

1. Upload your data to Google Fusion Tables

2. Change the share settings to publicly available on the web

3. Grab the table id and set it accordingly on the custom config file: app/config/custom_config.php
   Change the dodgy_docs_table to your table id

4. Change google_api_key to your Google API key

**Medicine Apps**

There are two apps in this section: the Medicine prices app and generics app. The data for these is also hosted on Fusion Tables. The set up is the same as above for
Dodgy Doctors except for #3 where you'll change the 'medicine_table' value to your Fusion Table.

**Hospitals App**




### Built using Laravel PHP Framework

[![Latest Stable Version](https://poser.pugx.org/laravel/framework/version.png)](https://packagist.org/packages/laravel/framework) [![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.png)](https://packagist.org/packages/laravel/framework) [![Build Status](https://travis-ci.org/laravel/framework.png)](https://travis-ci.org/laravel/framework) [![License](https://poser.pugx.org/laravel/framework/license.png)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, and caching.

Laravel aims to make the development process a pleasing one for the developer without sacrificing application functionality. Happy developers make the best code. To this end, we've attempted to combine the very best of what we have seen in other web frameworks, including frameworks implemented in other languages, such as Ruby on Rails, ASP.NET MVC, and Sinatra.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.