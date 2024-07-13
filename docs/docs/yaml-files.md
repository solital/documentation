The YAML files that are inside the `app/config` folder are used to change Solital Framework configurations, such as middlewares, authentication, passwords, among others.

These files are updated whenever there is a Solital Core update.

## Updating YAML files

To update the YAML files, run the following command:

```bash
php vinci generate:files
```

When you install a new Solital update using `composer update`, run the above command, so new files are copied to the `app/config` folder. Other files may be copied to other folders in this process.

## Changing settings at runtime

Solital uses the `runtime.yaml` file to change settings at runtime. Feel free to change these values.