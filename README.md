searx_stats
===========

A little website which is showing current stats about searx instances and searx-engines

[searx](https://github.com/asciimoo/searx) is a privacy-respecting, hackable metasearch engine.

**Licence:** GNU AGPLv3+

### Installation

1. You are requiring php, php-curl, mysql and a web server.
2. Setup the Database with the sql-file contained in ```./resources/sql```. You can either use only table structure, or structure filled with basic data.
3. There is a config file ```/resources/config.inc.php.example``` which have to be renamed to ```./resources/config.inc.php```. There you can specifc your database login data, and other configuration stuff
4. Now you can open the website in a browser
5. To update the data, run a cronjob in ```<yoururl>/cgi/cron.php```

