Sometimes it is necessary to dump the database. This process is very simple, just run the following command:

```bash
php vinci db:dump
```

Any dump files you run will be stored in `app/Storage/dump`.

## Excluding tables from the dump

If there are tables in your database that you do not want to dump, use the `--exclude` argument

```bash
php vinci db:dump --exclude=table1,table2
```

## For Windows

The process to perform the dump on Windows is a little different, you first need to edit the `database.yaml` file. You will need to indicate the location of `mysqldump` as shown below:

```yaml
dump_windows:
  mysql: C:\xampp\mysql\bin\mysqldump.exe
  pgsql: C:\Program Files\PostgreSQL\14\bin\pg_dump.exe
  sqlite: 
```

Then run the command `php vinci db:dump`.