# Architect

**Important Notice:** *This repository, while open source, is not generally well-suited for use in
the projects of other agencies or individuals without significant modification.
That being said we encourage you to fork and use it in part or in whole as you
see fit.*

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

1. Type `composer require --dev bca/architect` into the CLI.
2. Copy `build.project.xml` to your project directory as `build.xml`.
3. Run `phing` to execute the default tasks!

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


Copyright (C) 2014 [Brodkin CyberArts](http://brodkinca.com/)