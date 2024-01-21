Solital has a component to check scripts containing codes with possible malware inserted.

## Usage

To perform this check, you can use the command below:

```bash
php vinci scanner
```

## Checking entire project

The above command will scan files within the `app/` folder. If you want a complete scan of the project, use the `--all` option.

```bash
php vinci scanner --all
```