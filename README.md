# Architect

**Important Notice:** *This repository, while open source, is not generally 
well-suited for use in the projects of other agencies or individuals without 
significant modification. That being said we encourage you to fork and use it 
in part or in whole as you see fit.*

## What is it?

Designed for internal use in BCA projects, Architect is the 
[Phing](http://phing.info/) build template on top of which we create our project
build files. It's not a copy and paste job either! We require this package via 
Composer and import it directly into the project build file, which can then 
modify the tasks and add its own without having to reinvent the wheel.

## System Requirements

  - PHP 5.4+
  - [Composer](http://getcomposer.org)
  - [Phing](http://phing.info/)

## Getting Started

1. Run the following commands in the CLI:
    ```sh
      composer require --dev bca/architect:~1.2
      phing -f vendor/bca/architect/build.default.xml buildfile
    ```
    
2. **Optional** Run `phing init` to create a good starting point. This command will:
  - Copy the default build.properties file to the root of your project.
  - Set the name of the project based upon the name of your directory.
  - Symlink your Git pre-commit hook to the `phing scm` task.

From now on you can run `phing` to run the default tasks or you can run tasks
individually by name. (i.e. `phing phpcs` or `phing phpunit`)

If you have a CI server you can have it execute `phing default-ci` to run
CI-specific versions of each task that generate extra log files, which can then 
be used by the system to track your project. Logs are written to `build/logs` by
default.

## License

This program is free software: you can redistribute it and/or modify it under 
the terms of the GNU General Public License as published by the Free Software 
Foundation, either version 3 of the License, or (at your option) any later 
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY 
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A 
PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with 
this program. If not, see <http://www.gnu.org/licenses/>.


Copyright 2015 [Brodkin CyberArts](http://brodkinca.com/)
