<?php
function autoload($className)
{
    if(class_exists($className,false)){
        return;
    }
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    //var_dump($fileName);
    require $fileName;
}
spl_autoload_register('autoload');
// spl_autoload_register(function ($class) {
//     $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
//     if (file_exists($file)) {
//         require_once $file;
//     }
// });
?>