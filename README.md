## Site Profile For [Processwire 3x](https://processwire.com/) with include Framework Spectre.css and functions like:
### [MarkupRegions](https://processwire.com/blog/posts/processwire-3.0.49-introduces-a-new-template-file-strategy/)
### [FunctionsAPI](https://processwire.com/blog/posts/processwire-3.0.39-core-updates/)  

#### If you want to use GULP STACK you must install these packages on your system:
[Node.js](https://nodejs.org/en/)  
[GULP](https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md)  

#### Now go to folder with all template files and install Important Dependencies
npm install  
bower install  

#### Go to gulpfile.js and change in line 9 -- var URL: "http://spectre.dev/" To your local processwire-installation -- like:
localhost/my-local-folder-processwire-installation/

#### Folder With all SCSS file is inside templates/assets/scss

#### To use the Font Awesome, you must uncomment ( remove => // ) this code line into the file that is in assets/scss/master.scss in line 6, must look like below:
'../../node_modules/font-awesome/scss/font-awesome.scss',

#### To copy Font Awesome use the command:
gulp copy

#### Now Use This Command to Watch all changes:
gulp watch

#### To Build all CSS with Font Awesome:
gulp build

#### Folder With all compressed CSS file is inside templates/assets/css

### References:
[Spectre.css](https://picturepan2.github.io/spectre/)  
[Font Awesome](http://fontawesome.io/)