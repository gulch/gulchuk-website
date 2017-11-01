# gulchuk.com website

https://gulchuk.com

Requirements:

- installed cwebp (https://developers.google.com/speed/webp/docs/compiling or 'apt-get install webp')

- configured systemd service /etc/systemd/system/gulchuk-queue.service:

    [Unit]
    Description=Gulchuk Queue Consumer

    [Service]
    User=www-data
    Group=www-data
    Restart=on-failure
    ExecStart=/usr/bin/php PATH-TO-WEBSITE/queue

    [Install]
    WantedBy=multi-user.target

- installed pngquant

