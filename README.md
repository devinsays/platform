Platform
===

This is a WordPress starter theme based off of Underscores that incorporates modern build tools for developers.  In addition to the lean, well-commented templates that Underscores ships with- Platform includes a number of Grunt tasks to help build modern WordPress themes.

* Generates style.css from SASS files
* Concatenates and minifies script files
* Automates vendor prefixes in css
* Generates a .pot file for translators
* Automates versioning of style and script files

Getting Started
---------------

I recommend generating your own theme based on Platform using the Grunt Scaffold.  This will allow to select a number of presets, including the theme name, before generating the template files.  But, you can also set it up manually if you like.

Clone the project from GitHub to your themes directory:
git clone git@github.com:devinsays/platform.git

Let's say you'd like to change the theme name to "Megatherium".  You'll need to run these commands to find/replace all the instances of "Platform" in the files.

Replace in "Platform" in .php and .scss files:

`
find . -name '*.php' -exec sed -i "" 's/Platform/Megatherium/g' {} \;
find . -name '*.scss' -exec sed -i "" 's/Platform/Megatherium/g' {} \;
`

Replace in "platform" in .php, .js, and .json files:

`
find . -name '*.php' -exec sed -i "" 's/platform/megatherium/g' {} \;
find . -name '*.js' -exec sed -i "" 's/platform/megatherium/g' {} \;
find . -name '*.json' -exec sed -i "" 's/platform/megatherium/g' {} \;
`

Replace the constant "PLATFORM" in .php files:

`
find . -name '*.php' -exec sed -i "" 's/PLATFORM/MEGATHERIUM/g' {} \;
`

Now you can install all the Grunt modules:

`
npm install
`

And do your first build:

`
grunt build
`