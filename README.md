# Symfony Providers App

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
