# raspistillweb
Simple and responsive web interface to raspistill command utility (Raspberry Camera)

# Status
Code is not ready for production. I started this project because needed a simple and easy UI to control raspistill during camera setup.
TODO in code.

# Setup hints
You need a webserver and PHP5 installed on your Raspberry Pi.
Start cloning this repository, then install dependencies via composer
```bash
composer install
```
Your webserver has to be able to execute raspistill. Please ensure webserver's user is within the video group. If you use apache2, add www-data user with the command
```bash
usermod -a -G video www-data
```

# License
Released under the MIT License (MIT).
See [LICENSE](LICENSE) for more information.
