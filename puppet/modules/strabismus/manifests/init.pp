class strabismus {
  $mysqlpw = "qwe123"

  exec { 'create database':
    unless  => "/usr/bin/mysql -uroot strabismus -p$mysqlpw",
    command => "/usr/bin/mysql -uroot -p$mysqlpw -e \"create database strabismus\"",
    require => Service['mysql'],
  }

  exec { 'create database user':
    unless  => "/usr/bin/mysql -ustrabismus -pstrabismus strabismus",
    command => "/usr/bin/mysql -uroot -p$mysqlpw -e \"\
    grant all privileges on strabismus.* to 'strabismus'@'%' identified by 'strabismus';\
    grant all privileges on strabismus.* to 'strabismus'@'localhost' identified by 'strabismus';\
    flush privileges;\"",
    require => Exec['create database']
  }

  exec { 'load dump':
    unless => "/usr/bin/mysql -uroot strabismus -p$mysqlpw -e \"select * from user\"",
    command => "/usr/bin/mysql -uroot strabismus -p$mysqlpw < /vagrant/strabismus-2014-10-09.sql",
    require => Exec['create database'],
  }

  file { '/var/www/protected/runtime':
    ensure => directory,
    mode   => '0777',
  }

  file { '/var/www/assets':
    ensure => directory,
    mode   => '0777',
  }

  file { '/var/framework':
    ensure => link,
    target => '/vagrant/framework/',
  }
  file { "/var/www/protected/config/main.php":
    ensure => present,
    source => "/vagrant/htdocs/protected/config/main.example.php"
  }
}
