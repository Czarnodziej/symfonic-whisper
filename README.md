symfony3-base
=============

Symfony3 with FosUserBundle and AdminLTE implemented.

- locale in route
- gulp tasks
- smoke tested
- basic views
- user manager for admins
- ready to rock!

Gulp:
```
# prod env
gulp --prod
```

Setup:

- [Fix permissions](http://symfony.com/doc/current/setup/file_permissions.html)

- Load db structure

```
php bin/console doctrine:schema:update --force
```

- Add admin:admin user
```
php bin/console doctrine:fixtures:load
```
