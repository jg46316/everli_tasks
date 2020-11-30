# TASK 2

**Language:** PHP

**Description:**

Write a function that provides change directory (cd) function for an abstract file system.

Notes:

 * root path is '/'.
 * path separator is '/'.
 * parent directory is addressable as '..'.
 * directory names consist only of English alphabet letters (A-Z and a-z).
 * the function will not be passed any invalid paths.
 * do not use built-in path-related functions.

For example:

```
$path = new Path('/a/b/c/d');
$path->cd('../x');
echo $path->currentPath;
```

should display '/a/b/c/x'.

**How to submit:**

Complete the source file named `change_directory.php`.



## How to run it

 Run the following command:
 
 
php change_directory.php
```


