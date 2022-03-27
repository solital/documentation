## 3.0

**Main news**

- Solital requires PHP version 8.0.0
- Queues, migrations and Seeders support
- Markers in views when using the Wolf Template
- Added Katrina ORM 2
- Added YAML files for settings
- Added `SecurePassword` component
- Added `mapped_implode`, `middleware`, `cache` and `view` helpers
- Added `makeCache` method in WolfCache class

**Other news**

- Added PSR-6
- Added `getenv` function
- Added `BaseController` class
- Added `middleware`, `cache` and `view` helpers
- Added Kernel component
- Added log files
- Added autoload in helpers and routers files
- Added QueueMail
- Added support for creating custom commands
- Added `Request::limit` and `Request::repeat`
- Added WolfException class
- Fixed `htmlspecialchars` in Wolf
- Fixed filter FILTER_SANITIZE_STRING to FILTER_SANITIZE_FULL_SPECIAL_CHARS
- Fixed verify `$_GET` and `$_POST` variables
- Removed `NativeMail` class
- Removed debug methods