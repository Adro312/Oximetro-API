# Oximetro-API
API para conectar una aplicación móvil y una ESP32 para poder guardar los datos de los sensores conectados en una base de datos con el sistema MySQL y para poder hacer consultas en la base de datos para poder ser visualizados gráficamente en la aplicación móvil.

# Framework
Esta API fue hecha con el lenguaje de programación PHP.
El framework utilizado fue: CodeIgniter 3 diseñado para su uso con PHP 5.6+

# Instalación
* Tener instalado la versión de PHP 5.6 en adelante
* Crea la base de datos en tu sistema de gestión de base de datos, el archivo .sql se encuentra a la altura de *Oximetro-Api/db_oximetro.sql*.
* Clona el proyecto dentro de la carpeta donde se ejecuta tu servidor. e.g.
En XAMPP sería dentro de la carpeta 'htdocs'. 
* Ya solo es de que prendas tu servidor para que esté funcionando.

# Notas
Si deseas ver como funciona, necesitas clonar otros dos repositorios para tener el proyecto completo:
* Oximetro App Movil => https://github.com/Adro312/Oximetro-App-Movil
* Oximetro ESP32 => https://github.com/Adro312/Oximetro-ESP32
