**If you are looking for the old <span style="font-weight: bold !important;">Valid</span> class, use [this link](validation-component.md)**

## Introduction

Solital has ways to validate data from $_POST and $_FILES requests. This way, you can validate emails, names, passwords, among others, in addition to applying filters to this data.

Solital uses the `validate` method. This method makes use of the wixel/gump component.

## Getting Started

### Rules

Rules are applied to data coming from $_POST and $_FILES requests. Firstly, you need to have created a controller inside the `app/Components/Controller/` folder. After that, you must use the `input()` helper together with the `validate()` method.

```php
class StoreController
{
    public function index()
    {
        $data_rules = [
            'username' => 'required|alpha_numeric|max_len,100|min_len,6',
            'password' => 'required|max_len,100|min_len,6',
            'email'    => 'required|valid_email'
        ];

        $values = input()->validate($data_rules);
        var_dump($values);
    }
}
```

In the previous example, if the request data is validated according to the defined rules, it will be returned in the variable `$values`.

However, if one of the data does not comply with the rules, an array with index `validation_errors` will be returned containing the errors.

### Filters

To apply filters to your data, use the second parameter of the `validate` method.

```php
class StoreController
{
    public function index()
    {
        $data_rules = [
            'username' => 'required|alpha_numeric|max_len,100|min_len,6',
            'password' => 'required|max_len,100|min_len,6',
            'email'    => 'required|valid_email'
        ];

        $data_filter = [
            'username' => 'upper_case|sanitize_string',
            'password' => 'trim',
            'email'    => 'trim|sanitize_email'
        ];

        $values = input()->validate($data_rules, $data_filter);
        var_dump($values);
    }
}
```

## Creating validation classes

To have better control of the validations you perform, you can create your own class that will store all your rules, filters and error messages.

To create a validator, you must run the following command:

```bash
php vinci create:validator MyValidator
```

All validators will be stored in the `app/Components/Validator/` folder.

### Structure

All validators you create will implement the `RequestValidatorInterface` interface. The validator you create will have the following structure:

```php
<?php

namespace Solital\Components\Validator;

use Solital\Core\Http\RequestValidatorInterface;

class MyValidation implements RequestValidatorInterface
{
    #[\Override]
    public function rules(): array
    {
        return [];
    }

    #[\Override]
    public function filters(): array
    {
        return [];
    }

    #[\Override]
    public function messages(): array
    {
        return [];
    }
}
```

The `rules()` and `filters()` methods will be used for rules and filters. The `messages()` method will have custom error messages as shown in the example below.

```php
#[\Override]
public function messages(): array
{
    return [
        'username' => ['required' => 'Fill the Username field please, its required.'],
        'password' => ['required' => 'Please enter a password. This field is empty.'],
        'email'    => ['valid_email' => 'Please enter a valid e-mail.']
    ];
}
```

### Using the validator

To use the validator you created, you must pass the validator name in the `validate()` method.

```php
use Solital\Components\Validator\MyValidation;

class StoreController
{
    public function index()
    {
        $values = input()->validate(MyValidation::class);
        var_dump($values);
    }
}
```

## Available Validators

| Rule                                                                           | Description                                                                                                                                                                                               |
|--------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **required**                                                                   | Ensures the specified key value exists and is not empty (not null, not empty string, not empty array).                                                                                                    |
| **contains**,one;two;use array format if one of the values contains semicolons | Verify that a value is contained within the pre-defined value set.                                                                                                                                        |
| **contains_list**,value1;value2                                                | Verify that a value is contained within the pre-defined value set. Error message will NOT show the list of possible values.                                                                               |
| **doesnt_contain_list**,value1;value2                                          | Verify that a value is contained within the pre-defined value set. Error message will NOT show the list of possible values.                                                                               |
| **boolean**,strict                                                             | Determine if the provided value is a valid boolean. Returns true for: yes/no, on/off, 1/0, true/false. In strict mode (optional) only true/false will be valid which you can combine with boolean filter. |
| **valid_email**                                                                | Determine if the provided email has valid format.                                                                                                                                                         |
| **max_len**,240                                                                | Determine if the provided value length is less or equal to a specific value.                                                                                                                              |
| **min_len**,4                                                                  | Determine if the provided value length is more or equal to a specific value.                                                                                                                              |
| **exact_len**,5                                                                | Determine if the provided value length matches a specific value.                                                                                                                                          |
| **between_len**,3;11                                                           | Determine if the provided value length is between min and max values.                                                                                                                                     |
| **alpha**                                                                      | Determine if the provided value contains only alpha characters.                                                                                                                                           |
| **alpha_numeric**                                                              | Determine if the provided value contains only alpha-numeric characters.                                                                                                                                   |
| **alpha_dash**                                                                 | Determine if the provided value contains only alpha characters with dashed and underscores.                                                                                                               |
| **alpha_numeric_dash**                                                         | Determine if the provided value contains only alpha numeric characters with dashed and underscores.                                                                                                       |
| **alpha_numeric_space**                                                        | Determine if the provided value contains only alpha numeric characters with spaces.                                                                                                                       |
| **alpha_space**                                                                | Determine if the provided value contains only alpha characters with spaces.                                                                                                                               |
| **numeric**                                                                    | Determine if the provided value is a valid number or numeric string.                                                                                                                                      |
| **integer**                                                                    | Determine if the provided value is a valid integer.                                                                                                                                                       |
| **float**                                                                      | Determine if the provided value is a valid float.                                                                                                                                                         |
| **valid_url**                                                                  | Determine if the provided value is a valid URL.                                                                                                                                                           |
| **url_exists**                                                                 | Determine if a URL exists & is accessible.                                                                                                                                                                |
| **valid_ip**                                                                   | Determine if the provided value is a valid IP address.                                                                                                                                                    |
| **valid_ipv4**                                                                 | Determine if the provided value is a valid IPv4 address.                                                                                                                                                  |
| **valid_ipv6**                                                                 | Determine if the provided value is a valid IPv6 address.                                                                                                                                                  |
| **valid_cc**                                                                   | Determine if the input is a valid credit card number.                                                                                                                                                     |
| **valid_name**                                                                 | Determine if the input is a valid human name.                                                                                                                                                             |
| **street_address**                                                             | Determine if the provided input is likely to be a street address using weak detection.                                                                                                                    |
| **iban**                                                                       | Determine if the provided value is a valid IBAN.                                                                                                                                                          |
| **date**,d/m/Y                                                                 | Determine if the provided input is a valid date (ISO 8601) or specify a custom format (optional).                                                                                                         |
| **min_age**,18                                                                 | Determine if the provided input meets age requirement (ISO 8601). Input should be a date (Y-m-d).                                                                                                         |
| **max_numeric**,50                                                             | Determine if the provided numeric value is lower or equal to a specific value.                                                                                                                            |
| **min_numeric**,1                                                              | Determine if the provided numeric value is higher or equal to a specific value.                                                                                                                           |
| **starts**,Z                                                                   | Determine if the provided value starts with param.                                                                                                                                                        |
| **required_file**                                                              | Determine if the file was successfully uploaded.                                                                                                                                                          |
| **extension**,png;jpg;gif                                                      | Check the uploaded file for extension. Doesn't check mime-type yet.                                                                                                                                       |
| **equalsfield**,other_field_name                                               | Determine if the provided field value equals current field value.                                                                                                                                         |
| **guidv4**                                                                     | Determine if the provided field value is a valid GUID (v4)                                                                                                                                                |
| **phone_number**                                                               | Determine if the provided value is a valid phone number.                                                                                                                                                  |
| **regex**,/test-[0-9]{3}/                                                      | Custom regex validator.                                                                                                                                                                                   |
| **valid_json_string**                                                          | Determine if the provided value is a valid JSON string.                                                                                                                                                   |
| **valid_array_size_greater**,1                                                 | Check if an input is an array and if the size is more or equal to a specific value.                                                                                                                       |
| **valid_array_size_lesser**,1                                                  | Check if an input is an array and if the size is less or equal to a specific value.                                                                                                                       |
| **valid_array_size_equal**,1                                                   | Check if an input is an array and if the size is equal to a specific value.                                                                                                                               |

## Available Filters

Filter rules can also be any PHP native function (e.g.: trim).

| Filter                 | Description                                                                                                           |
|------------------------|-----------------------------------------------------------------------------------------------------------------------|
| **noise_words**        | Replace noise words in a string (http://tax.cchgroup.com/help/Avoiding_noise_words_in_your_search.htm).               |
| **rmpunctuation**      | Remove all known punctuation from a string.                                                                           |
| **urlencode**          | Sanitize the string by urlencoding characters.                                                                        |
| **htmlencode**         | Sanitize the string by converting HTML characters to their HTML entities.                                             |
| **sanitize_email**     | Sanitize the string by removing illegal characters from emails.                                                       |
| **sanitize_numbers**   | Sanitize the string by removing illegal characters from numbers.                                                      |
| **sanitize_floats**    | Sanitize the string by removing illegal characters from float numbers.                                                |
| **sanitize_string**    | Sanitize the string by removing any script tags.                                                                      |
| **boolean**            | Converts ['1', 1, 'true', true, 'yes', 'on'] to true, anything else is false ('on' is useful for form checkboxes).    |
| **basic_tags**         | Filter out all HTML tags except the defined basic tags.                                                               |
| **whole_number**       | Convert the provided numeric value to a whole number.                                                                 |
| **ms_word_characters** | Convert MS Word special characters to web safe characters. ([“ ”] => ", [‘ ’] => ', [–] => -, […] => ...) |
| **lower_case**         | Converts to lowercase.                                                                                                |
| **upper_case**         | Converts to uppercase.                                                                                                |
| **slug**               | Converts value to url-web-slugs.                                                                                      |
| **trim**               | Remove spaces from the beginning and end of strings (PHP).