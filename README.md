# raspistillweb
Simple and responsive web interface to raspistill command utility (Raspberry Camera)

# Status
Code is not ready for production. I started this project because needed a simple and easy UI to control raspistill during camera setup.
TODO in code.

# Setup hints
Your web server has to be able to execute raspistill. So, please ensure that web server's user is within the video group. If you use apache2, add www-data user with command
```bash
usermod -a -G video www-data
```

# License
Released under the MIT License (MIT).
See [LICENSE](LICENSE) for more information.
