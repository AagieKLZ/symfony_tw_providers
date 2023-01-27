[ES](#Aplicación-de-control-de-proveedores-con-PHP-Symfony) | [EN](#PHP-Symfony-Providers-App)
# Aplicación de control de proveedores con PHP Symfony

Aplicación desarrollada con PHP Symfony 4 y Tailwind CSS

Permite:
- Conectarse a una base de datos MYSQL
- Obtener información de los proveedores introducidos
- Añadir, editar o eliminar proveedores
- Comprobar fecha y hora de creación y de última modificación
- Tabla responsive - Pasa el ratón sobre los elementos marcados para obtener más información
- Resultados paginados

### Docker

La aplicación puede desplegarse utilizando docker mediante el comando
```
docker-compose up
```
La configuración de docker incluye la base de datos de MySQL preparada para funcionar junto a la aplicación.

### Si pudiera hacerlo de nuevo...

La estructura de la aplicación es sin duda una de las cosas a mejorar, al no haber visto anteriormente proyectos en producción en Symfony. Al no tener tanta experiencia con Twig, aprendí algo más tarde sobre temas como los layouts y components que definitivamente habrían facilitado la experiencia de desarrollo. Esto se aplica también a otros ficheros como controladores y conexiones, que también podrían ser mejorados mediante la implicación del ORM Doctrine (que no pude utilizar en este caso por un error que no fui capaz de solucionar en su momento, por lo que acabé utilizando la extensión de PHP mysqli en su lugar).

A su vez, aprendí mucho durante el desarrollo de algunas features de Symfony como los formularios, que facilitan mucho la interacción con los datos. Otras funcionalidades que se podrían añadir con algo más de tiempo serían la capacidad de seleccionar y eliminar varias entradas a la vez en la lista de proveedores o la capacidad de iniciar sesión y añadir comprobaciones para evitar que cualquiera pueda eliminar elementos sin más ocnfirmación

En general, he disfrutado mucho la experiencia de desarrollo con Symfony y Twig y acabaré desarrollando más proyectos a nivel personal para poder implementar algunas de las características principales de Symfony, así como añadir algunas otras como el uso de React o Vue en el frontend.

---

# PHP Symfony Providers App

App developed using PHP Symfony 4 Framework and Tailwind CSS

Allows for:
- Connect to MySQL Database
- Read all entries
- Edit added entries
- Delete entries
- Add new entries
- Check creation time and last modified
- Responsive table - Hover over the different items to get extra info!
- Result pagination


### Docker

App can be deployed using **Docker** via

```
docker-compose up
```

Docker setup already includes MySQL Database ready to run with the required Providers Database.

*MySQL takes longer to initialize than Symfony. Make sure to wait until MySQL image is up and running to get access to the application*

### If I could start again...

App structure is definitely not at its best. Not being that experienced with Twig, I learn about html templates and layouts while after I developed the initial interface. This also applies to other files like controllers and database connections, that could also be improved using Doctrine ORM instead. Got a driver issue when trying to use Doctrine that I didn't manage to fix, so ended up defaulting to mysqli extension.

At the same time, I learned a lot about symfony features like forms, which allows you to interact with data in an easy, simple way. Features that could also be added to the app include multi-select entries to delete, better file structure when it comes to building forms and login features to prevent people to delete items on a single click.

Overall, I enjoyed the experience developing with Symfony and Twig and will definitely use it in further projects improving the code structure and applying other powerful features like HTML templates or implementing React or Vue on the frontend.
