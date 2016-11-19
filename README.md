symfony3-base
=============

Symfony3 with FosUserBundle and AdminLTE implemented.

- locale in route
- gulp tasks
- smoke tested
- basic views
- user manager for admins
- ready to rock!

FAQ:

- is it production ready?

Should be. More tests needed.

Gulp:
```
# prod env
gulp --prod
```

Setup:

1. [Fix permissions](http://symfony.com/doc/current/setup/file_permissions.html)

2. Load db structure
```
php bin/console doctrine:schema:update --force
```
3. Add admin:admin user
```
php bin/console doctrine:fixtures:load
```
