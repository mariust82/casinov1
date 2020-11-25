var fs = require("fs"),
    xml2js = require("xml2js"),
    parser = new xml2js.Parser()
;

if(!fs.existsSync("resources.xml")) {
    console.error("ERROR: XML file not set");
    return;
}
fs.readFile("resources.xml", function(error, data) {
    parser.parseString(data, function(err, result) {
        var types = ["js","css"];
        for(var z in types) {
            var type = types[z];
            var destinationFolder = result.xml[type][0].$.destination;
            var files = result.xml[type][0].file;
            for (var k in files) {
                var fileName = destinationFolder+"/"+files[k].$.name+"."+type;
                // compile contents
                var contents = "";
                var components = files[k].file;
                if(components.length==0) {
                    console.error("ERROR: no dependencies found for "+fileName);
                    return;
                }
                for(var j in components) {
                    var dependencyFile = destinationFolder+"/"+components[j].$.name+"."+type;
                    if(!fs.existsSync(dependencyFile)) {
                        console.error("ERROR: file " + dependencyFile + " not found");
                        return;
                    }
                    contents += fs.readFileSync(dependencyFile)+"\n";
                }
                fs.writeFileSync(fileName, contents);
                console.log("Updated: "+fileName);
            }
        }
        console.log("COMPLETE!");
    });
});

