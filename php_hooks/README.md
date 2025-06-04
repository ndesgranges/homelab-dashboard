# Add hooks for online status check here

Hooks are useful to check status to services that are not keen to header only
requests.

1. Duplicate `default.php` in this folder (do not delete `default.php` !)
2. Rename duplicated file with a custom name, example : `plex.php`
2. 
3. in your `config.json`change the `status_check`key from `default` to the name
you just gave (without the extension), example :
    ```json
    {
        "label": "Plex",
        "icon": "images/plex.svg",
        "link": "http://<plex_ip>",
        "status_check": "plex"
    },
    ```
4. Modify `plex.php` for your need