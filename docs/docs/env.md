The `.env` file has all the variables that Solital uses. Some are filled in by default, but others you need to edit as needed. Below we will see what each variable does:

- Displays all errors that Solital or PHP raises. Activate only in development mode

```bash
ERRORS_DISPLAY="true"
```

- Standard index that Solital uses to store session login. To learn more, see [Authenticate](auth.md)

```bash
INDEX_LOGIN="solital_index_login"
```

- Database connection variables. To find out more, see [Katrina ORM](katrina2.md)

```bash
DB_DRIVE=""
DB_HOST=""
DB_NAME=""
DB_USER=""
DB_PASS=""
SQLITE_DIR=""
```

- Variables of the Mailer class

```bash
MAIL_DEBUG=""
MAIL_HOST=""
MAIL_USER=""
MAIL_PASS=""
MAIL_SECURITY=""
MAIL_PORT=""
```

- Variables used in encryption. It is recommended that you add new values to these variables.

```bash
FIRST_SECRET="first_secret"
SECOND_SECRET="second_secret"
```