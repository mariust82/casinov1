# global_js

### Description

global_js is a repository holding JavaScript libraries and scripts shared by all of our projects

---
Two types of scripts will be found in this repository:

1. **External libraries**
    - jQuery 2.1.3
    - nicescroll.min.js
2. **Custom scripts**
    - imageDefer


### Usage
**Files will be used as any other javascript file after cloning the repository**


# Custom script for global_js

## Guidelines
1. Every script will be held in one single file
2. If the script is dependent on external factors, in the same file, create a configuration object:
    - Configurable properties will be private
    - Used through getters and setters
3. No document states allowed (eg: ```$(document).ready()```)
4. No CSS or HTML manipulation
5. No hardcodings


## Usage

1. Init configuration object and set the parameters for the script to run under

    ```JavaScript
    var config = new imageDeferCONFIG(); 
        config.setImagesSelector('.data-logo_image');
        config.setDeferLoadAmount(2);
        config.setPageLoadAmount(3);
        config.setScrollOffset(200);
    ```
2. Init the script object, sending the configuration as a parameter
    ```JavaScript
    new imageDefer(config);
    ```


**NOTE** Update minification script to parse directories recursive. Look on NON for the right script or ask Mihai.
