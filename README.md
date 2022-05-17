# Antes de poner en marcha el presente proyecto es recomendable con anterioridad tener
# instalado los siguientes paquetes:
# - XAMPP
# - NODE JS

PASO 1: cree una carpeta e iremos a ella desde la terminal de comandos de nuestra eleccion y ejecutamos el siguiente 
comando git clone https://github.com/DavidSoft21/coffe_store.git

PASO 2: una vez transferidos los archivos ejecutamos los siguientes comandos:
cd coffe_store
composer install

PASO 3: luego de haber descargado el manejador de dependencias para php descargamos el manejador para javaScript
npm install

PASO 4: npm run dev

PASO 5: reemplace o cree  el archivo  .env_example por .env donde deberemos configurar nuestras variables de entrono de nuestro proyecto
para este caso la variable DB_DATABASE=coffe_store

PASO 6: Cree una base de datos en mysql llamada coffe_store

PASO 7: php artisan key:generate

PASO 8: php artisan migrate

PASO 9: php artisan db:seed

PASO 10: php artisan serve

NOTA:
dirijase a la ruta que podra observar en la consola de comandos y cree su cuenta para 
interactuar con el sistema recuerde que al elegir un producto de la tienda debera 
comfirmar la casilla de checkbox
