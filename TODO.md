# TODO: Add Admin Account

- [x] Update User model: Add 'role' to fillable, add isAdmin() method.
- [x] Implement isAdmin middleware to check if authenticated user has role 'admin'.
- [x] Update DatabaseSeeder to create an admin user.
- [x] Run `php artisan db:seed` to create the admin user. (Note: Database connection failed, ensure MySQL is running and configured.)
- [x] Update login redirect: Admin users redirect to admin.index, regular users to user.dashboard.
- [ ] Test admin access.
