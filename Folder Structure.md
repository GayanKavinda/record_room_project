# record_room_project

Root path: `f:\Projects\My Projects\record_room_project`

```
├── 📁 .git/ 🚫 (auto-hidden)
├── 📁 Project Showcase/
│   ├── 🖼️ 1. Start Screen.png
│   ├── 🖼️ 10. File Show.png
│   ├── 🖼️ 11. Rack Assign Part.png
│   ├── 🖼️ 12. Store File Management Part.jpeg
│   ├── 🖼️ 13. Department Index Part.jpeg
│   ├── 🖼️ 14. Create Department Part.jpeg
│   ├── 🖼️ 15. Edit Department Part.jpeg
│   ├── 🖼️ 16. Show Department Part.jpeg
│   ├── 🖼️ 17. Role Index Part.jpeg
│   ├── 🖼️ 18. Create Role Part.jpeg
│   ├── 🖼️ 19. Edit Role Part.jpeg
│   ├── 🖼️ 2. Login Page.png
│   ├── 🖼️ 20. Permission to Role Part.jpeg
│   ├── 🖼️ 21. Permission Index Management Part.jpeg
│   ├── 🖼️ 22. Permission Create Part.jpeg
│   ├── 🖼️ 23. Permission Edit Part.jpeg
│   ├── 🖼️ 24. User Management Index Part.jpeg
│   ├── 🖼️ 25. Create User Part.jpeg
│   ├── 🖼️ 26. Edit User Part.jpeg
│   ├── 🖼️ 27. File Activity Logs Part.jpeg
│   ├── 🖼️ 28. User Activity Logs Part.jpeg
│   ├── 🖼️ 29. Department Activity Logs Part.jpeg
│   ├── 🖼️ 3. Forget Password Part.png
│   ├── 🖼️ 30. Permission Activity Logs Part.jpeg
│   ├── 🖼️ 31. Role Activity Logs Part.jpeg
│   ├── 🖼️ 32. Laravel Breeze Authontication Profile.jpeg
│   ├── 🖼️ 33. About Page.jpeg
│   ├── 🖼️ 34. Contact us Page.jpeg
│   ├── 🖼️ 4. Signup Page.png
│   ├── 🖼️ 5. Super Admin Home Page.png
│   ├── 🖼️ 6. User Admin Side Home Page.png
│   ├── 🖼️ 7. File Management Part.png
│   ├── 🖼️ 8. File Create Part.png
│   └── 🖼️ 9. Edit File.png
├── 📁 app/
│   ├── 📁 Helpers/
│   │   └── 🐘 ActivityLogger.php
│   ├── 📁 Http/
│   │   ├── 📁 Controllers/
│   │   │   ├── 📁 Auth/
│   │   │   │   ├── 🐘 AuthenticatedSessionController.php
│   │   │   │   ├── 🐘 ConfirmablePasswordController.php
│   │   │   │   ├── 🐘 EmailVerificationNotificationController.php
│   │   │   │   ├── 🐘 EmailVerificationPromptController.php
│   │   │   │   ├── 🐘 NewPasswordController.php
│   │   │   │   ├── 🐘 PasswordController.php
│   │   │   │   ├── 🐘 PasswordResetLinkController.php
│   │   │   │   ├── 🐘 RegisteredUserController.php
│   │   │   │   └── 🐘 VerifyEmailController.php
│   │   │   ├── 🐘 ActivityLogController.php
│   │   │   ├── 🐘 Controller.php
│   │   │   ├── 🐘 DashboardController.php
│   │   │   ├── 🐘 DepartmentActivityLogController.php
│   │   │   ├── 🐘 DepartmentController.php
│   │   │   ├── 🐘 FileController.php
│   │   │   ├── 🐘 PermissionActivityLogController.php
│   │   │   ├── 🐘 PermissionController.php
│   │   │   ├── 🐘 ProfileController.php
│   │   │   ├── 🐘 RoleActivityLogController.php
│   │   │   ├── 🐘 RoleController.php
│   │   │   ├── 🐘 UserActivityLogController.php
│   │   │   └── 🐘 UserController.php
│   │   ├── 📁 Middleware/
│   │   │   ├── 🐘 AdminMiddleware.php
│   │   │   └── 🐘 CheckDepartmentAccess.php
│   │   ├── 📁 Requests/
│   │   │   ├── 📁 Auth/
│   │   │   │   └── 🐘 LoginRequest.php
│   │   │   └── 🐘 ProfileUpdateRequest.php
│   │   └── 🐘 Kernel.php
│   ├── 📁 Models/
│   │   ├── 🐘 ActivityLog.php
│   │   ├── 🐘 Department.php
│   │   ├── 🐘 DepartmentActivityLog.php
│   │   ├── 🐘 File.php
│   │   ├── 🐘 PermissionActivityLog.php
│   │   ├── 🐘 RoleActivityLog.php
│   │   ├── 🐘 User.php
│   │   └── 🐘 UserActivityLog.php
│   ├── 📁 Policies/
│   │   └── 🐘 FilePolicy.php
│   ├── 📁 Providers/
│   │   ├── 🐘 AppServiceProvider.php
│   │   ├── 🐘 AuthServiceProvider.php
│   │   ├── 🐘 EventServiceProvider.php
│   │   └── 🐘 RouteServiceProvider.php
│   ├── 📁 Rules/
│   │   └── 🐘 FileNoFormat.php
│   ├── 📁 Services/
│   │   └── 🐘 ActivityLogger.php
│   └── 📁 View/
│       └── 📁 Components/
│           ├── 🐘 Alert.php
│           ├── 🐘 AppLayout.php
│           └── 🐘 GuestLayout.php
├── 📁 bootstrap/
│   ├── 📁 cache/ 🚫 (auto-hidden)
│   ├── 🐘 app.php
│   └── 🐘 providers.php
├── 📁 config/
│   ├── 🐘 app.php
│   ├── 🐘 auth.php
│   ├── 🐘 blade-heroicons.php
│   ├── 🐘 blade-ui-kit.php
│   ├── 🐘 cache.php
│   ├── 🐘 database.php
│   ├── 🐘 filesystems.php
│   ├── 🐘 logging.php
│   ├── 🐘 mail.php
│   ├── 🐘 permission.php
│   ├── 🐘 queue.php
│   ├── 🐘 services.php
│   └── 🐘 session.php
├── 📁 database/
│   ├── 📁 factories/
│   │   └── 🐘 UserFactory.php
│   ├── 📁 migrations/
│   │   ├── 🐘 0001_01_01_000000_create_users_table.php
│   │   ├── 🐘 0001_01_01_000001_create_cache_table.php
│   │   ├── 🐘 0001_01_01_000002_create_jobs_table.php
│   │   ├── 🐘 2024_10_12_190211_create_departments_table.php
│   │   ├── 🐘 2024_10_12_224605_create_files_table.php
│   │   ├── 🐘 2024_10_13_165758_update_users_table.php
│   │   ├── 🐘 2024_10_13_173230_create_sessions_table.php
│   │   ├── 🐘 2024_10_14_070659_create_permission_tables.php
│   │   ├── 🐘 2024_11_03_061529_add_fields_to_files_table.php
│   │   ├── 🐘 2024_11_03_143036_add_editable_and_expirable_to_files_table.php
│   │   ├── 🐘 2024_11_05_181830_add_status_and_rack_fields_to_files_table.php
│   │   ├── 🐘 2024_11_27_025741_create_activity_logs_table.php
│   │   ├── 🐘 2024_11_27_125320_create_user_activity_logs_table.php
│   │   ├── 🐘 2024_11_27_151406_create_department_activity_logs_table.php
│   │   ├── 🐘 2024_11_27_214745_create_permission_activity_logs_table.php
│   │   └── 🐘 2024_11_28_013906_create_role_activity_logs_table.php
│   ├── 📁 seeders/
│   │   ├── 🐘 DatabaseSeeder.php
│   │   ├── 🐘 DepartmentsTableSeeder.php
│   │   └── 🐘 FilesTableSeeder.php
│   ├── 🚫 .gitignore
│   └── 🗄️ database.sqlite
├── 📁 node_modules/ 🚫 (auto-hidden)
├── 📁 public/
│   ├── 📁 build/ 🚫 (auto-hidden)
│   ├── 📁 images/
│   │   ├── 🖼️ 1.jpg
│   │   ├── 🖼️ 2.jpg
│   │   ├── 🖼️ DSC04951.jpg
│   │   ├── 🖼️ Didula.jpg
│   │   ├── 🖼️ Nipuna.jpg
│   │   ├── 🖼️ anime-girl-color-wheel-5w-1920x1080.jpg
│   │   ├── 🖼️ f5-1920x1080.jpg
│   │   ├── 🖼️ gov_logo.png
│   │   ├── 🖼️ magenta-nature.jpg
│   │   ├── 🖼️ sri lanka.png
│   │   └── 🖼️ test.jpg
│   ├── 📁 videos/
│   ├── 📄 .htaccess
│   ├── 📄 _redirects
│   ├── 🖼️ favicon.ico
│   ├── 📄 hot 🚫 (auto-hidden)
│   ├── 🐘 index.php
│   └── 📄 robots.txt
├── 📁 resources/
│   ├── 📁 css/
│   │   └── 🎨 app.css
│   ├── 📁 js/
│   │   ├── 📄 app.js
│   │   └── 📄 bootstrap.js
│   └── 📁 views/
│       ├── 📁 activity_logs/
│       │   ├── 🐘 department_activity.blade.php
│       │   ├── 🐘 index.blade.php
│       │   ├── 🐘 permission_activity.blade.php
│       │   ├── 🐘 role_activity.blade.php
│       │   └── 🐘 user_activity.blade.php
│       ├── 📁 auth/
│       │   ├── 🐘 confirm-password.blade.php
│       │   ├── 🐘 forgot-password.blade.php
│       │   ├── 🐘 login.blade.php
│       │   ├── 🐘 register.blade.php
│       │   ├── 🐘 reset-password.blade.php
│       │   └── 🐘 verify-email.blade.php
│       ├── 📁 components/
│       │   ├── 🐘 alert.blade.php
│       │   ├── 🐘 application-logo.blade.php
│       │   ├── 🐘 auth-session-status.blade.php
│       │   ├── 🐘 button.blade.php
│       │   ├── 🐘 danger-button.blade.php
│       │   ├── 🐘 dropdown-link.blade.php
│       │   ├── 🐘 dropdown.blade.php
│       │   ├── 🐘 input-error.blade.php
│       │   ├── 🐘 input-label.blade.php
│       │   ├── 🐘 modal.blade.php
│       │   ├── 🐘 nav-link.blade.php
│       │   ├── 🐘 primary-button.blade.php
│       │   ├── 🐘 responsive-nav-link.blade.php
│       │   ├── 🐘 secondary-button.blade.php
│       │   └── 🐘 text-input.blade.php
│       ├── 📁 departments/
│       │   ├── 🐘 create.blade.php
│       │   ├── 🐘 edit.blade.php
│       │   ├── 🐘 index.blade.php
│       │   └── 🐘 show.blade.php
│       ├── 📁 files/
│       │   ├── 🐘 create.blade.php
│       │   ├── 🐘 edit.blade.php
│       │   ├── 🐘 index.blade.php
│       │   └── 🐘 show.blade.php
│       ├── 📁 layouts/
│       │   ├── 🐘 app.blade.php
│       │   ├── 🐘 guest.blade.php
│       │   └── 🐘 navigation.blade.php
│       ├── 📁 profile/
│       │   ├── 📁 partials/
│       │   │   ├── 🐘 delete-user-form.blade.php
│       │   │   ├── 🐘 update-password-form.blade.php
│       │   │   └── 🐘 update-profile-information-form.blade.php
│       │   └── 🐘 edit.blade.php
│       ├── 📁 record_room/
│       │   ├── 🐘 index.blade.php
│       │   └── 🐘 stored_files.blade.php
│       ├── 📁 role-permission/
│       │   ├── 📁 permission/
│       │   │   ├── 🐘 create.blade.php
│       │   │   ├── 🐘 edit.blade.php
│       │   │   └── 🐘 index.blade.php
│       │   ├── 📁 role/
│       │   │   ├── 🐘 add-permissions.blade.php
│       │   │   ├── 🐘 create.blade.php
│       │   │   ├── 🐘 edit.blade.php
│       │   │   └── 🐘 index.blade.php
│       │   ├── 📁 user/
│       │   │   ├── 🐘 create.blade.php
│       │   │   ├── 🐘 edit.blade.php
│       │   │   └── 🐘 index.blade.php
│       │   └── 🐘 nav-links.blade.php
│       ├── 📁 vendor/ 🚫 (auto-hidden)
│       ├── 🐘 about.blade.php
│       ├── 🐘 contact.blade.php
│       ├── 🐘 dashboard.blade.php
│       └── 🐘 welcome.blade.php
├── 📁 routes/
│   ├── 🐘 api.php
│   ├── 🐘 auth.php
│   ├── 🐘 console.php
│   └── 🐘 web.php
├── 📁 storage/
│   ├── 📁 app/
│   │   ├── 📁 private/
│   │   │   └── 🚫 .gitignore
│   │   ├── 📁 public/
│   │   │   └── 🚫 .gitignore
│   │   └── 🚫 .gitignore
│   ├── 📁 framework/
│   │   ├── 📁 cache/ 🚫 (auto-hidden)
│   │   ├── 📁 sessions/
│   │   │   └── 🚫 .gitignore
│   │   ├── 📁 testing/
│   │   │   └── 🚫 .gitignore
│   │   ├── 📁 views/
│   │   │   ├── 🚫 .gitignore
│   │   │   ├── 🐘 0981715fe88f3ff059852c0b4083cf15.php
│   │   │   ├── 🐘 0d5fd851e026ae1bfe0b30e794d02599.php
│   │   │   ├── 🐘 0f06d1f141a8cc058eaf1492ce6e8288.php
│   │   │   ├── 🐘 0f41f269b3fb285cd90d97d8adc247bf.php
│   │   │   ├── 🐘 132b4341f10b71f3d446d7068f702d49.php
│   │   │   ├── 🐘 17d13d885435c900c0d6982c61dfa234.php
│   │   │   ├── 🐘 1bce8953797cb8d9f96f5524b4df84f9.php
│   │   │   ├── 🐘 1ceac8f9992e08b935dc87cc0554eb57.php
│   │   │   ├── 🐘 226fda772cc24b9a01a5850c5b523583.php
│   │   │   ├── 🐘 236f3f8086f6b188a714dfff19b8a00d.php
│   │   │   ├── 🐘 2c1de33dc90137f075b955f9a6a166b5.php
│   │   │   ├── 🐘 33161de7d9d71ca581ef94cd865a76c0.blade.php
│   │   │   ├── 🐘 3549f06a4b7b96cd4e4d9d5125eb8b0b.php
│   │   │   ├── 🐘 3bce9fd7140041768bbce208d2474691.php
│   │   │   ├── 🐘 3c6f350d8ba32c559e2f74bef95778db.php
│   │   │   ├── 🐘 40d54fab46c3a087442f419cb98a01a9.php
│   │   │   ├── 🐘 4ee97b602fe4fa1ca46b81bae575c6f3.php
│   │   │   ├── 🐘 52ed86dc3c6c4b755712ec4497271aa5.php
│   │   │   ├── 🐘 56cd8022f9e2c3b722fca1c8c925887e.php
│   │   │   ├── 🐘 57d6de0e898af760b90307df8d41a8db.php
│   │   │   ├── 🐘 601484539abc22e7f7997f982dafd130.blade.php
│   │   │   ├── 🐘 63c87616d80402b81834a24e72f889db.php
│   │   │   ├── 🐘 647f2c2d647d1f80fa40e0f9c34215a0.php
│   │   │   ├── 🐘 6ce8b1e36c39d11757cebe5b37ddd4bf.php
│   │   │   ├── 🐘 6e4c2dc83eb3a5ca9ae831d0885c7bfb.php
│   │   │   ├── 🐘 6ee4efdf9ed850d38c6e0f9bd286b9f7.php
│   │   │   ├── 🐘 7565abe7a90659b91afa833839f430df.php
│   │   │   ├── 🐘 7594fff6caf9cef5af8700948a8f1de2.php
│   │   │   ├── 🐘 794415a0adf76c708d17a9f7e09f2579.php
│   │   │   ├── 🐘 7ea3c0f1cdd7e95f22bc59bbe05fd918.php
│   │   │   ├── 🐘 7f2447fe6da4489ebddea93a9637e885.php
│   │   │   ├── 🐘 831f722dc75c24302bd2c65ab8f7f61e.php
│   │   │   ├── 🐘 891b60f1bae3ae79ef367a4bdcb2a25b.php
│   │   │   ├── 🐘 89243d44ad9656b2eafe0fd41d86b1b8.php
│   │   │   ├── 🐘 8a76a22b721a36201aa22d57a0a91d62.php
│   │   │   ├── 🐘 8c1e6668601e1605cdf0442d7ca15dd8.php
│   │   │   ├── 🐘 8cf6c33df5e4efdb4b91aa7f22dd2c33.php
│   │   │   ├── 🐘 95fbc1fb0c2bfaf61cd12c896e8f8d7c.php
│   │   │   ├── 🐘 99fa253d753d9e85a24034c88a6d8481.php
│   │   │   ├── 🐘 9a18fb397c8ad214e987e9ea63a199cb.php
│   │   │   ├── 🐘 9cd8085685319940bedb26ce510e1fb8.php
│   │   │   ├── 🐘 9d5c05457d53da3dabd78d97c62dc381.php
│   │   │   ├── 🐘 9e67ebabaa108f5460b14fa6e4cc6e80.php
│   │   │   ├── 🐘 a4704e0c3f889569e968b0155e65b703.php
│   │   │   ├── 🐘 a5af841330d9b90763ae303dc2f59a29.php
│   │   │   ├── 🐘 aaa678d2d4fba635996bbe8bf57c75c2.php
│   │   │   ├── 🐘 b1b77a62d3188b5375e3aa2534214983.php
│   │   │   ├── 🐘 b31e24badfbf52e3acd23545ef42e16a.php
│   │   │   ├── 🐘 bb174e65098a07c33672efa8f73ab1ff.php
│   │   │   ├── 🐘 c0cb8825024e7b39341713d990271da9.php
│   │   │   ├── 🐘 c3997a288afa8d7bf39c4b28c486e577.php
│   │   │   ├── 🐘 c76bb4ffb378be1d60e936cb60a01da3.php
│   │   │   ├── 🐘 d30facf1ab0ca484a2429acfafd7fa11.php
│   │   │   ├── 🐘 d50567dea6d849c2bdcc9a3931edc85a.php
│   │   │   ├── 🐘 db6f6d7ad68648e9389c1e8f11441738.php
│   │   │   ├── 🐘 e4901964dd36d2a834dcf062fb0902f1.php
│   │   │   ├── 🐘 e707701310d7b1f9bb4cb2c374d28e8f.php
│   │   │   ├── 🐘 eb27216ef5d63258e597ce03595a55d7.blade.php
│   │   │   ├── 🐘 ec169fa596f67a3ee31360bddc78b96c.php
│   │   │   ├── 🐘 eeeb2974b0df8decde46475a1ec87cb7.php
│   │   │   ├── 🐘 ef9fcab703ad0d05cd293ccf618aabca.php
│   │   │   ├── 🐘 efc94bad4f84a2ad19fdfc77db5b89a1.php
│   │   │   ├── 🐘 f9474b9535cf2f558498e1eaa73d2a9a.php
│   │   │   └── 🐘 fc80b4bc6866b5142509ec1e6178e258.php
│   │   └── 🚫 .gitignore
│   └── 📁 logs/
│       ├── 🚫 .gitignore
│       └── 📋 laravel.log 🚫 (auto-hidden)
├── 📁 tests/
│   ├── 📁 Feature/
│   │   ├── 📁 Auth/
│   │   │   ├── 🐘 AuthenticationTest.php
│   │   │   ├── 🐘 EmailVerificationTest.php
│   │   │   ├── 🐘 PasswordConfirmationTest.php
│   │   │   ├── 🐘 PasswordResetTest.php
│   │   │   ├── 🐘 PasswordUpdateTest.php
│   │   │   └── 🐘 RegistrationTest.php
│   │   ├── 🐘 ExampleTest.php
│   │   └── 🐘 ProfileTest.php
│   ├── 📁 Unit/
│   │   └── 🐘 ExampleTest.php
│   └── 🐘 TestCase.php
├── 📁 vendor/ 🚫 (auto-hidden)
├── 📄 .editorconfig
├── 🔒 .env 🚫 (auto-hidden)
├── 📄 .env.example
├── 📄 .gitattributes
├── 🚫 .gitignore
├── 📜 LICENSE
├── 📖 README.md
├── 📄 artisan
├── 📄 composer.json
├── 🔒 composer.lock 🚫 (auto-hidden)
├── 📄 package-lock.json
├── 📄 package.json
├── 📄 phpunit.xml
├── 📄 postcss.config.js
├── 📄 tailwind.config.js
└── 📄 vite.config.js
```

---