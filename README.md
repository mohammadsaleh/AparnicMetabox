AparnicMetabox
==============

Croogo simply generating metabox

##What is this?##

This plugin automatically generate metabox Or tab using .json file.

##How do i install this plugin?##

- Upload it to /app/Plugin/AparnicMetabox/
- Activate it in Croogo (Extensions/Plugins)
- Enjoy

##How can I setup meta fields?##
First, Obviously, this plugin must be loaded before others.

Create a file naming "meta.json" in your Plugin/Config/
In the bootstrap file add below code:
````
AparnicMetabox::addMetaJson([PluginName which has meta.json file in it's Config directory]);
````
Example:
````
AparnicMetabox::addMetaJson('AparnicMetabox');
````


meta.json should be formatted this way:

````
{
    
    "metaType":"meta or tab",
    "targetAction":"meta box / tab Action target, it Can be in String or Array format",
    "element":"element containing meta box / tab view",
    "boxes":{
        "meta box title":[
            {
                "type":"field type",
                "name":"field name",
                "defaultValue":"default value for this field"
            }
            ...
        ]
        ...
    }
    
}
````

Example:
````
{
    
    "metaType":"meta",
    "targetAction":["Nodes/admin_add","Nodes/admin_edit"],
    "element":"",
    "boxes":{
        "meta title 1":[
            {
                "type":"text",
                "name":"firstname",
                "defaultValue":"mohammadsaleh"
            },
            {
                "type":"text",
                "name":"lastname",
                "defaultValue":"sayari"
            }
        ],
        "meta title 2":[
            {
                "type":"text",
                "name":"country"
            }
        ]
    }
    
}
````

This will create 2 meta box in Nodes/admin_add & Nodes/admin_edit