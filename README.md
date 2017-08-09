# Doctrine Writer for Zend Log
This writer writes log messages to a given doctrine object.

## Installation
Use composer to install this module.

```shell
composer require frank-houweling/zend-log-doctrine-writer
```
After composer installation, make sure that the \FrankHouweling\ZendLogDoctrineWriter module is added to the module configuration. 
In most cases, the module configuration can be found in `config/module.config.php`

## Usage
The Doctrine Writer can be used as any Zend Log Writer. It requires an instance of the Doctrine EntityManager, and
a valid log entity classname. The log messages will be stored in the given entity, so make sure it is registered
to the doctrine entitymanager.

The writer can be used as follows:
```php
    $em = $container->get(EntityManager::class);
    $doctrineWriter = new DoctrineWriter($em, LogMessage::class);
    
    $logger = new Logger();
    $logger->addWriter($doctrineWriter);
```

A mapping can be given as a third parameter, to change the attributes in which log data is stored.

Example mapping:
```php
$mapping = [
    'message' => 'msg'
];

$em = $container->get(EntityManager::class);
$doctrineWriter = new DoctrineWriter($em, LogMessage::class, $mapping);

$logger = new Logger();
$logger->addWriter($doctrineWriter);
```

A basic entity that can be used for logging can be found in the src/Entity folder of the library.