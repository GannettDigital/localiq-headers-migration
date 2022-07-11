# localiq-headers-migration
WP plugin to aid in migration from http-security to Redirection plugin for HTTP header management.

The goal for this project is to move the inidividual settings for HTTP headers from the http-security plugin to Redirection, 
which will become the primary method of managing headers from the site. The challenge lies in the settings, as all the options
for http-security are individual rows `wp_options.http_security_*`, where Redirection stores them all in an unindexed array
inside `wp_options.redirection_options[headers][]`; there are also some slight differences in values for the headers.

Since Redirection is primarily a React app inside the WordPress Dashboard, it's difficult to simply use the API to save the headers
from outside the app (through an externally-triggered script), so this is an effort to identify and implement a scriptable method
of data migration so we don't have to manually configure thousands of sites.
