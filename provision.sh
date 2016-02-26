echo "Updating system, this may take a while..."
apt-get update -y

echo "Upgrading system, this may take a while..."
apt-get upgrade -y

echo "Removing redundant packages..."
apt-get autoremove -y
apt-get autoclean -y

echo "Installing PHP5 MySQL Native Driver..."
apt-get install php5-mysqlnd -y

echo "Restarting PHP5-FPM..."
service php5-fpm restart

block="server {
	listen 80;
	server_name 192.168.10.150 app.dev;
	root \"/home/vagrant/web/app/public\";

	index index.html index.htm index.php;

	charset utf-8;

	location / {
		try_files \$uri \$uri/ /index.php?\$query_string;
	}

	location = /favicon.ico { access_log off; log_not_found off; }
	location = /robots.txt { access_log off; log_not_found off; }

	access_log off;
	error_log /var/log/nginx/app.dev-error.log error;

	sendfile off;

	client_max_body_size 100m;

	location ~ \.php$ {
		fastcgi_split_path_info ^(.+\.php)(/.+)$;
		fastcgi_pass unix:/var/run/php5-fpm.sock;
		fastcgi_index index.php;
		include fastcgi_params;
		fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;

		fastcgi_intercept_errors off;
		fastcgi_buffer_size 16k;
		fastcgi_buffers 4 16k;
		fastcgi_connect_timeout 300;
		fastcgi_send_timeout 300;
		fastcgi_read_timeout 300;
	}

	location ~ /\.ht {
		deny all;
	}
}"

echo "Setting up NGINX sites..."
echo "$block" > "/etc/nginx/sites-available/app.dev"

ln -fs "/etc/nginx/sites-available/app.dev" "/etc/nginx/sites-enabled/app.dev"

echo "Clearing default site..."
rm /etc/nginx/sites-enabled/default

echo "Restarting NGINX, and PHP5-FPM..."
service nginx restart
service php5-fpm restart

echo "Creating database..."
echo "DROP DATABASE IF EXISTS ant;" | mysql -uroot -psecret
echo "CREATE DATABASE ant;" | mysql -uroot -psecret

echo "Creating database user 'ant'..."
echo "DROP USER IF EXISTS 'ant'@'%';" | mysql -uroot -psecret
echo "CREATE USER 'ant'@'%' IDENTIFIED BY 'secret';" | mysql -uroot -psecret
echo "GRANT ALL PRIVILEGES ON *.* TO 'ant'@'%';" | mysql -uroot -psecret
echo "FLUSH PRIVILEGES;" | mysql -uroot -psecret