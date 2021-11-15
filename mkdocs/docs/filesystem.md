You can manipulate folders and files within Solital through the `HandleFiles` class, such as creating folders, removing folders, listing files and deleting files.

```php
use Solital\Core\Resource\FileSystem\HandleFiles;

$handle = new HandleFiles();
```

## List files within a folder

**list multiple files**

Use the `folder()` method to define the folder containing the files in Solital to be listed. To list all files within that folder, chain the `files()` method.

```php
/** Array return */
$res = $handle->folder("folder_name")->files();

pre($res);
```

**list single file**

```php
/** String return */
$res = $handle->folder("folder_name")->file('README.md');

pre($res);
```

To list only a single file within the folder, use the `file()` method passing as a parameter the file you want to search for

## Check if a file exists

To check if there is a file inside the folder, use `fileExists()`.

```php
/** Boolean return */
$res = $handle->folder("folder_name")->fileExists("README.md");

pre($res);
```

You can delete the file if it exists, to do so enter `true` in the second parameter.

```php
/** Boolean return */
$res = $handle->folder("folder_name")->fileExists("README.md", true);

pre($res);
```

## Create folder

To create a folder inside Solital, use only the `create()` method.

```php
/** Boolean return */
$res = $handle->create("folder_name");

pre($res);
```

You can define the type of permission the folder will have. The default is 0777.

```php
/** Boolean return */
$res = $handle->create("folder_name", 0755);

pre($res);
```

## Remove folder

To delete a folder inside Solital, use only the `remove()` method. This method will delete a folder if it is empty.

```php
/** Boolean return */
$res = $handle->remove("folder_name");

pre($res);
```

The `remove()` method checks for files inside the folder. If you want to delete the files inside the folder, pass `false` in the second parameter.

```php
/** Boolean return */
$res = $handle->remove("folder_name", false);

pre($res);
```

## Get and Put Contents

It is possible to use the native PHP functions `file_get_contents` and `file_put_contents` at the same time. The `getAndPutContents` method performs this process.

```php
$res = $handle->getAndPutContents('file.txt', 'file_bkp.txt');

pre($res);
```

## Copy

Make a copy of a file using the `copy` method.

```php
/** Boolean return */
$res = $handle->copy('file.txt', 'file_bkp.txt');

pre($res);
```

If you want to delete the original photo after copying, use `true`.

```php
/** Boolean return */
$res = $handle->copy('file.txt', 'file_bkp.txt', true);

pre($res);
```

## Handling permissions

You can change and view file and folder permissions. 

### List permissions

The `getPermission` method lists the permissions that the file or folder has.

```php
/** Null|string return */
$res = $handle->getPermission('file.txt');

pre($res);
```

### List full permissions

To return full permissions, use the `getFullPermission` method.

```php
/** String return */
$res = $handle->getFullPermission('file.txt');

pre($res);
```

### Change permissions

The `setPermission` method changes the permissions that the file or folder will have. 

```php
/** Boolean return */
$handle->setPermission('file.txt', 0777);
```

## Modify owner of the file

Use the `setOwner` method to modify the owner of the file.

```php
/** Boolean return */
$res = $handle->setOwner('file.txt', 'root');

pre($res);
```